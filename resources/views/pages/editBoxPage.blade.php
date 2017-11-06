@extends('layouts.master')
@section('content')
    <div id="page-wrapper">
            <div class="graphs">
                <h3 class="blank1" id="title">Food Box $name</h3>
                <div class="tab-content">
                    <div class="tab-pane active" id="horizontal-form">
                        <form class="form-horizontal">

                            {{--unique ID can not be changed by user as SN--}}
                            <div class="form-group">
                                <label for="foodBoxID" class="col-sm-2 control-label">Food Box ID</label>
                                <div class="col-sm-8">
                                    <input style="background: #f8f8f8" disabled="" type="text" class="form-control1" id="foodBoxID" placeholder="">
                                </div>
                            </div>
                            {{--date when the box was added to the server DB , input cannot be changed by user--}}
                            <div class="form-group">
                                <label for="foodBoxCreateDate" class="col-sm-2 control-label">Added on:</label>
                                <div class="col-sm-8">
                                    <input style="background: #f8f8f8" disabled="" type="text" class="form-control1" id="foodBoxCreateDate" placeholder="">
                                </div>
                            </div>
                            {{--Current weight of the food in the box, cannot be changed by user--}}
                            <div class="form-group">
                                <label for="foodBoxFoodWeight" class="col-sm-2 control-label label-input-sm">Current amount of food:</label>
                                <div class="col-sm-8">
                                    <input style="background: #f8f8f8" disabled="" type="number" step="any" min="0" max="100" class="form-control1 input-sm"
                                           id="foodBoxFoodWeight" placeholder="">
                                </div>
                            </div>



                            {{--List of cards&cats that can open this box, no option to change from here
                            if a user wants to change the permissions he has to do it via CARD edit--}}
                            <div class="form-group">
                                <label for="foodBoxName" class="col-sm-2 control-label">Cards that can open this food box:</label>
                                <div class="col-sm-8" >
                                    <table class="tblCardsForBox" >
                                        <tbody>
                                        <tr>
                                            <td>111-111-111-111-111:</td>
                                            <td>Ellie</td>
                                        </tr>
                                        <tr>
                                            <td>222-111-111-111-111:</td>
                                            <td>Elf</td>
                                        </tr>
                                        <tr>
                                            <td>333-111-111-111-111:</td>
                                            <td>Chavka</td>
                                        </tr>
                                        <tr>
                                            <td>333-111-111-111-111:</td>
                                            <td>Chavka</td>
                                        </tr>
                                        <tr>
                                            <td>333-111-111-111-111:</td>
                                            <td>Chavka</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{--Name--}}
                            <div class="form-group">
                                <label for="foodBoxName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="foodBoxName" placeholder="">
                                </div>
                            </div>
                            {{--bowl weight in case someone replaced the bowl in the box--}}
                            <div class="form-group">
                                <label for="foodBoxBowlWeight" class="col-sm-2 control-label label-input-sm">Bowl weight:</label>
                                <div class="col-sm-8">
                                    <input type="number" step="any" min="0" max="100" class="form-control1 input-sm"
                                           id="foodBoxBowlWeight" placeholder="">
                                </div>
                            </div>
                            {{--choose the food that is currently in the box so we can calculate how much was eaten and
                            notify if there is a need to order a new package of food--}}
                            <div class="form-group">
                                <label for="foodBoxFoodUsed" class="col-sm-2 control-label">Food currently used in the box:</label>
                                <!--Full dropdown without ajax-->
                                <div class="col-sm-8">
                                    <select name="foodUsed" id="foodUsed" class="form-control1">
                                        <option value="" name="" selected disabled>Please select the food you're using
                                            in this food box  from your procuct's list:
                                        </option>
                                        <option value="1" name="1">Food 1 from db from Foods table</option>
                                        <option value="2" name="2">Food 2 from db from Foods table</option>
                                        <option value="3" name="3">Food 3 from db from Foods table</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal">
                            <div class="">
                                <div class="row" style="margin-left: 250px">
                                        <button class="btn-success btn">Save changes</button>
                                        <button class="btn-inverse btn">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    {{--end fields--}}
    </div>
@endsection