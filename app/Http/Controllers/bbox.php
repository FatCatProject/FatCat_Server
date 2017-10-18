<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Queue\InvalidPayloadException;
use Illuminate\Support\Facades\Auth;

class bbox extends Controller
{

    public function head_check_server_connection(Request $request)
    {
        return response("", 204);
    }

    public function get_server_token(Request $request)
    {
        if (!$request->hasHeader("php-auth-user") || !$request->hasHeader("php-auth-pw")) {
            return response("", 401);
        }

        if (!$request->isJson()) {
            return response("", 400);
        }

        $auth_user = $request->header("php-auth-user");
        $auth_pw = $request->header("php-auth-pw");
        $request_brainbox_id = json_decode($request->getContent());

        try {
            if (!isset($request_brainbox_id) || !isset($request_brainbox_id->brainbox_id)) {
                throw new InvalidPayloadException("InvalidPayloadException");
            }
            if (!Auth::attempt(['email' => $auth_user, 'password' => $auth_pw])) {
                return response("", 401);
            }
            $request_user = Auth::user();
            $request_user_brainbox = $request_user->brainbox;
            if (!isset($request_user_brainbox)) {
                $request_user_brainbox = \App\Brainbox::create(
                    [
                        "user_email" => $request_user->email,
                        "brainbox_id" => $request_brainbox_id->brainbox_id
                    ]
                );
            }
            $request_user_brainbox->brainbox_ip = $request->ip();
            $request_user_brainbox->last_seen = new \DateTime();
            $request_user_brainbox->save();

        } catch (QueryException $e) {
            return response("Probably Integrity constraint violation", 400);
        } catch (InvalidPayloadException $e) {
            return response($e->getMessage(), 400);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json(["server_token" => Auth::user()->server_token], 200);
    }

    public function get_card(Request $request)
    {
        $request_user = $request->get("request_user");
        if (!isset($request_user->brainbox)) {
            return response("Please re-authenticate BrainBox", 401);
        }
        $synced_admin_cards = array();
        $synced_regular_cards = array();

        $admin_cards = array();
        foreach ($request_user->adminCards->where("synced_to_brainbox", false) as $admin_card) {
            array_push($admin_cards,
                [
                    "card_id" => $admin_card->card_id,
                    "card_name" => $admin_card->card_name,
                    "active" => $admin_card->active,
                    "update_time" => date('Y-m-d H:i:s', strtotime($admin_card->updated_at))
                ]
            );
            array_push($synced_admin_cards, $admin_card->card_id);
        }

        $regular_cards = array();
        foreach ($request_user->cards->where("synced_to_brainbox", false) as $card) {
            array_push($regular_cards,
                [
                    "foodbox_id" => $card->foodbox_id,
                    "card_id" => $card->card_id,
                    "card_name" => $card->card_name,
                    "active" => $card->active,
                    "update_time" => date('Y-m-d H:i:s', strtotime($card->updated_at))
                ]
            );
            array_push($synced_regular_cards, $card->card_id);
        }

        \DB::table("admin_cards")
            ->where("user_email", $request_user->email)
            ->whereIn("card_id", $synced_admin_cards)
            ->update(["synced_to_brainbox" => true]);
        \DB::table("cards")
            ->where("user_email", $request_user->email)
            ->whereIn("card_id", $synced_regular_cards)
            ->update(["synced_to_brainbox" => true]);

        $request_user_brainbox = $request_user->brainbox;
        $request_user_brainbox->brainbox_ip = $request->ip();
        $request_user_brainbox->last_seen = new \DateTime();
        $request_user_brainbox->save();
        return response()->json(["admin_cards" => $admin_cards, "regular_cards" => $regular_cards], 200);
    }

    public function get_foodbox(Request $request)
    {
        $request_user = $request->get("request_user");
        if (!isset($request_user->brainbox)) {
            return response("Please re-authenticate BrainBox", 401);
        }
        $synced_foodboxes = array();

        $foodboxes = array();
        foreach ($request_user->foodboxes->where("synced_to_brainbox", false) as $foodbox) {
            array_push($foodboxes,
                [
                    "foodbox_id" => $foodbox->foodbox_id,
                    "foodbox_name" => $foodbox->foodbox_name
                ]
            );
            array_push($synced_foodboxes, $foodbox->foodbox_id);
        }

        \DB::table("foodboxes")
            ->where("user_email", $request_user->email)
            ->whereIn("foodbox_id", $synced_foodboxes)
            ->update(["synced_to_brainbox" => true]);

        $request_user_brainbox = $request_user->brainbox;
        $request_user_brainbox->brainbox_ip = $request->ip();
        $request_user_brainbox->last_seen = new \DateTime();
        $request_user_brainbox->save();
        return response()->json(["foodboxes" => $foodboxes], 200);
    }

    public function put_feeding_log(Request $request)
    {
        $request_user = $request->get("request_user");
        if (!isset($request_user->brainbox)) {
            return response("Please re-authenticate BrainBox", 401);
        }
        $request_user_brainbox = $request_user->brainbox;
        $request_user_brainbox->brainbox_ip = $request->ip();
        $request_user_brainbox->last_seen = new \DateTime();
        $request_user_brainbox->save();

        if (!$request->isJson()) {
            return response("", 400);
        }

        $created_ids = array();
        $foodboxes_to_save = array();
        try {
            $request_feeding_logs = json_decode($request->getContent());
            if (!isset($request_feeding_logs) || !isset($request_feeding_logs->feeding_logs)) {
                throw new InvalidPayloadException("InvalidPayloadException");
            }

            foreach ($request_feeding_logs->feeding_logs as $feeding_log) {
                if (!(
                    isset($feeding_log->foodbox_id) && isset($feeding_log->card_id) && isset($feeding_log->feeding_id) &&
                    isset($feeding_log->open_time) && isset($feeding_log->close_time) && isset($feeding_log->start_weight) &&
                    isset($feeding_log->end_weight)
                )) {
                    throw new InvalidPayloadException("InvalidPayloadException");
                }
                $tmp_feeding_log = \App\FeedingLog::create(
                    [
                        "user_email" => $request_user->email,
                        "foodbox_id" => $feeding_log->foodbox_id,
                        "card_id" => $feeding_log->card_id,
                        "feeding_id" => $feeding_log->feeding_id,
                        "open_time" => $feeding_log->open_time,
                        "close_time" => $feeding_log->close_time,
                        "start_weight" => $feeding_log->start_weight,
                        "end_weight" => $feeding_log->end_weight
                    ]
                );

                array_push($foodboxes_to_save, $tmp_feeding_log->foodbox);
                if ($tmp_feeding_log->wasRecentlyCreated) {
                    array_push($created_ids, $tmp_feeding_log->id);
                }
            }

        } catch (QueryException $e) {
            \App\FeedingLog::destroy($created_ids);
            return response("Probably Integrity constraint violation", 400);
        } catch (InvalidPayloadException $e) {
            \App\FeedingLog::destroy($created_ids);
            return response($e->getMessage(), 400);
        } catch (\Exception $e) {
            \App\FeedingLog::destroy($created_ids);
            throw $e;
        }

        array_unique($foodboxes_to_save);
        $now = new \DateTime();
        foreach ($foodboxes_to_save as $foodbox) {
            $foodbox->last_seen = $now;
            $foodbox->save();
        }
        return response("", 201);
    }

    public function put_foodbox(Request $request)
    {
        $request_user = $request->get("request_user");
        if (!isset($request_user->brainbox)) {
            return response("Please re-authenticate BrainBox", 401);
        }
        $request_user_brainbox = $request_user->brainbox;
        $request_user_brainbox->brainbox_ip = $request->ip();
        $request_user_brainbox->last_seen = new \DateTime();
        $request_user_brainbox->save();

        if (!$request->isJson()) {
            return response("", 400);
        }

        $created_ids = array();
        $foodboxes_to_save = array();
        try {
            $request_foodboxes = json_decode($request->getContent());
            if (!isset($request_foodboxes) || !isset($request_foodboxes->foodboxes)) {
                throw new InvalidPayloadException("InvalidPayloadException");
            }
            foreach ($request_foodboxes->foodboxes as $foodbox) {
                if (!(isset($foodbox->foodbox_id) && isset($foodbox->foodbox_name) && isset($foodbox->current_weight))) {
                    throw new InvalidPayloadException("InvalidPayloadException");
                }
                $tmp_foodbox = \App\Foodbox::updateOrCreate(
                    [
                        "user_email" => $request_user->email,
                        "foodbox_id" => $foodbox->foodbox_id
                    ],
                    [
                        "foodbox_name" => $foodbox->foodbox_name,
                        "current_weight" => $foodbox->current_weight

                    ]);

                array_push($foodboxes_to_save, $tmp_foodbox);
                if ($tmp_foodbox->wasRecentlyCreated) {
                    array_push($created_ids, $tmp_foodbox->id);
                }
            }

        } catch (QueryException $e) {
            \App\Foodbox::destroy($created_ids);
            return response("Probably Integrity constraint violation", 400);
        } catch (InvalidPayloadException $e) {
            \App\Foodbox::destroy($created_ids);
            return response($e->getMessage(), 400);
        } catch (\Exception $e) {
            \App\Foodbox::destroy($created_ids);
            throw $e;
        }

        array_unique($foodboxes_to_save);
        $now = new \DateTime();
        foreach ($foodboxes_to_save as $foodbox) {
            $foodbox->last_seen = $now;
            $foodbox->save();
        }
        return response("", 204);
    }
}
