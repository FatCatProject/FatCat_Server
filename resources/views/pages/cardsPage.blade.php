@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div id="Edit" class="graphs">
            <h3 class="blank1">Cards Manager:</h3>
            {{--Cards Manager--}}
            <div class="row">
                {{--addCardBlock--}}
                <div id="addCardBlock" class="col-sm-6">
                    <h4 class="blank1">Add cat card:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addCard" id="addCardForm">
                                {!! csrf_field() !!}
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">ID: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control1" id="card_id" name="card_id"
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control1" name="card_name" id="shopUrl"
                                                   placeholder="" required>
                                        </div>
                                    </div>
                                    {{--Choose cat--}}
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Belongs to: <span
                                                style="color: red;">*</span></label>
                                        <!--Full dropdown without ajax-->
                                        <div class="col-sm-9">
                                            <select name="cat_id" id="foodBox" class="form-control1" required>
                                                <option value="" name="" selected disabled>Please choose a cat for this
                                                    card:
                                                </option>
                                                @if(!empty($mycats))
                                                    @foreach($mycats as $cat)
                                                        <option value="{!! $cat->id !!}"
                                                                name="cat_id">{!! $cat->cat_name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{--Choose which box to open--}}
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Opens foodbox: <span
                                                style="color: red;">*</span></label>
                                        <!--Full dropdown without ajax-->
                                        <div class="col-sm-9">
                                            <select name="foodbox_id" id="foodBox" class="form-control1" required>
                                                <option value="" name="" selected disabled>Please choose a foodbox this
                                                    card can open:
                                                </option>
                                                @if(!empty($myFoodBoxes))
                                                    @foreach($myFoodBoxes as $FoodBox)
                                                        <option value="{!! $FoodBox->foodbox_id !!}"
                                                                name="foodbox_id">{!! $FoodBox->foodbox_name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5" style="margin:20px 0 0 15px">
                                        <button type="submit" class="btn-success btn" form="addCardForm">Add Cat Card
                                        </button>
                                        <button type="reset" class="btn-inverse btn">Reset</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                {{--editCardBlock--}}
                <div hidden id="editCardBlock" class="col-sm-6">
                    <h4 class="blank1">Edit cat card:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addCard" id="addCardForm">
                                {!! csrf_field() !!}
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">ID: </label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="to_id_old" value="">
                                            <input type="hidden" id="from_card_row" value="">
                                            <input type="text" class="form-control1" id="to_id" name="card_id"
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder="" required
                                                   disabled style="background-color: #F8F8F8"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control1" name="card_name" id="to_card_name"
                                                   placeholder="" required>
                                        </div>
                                    </div>
                                    {{--Choose cat--}}
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Belongs to: <span
                                                style="color: red;">*</span></label>
                                        <!--Full dropdown without ajax-->
                                        <div class="col-sm-9">
                                            <select name="cat_id" id="to_belongs_to" class="form-control1" required>
                                                <option value="" name="" selected disabled>Please choose a cat for this
                                                    card:
                                                </option>
                                                @if(!empty($mycats))
                                                    @foreach($mycats as $cat)
                                                        <option value="{!! $cat->id !!}"
                                                                name="cat_id">{!! $cat->cat_name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{--Choose which box to open--}}
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Opens foodbox: <span
                                                style="color: red;">*</span></label>
                                        <!--Full dropdown without ajax-->
                                        <div class="col-sm-9">
                                            <select name="foodbox_id" id="to_opens" class="form-control1" required>
                                                <option value="" name="" selected disabled>Please choose a foodbox this
                                                    card can open:
                                                </option>
                                                @if(!empty($myFoodBoxes))
                                                    @foreach($myFoodBoxes as $FoodBox)
                                                        <option value="{!! $FoodBox->foodbox_id !!}"
                                                                name="foodbox_id">{!! $FoodBox->foodbox_name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-3 control-label">Active:</label>
                                        <div class="col-sm-9">
                                            <div class="checkbox-inline"><label>
                                                    <input id="to_active" type="checkbox">Yes</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5" style="margin:20px 0 0 15px">
                                        <button id="updateCatCardBtn" type="submit" class="btn-success btn" form="">
                                            Update Cat
                                            Card
                                        </button>
                                        <button id="cancelBtnCat" type="reset" class="btn-inverse btn">Cancel</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>


                {{--addAdminBlock--}}
                <div id="addAdminBlock" class="col-sm-6 vr">
                    <h4 class="blank1">Add admin card:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addAdminCard" id="adminCardForm">
                                {!! csrf_field() !!}
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">ID: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="card_id" class="form-control1" id="cardID"
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder=""
                                                   required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="card_name" class="form-control1" id="shopUrl"
                                                   placeholder="" required>
                                        </div>
                                    </div>
                                    <h6 style="line-height: 2em; margin: 45px 0 9px 20px ">* Admin card will open all
                                        available food boxes. <br>
                                        Designed to be used by cat owner to refill the food boxes.<br>
                                        This card has no activity logs.
                                    </h6>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5" style="margin:20px 0 0 15px">
                                        <button type="submit" class="btn-success btn" form="adminCardForm">Add Admin
                                            Card
                                        </button>
                                        <button type="reset" class="btn-inverse btn">Reset</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                {{--editAdminBlock--}}
                <div hidden id="editAdminBlock" class="col-sm-6">
                    <h4 class="blank1">Edit admin card:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addAdminCard" id="adminCardForm">
                                {!! csrf_field() !!}
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" id="to_id_old_Admin" value="">
                                        <input type="hidden" id="from_card_row_Admin" value="">
                                        <label for="focusedinput" class="col-sm-3 control-label">ID: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="card_id" class="form-control1" id="to_id_Admin"
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder=""
                                                   disabled style="background-color: #F8F8F8" required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="card_name" class="form-control1"
                                                   id="to_card_name_Admin"
                                                   placeholder="" required 
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-3 control-label">Active:</label>
                                        <div class="col-sm-9">
                                            <div class="checkbox-inline"><label>
                                                    <input id="to_active_Admin" type="checkbox">Yes</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 style="line-height: 2em; margin: 45px 0 9px 20px ">* Admin card will open all
                                        available food boxes. <br>
                                        Designed to be used by cat owner to refill the food boxes.<br>
                                        This card has no activity logs.
                                    </h6>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5" style="margin:20px 0 0 15px">
                                        <button id="updateAdminCardBtn" type="submit" class="btn-success btn"
                                                form="adminCardForm">Update Admin
                                            Card
                                        </button>
                                        <button id="cancelBtnAdmin" type="reset" class="btn-inverse btn">Cancel</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <hr>

            {{--Tabs for tables--}}
            <div class="grid_3 grid_5">
                <div class="row" style="padding-bottom: 10px">
                    <h4>Registered cards:</h4>
                </div>
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#home"
                                   id="home-tab"
                                   role="tab"
                                   data-toggle="tab"
                                   aria-controls="home"
                                   aria-expanded="true">Active Cards
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#profile"
                                   role="tab"
                                   id="profile-tab"
                                   data-toggle="tab"
                                   aria-controls="profile">Inactive Cards
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                {{--Data of TAB 1--}}
                                <div class="row" style="padding-top: 20px">
                                    <div class="col-sm-12">
                                        <!--Table of cards-->
                                        <div class="tab-content">
                                            <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                                                 data-widget-static="" style="margin-top: 0px">

                                                <table id="cards_table_1" class="table table-striped">
                                                    <thead>
                                                    <tr class="warning">
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Belongs to</th>   <!--admin or catName-->
                                                        <th>Opens foodbox</th>
                                                        <th>Active</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--END Table -->
                                    </div>
                                </div>
                                {{--End data of TAB 1--}}
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                {{--Data of TAB 2--}}
                                <div class="row" style="padding-top: 20px">
                                    <div class="col-sm-12">
                                        <!--Table of cards-->
                                        <div class="tab-content">
                                            <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                                                 data-widget-static="" style="margin-top: 0px">

                                                <table id="cards_table_2" class="table table-striped">
                                                    <thead>
                                                    <tr class="warning">
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Belongs to</th>   <!--admin or catName-->
                                                        <th>Opens foodbox</th>
                                                        <th>Active</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--END Table -->

                                    </div>

                                    {{--End Data of TAB 2--}}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            {{--End Tabs for tables--}}



            {{--End Cards--}}


        </div>
        <br><br><br>
    </div>





    <script>
function table_rows(active_cards, inactive_cards){
    console.log("--- table_rows ---");
    // console.log("active_cards: " + JSON.stringify(active_cards));
    // console.log("inactive_cards: " + JSON.stringify(inactive_cards));
    var logs_table_1 = $("#cards_table_1");
    $("#cards_table_1 tr").not("thead tr").remove();

    for(row_idx in active_cards){
        var row = active_cards[row_idx];
        logs_table_1.append(
            $("<tr></tr>").attr("id", "card_row_" + row_idx).val(row_idx).append(
                $("<input/>").attr({type: "hidden", id: "cardRow"}).val(row_idx),
                $("<input/>").attr({type: "hidden", id: "myCardID"}).val(active_cards[row_idx].card_id),
                $("<input/>").attr({type: "hidden", id: "isAdmin"}).val(active_cards[row_idx].is_admin),
                $("<input/>").attr({type: "hidden", id: "crr_belongs_to"}).val(active_cards[row_idx].cat_id),
                $("<input/>").attr({type: "hidden", id: "crr_opens"}).val(active_cards[row_idx].foodbox_id),
                $("<td></td>").attr("id", "crr_id").addClass("").text(active_cards[row_idx].card_id),
                $("<td></td>").attr("id", "crr_card_name").addClass("").text(active_cards[row_idx].card_name),
                $("<td></td>").text((active_cards[row_idx].cat_name) ? active_cards[row_idx].cat_name : "Admin"),
                $("<td></td>").text((active_cards[row_idx].foodbox_id) ? active_cards[row_idx].foodbox_name : "All"),
                $("<td></td>").attr("id", "crr_active").text((active_cards[row_idx].active) ? "Yes" : "No"),
                $("<td></td>").append(
                    $("<ul></ul>").attr("id", "btnsCards").addClass("nav nav-pills").append(
                        $("<li></li>").addClass("editBtnCard").on("click", editBtnCard_event).append(
                            $("<a></a>").attr("href", "#Edit").append(
                                $("<i></i>").addClass("lnr lnr-pencil")
                            )
                        )
                    )
                )
            )
        );
    }


    var logs_table_2 = $("#cards_table_2");
    $("#cards_table_2 tr").not("thead tr").remove();

    for(row_idx in inactive_cards){
        var row = inactive_cards[row_idx];
        logs_table_2.append(
            $("<tr></tr>").attr("id", "card_row_" + row_idx).val(row_idx).append(
                $("<input/>").attr({type: "hidden", id: "cardRow"}).val(row_idx),
                $("<input/>").attr({type: "hidden", id: "myCardID"}).val(inactive_cards[row_idx].card_id),
                $("<input/>").attr({type: "hidden", id: "isAdmin"}).val(inactive_cards[row_idx].is_admin),
                $("<input/>").attr({type: "hidden", id: "crr_belongs_to"}).val(inactive_cards[row_idx].cat_id),
                $("<input/>").attr({type: "hidden", id: "crr_opens"}).val(inactive_cards[row_idx].foodbox_id),
                $("<td></td>").attr("id", "crr_id").addClass("").text(inactive_cards[row_idx].card_id),
                $("<td></td>").attr("id", "crr_card_name").addClass("").text(inactive_cards[row_idx].card_name),
                $("<td></td>").text((inactive_cards[row_idx].cat_name) ? inactive_cards[row_idx].cat_name : "Admin"),
                $("<td></td>").text((inactive_cards[row_idx].foodbox_id) ? inactive_cards[row_idx].foodbox_name : "All"),
                $("<td></td>").attr("id", "crr_active").text((inactive_cards[row_idx].active) ? "Yes" : "No"),
                $("<td></td>").append(
                    $("<ul></ul>").attr("id", "btnsCards").addClass("nav nav-pills").append(
                        $("<li></li>").addClass("editBtnCard").on("click", editBtnCard_event).append(
                            $("<a></a>").attr("href", "#Edit").append(
                                $("<i></i>").addClass("lnr lnr-pencil")
                            )
                        )
                    )
                )
            )
        );
    }
}

function cards_table_data(){
    console.log("--- cards_table_data ---");

    $.get(
        "{!! URL::route('cards_page_table_data') !!}",
        {
        },
        function(data, status){
            if(status === "success"){
                var active_cards = [];
                var inactive_cards = [];
                for(tmp_card in data){
                    if(data[tmp_card].active){
                        active_cards.push(data[tmp_card]);
                    }else{
                        inactive_cards.push(data[tmp_card]);
                    }
                }
                console.log("active_cards: " + JSON.stringify(active_cards));
                console.log("inactive_cards: " + JSON.stringify(inactive_cards));
                table_rows(active_cards, inactive_cards);
            }
        }
    );
}

$(document).ready(cards_table_data);
        //Deactivate card table row
        $('.deactivateBtnCard').on("click", card_deactivate_table_row_func);

        function card_deactivate_table_row_func() {
            var id = $(this).parent().parent().parent().find('#myCardID').val();
            var isAdmin = $(this).parent().parent().parent().find('#isAdmin').val();
            var card_row = $(this).parent().parent().parent().find('#cardRow').val()
            console.log("cardID id is: " + id);
            console.log("isAdmins: " + isAdmin);

            if (isAdmin == "true") {
                console.log("here for admin card");
                //ajax for admin card
                $.ajax({
                    type: "GET",
                    url: '/deactivateAdminCard',
                    caller: card_row,
                    data: {
                        card_id: id,
                    },
                    success: function (data, status, jqXHR) {
                        console.log("back for card_id: " + data);
                        $("#card_row_" + this.caller).remove();
                    },
                    fail: function (jqXHR, status, errorThrown) {
                        console.log("ERROR:" + jqXHR);
                        console.log("ERROR:" + status);
                    }
                })
            }
            else {
                //ajax for cat card
                console.log("here for cat card");
                $.ajax({
                    type: "GET",
                    url: '/deactivateCatCard',
                    caller: card_row,
                    data: {
                        card_id: id,
                    },
                    success: function (data, status, jqXHR) {
                        console.log("back for card_id: " + data);
                        $("#card_row_" + this.caller).remove();
                    },
                    fail: function (jqXHR, status, errorThrown) {
                        console.log("ERROR:" + jqXHR);
                        console.log("ERROR:" + status);
                    }
                })
            }

        }

        // Cancel Admin card Edit btn
        $("#cancelBtnAdmin").click(function () {
            $("#editAdminBlock").hide();
            $("#addAdminBlock").show();
        });

        // Cancel CAT card Edit btn
        $("#cancelBtnCat").click(function () {
            $("#editCardBlock").hide();
            $("#addCardBlock").show();

        });

        //Edit Cards btn - opens hidden div and populates it
        // $(".editBtnCard").click(function () {
        function editBtnCard_event(){
            var id = $(this).parent().parent().parent().find('#myCardID').val();
            var isAdmin = $(this).parent().parent().parent().find('#isAdmin').val();
            console.log("cardID id is: " + id);
            console.log("isAdmins: " + isAdmin);
            var card_row = $(this).parent().parent().parent().find('#cardRow').val()
            console.log("card_row: " + card_row);
            var crr_active = $(this).parent().parent().parent().find('#crr_active').text();
            console.log("cat card active: " + crr_active);
            // IF ADMIN CARD
            if (isAdmin == "true") {
                $("#addAdminBlock").hide();
                $("#editAdminBlock").show();

                var crr_id = $(this).parent().parent().parent().find('#crr_id').text();
                console.log("AdminCardID id is: " + crr_id);
                var crr_card_name = $(this).parent().parent().parent().find('#crr_card_name').text();
                console.log("adminCard name id is: " + crr_card_name);

                $("#to_id_old_Admin").val(crr_id);
                $("#to_id_Admin").val(crr_id);
                $("#to_card_name_Admin").val(crr_card_name);
                $("#from_card_row_Admin").val(card_row);
                if (crr_active == "Yes") {
                    $("#to_active_Admin").prop("checked", true);
                } else {
                    $("#to_active_Admin").removeProp("checked");
                }

            }
            // IF CAT CARD
            else {
                $("#addCardBlock").hide();
                $("#editCardBlock").show();


                var crr_id = $(this).parent().parent().parent().find('#crr_id').text();
                console.log("CATcardID id is: " + crr_id);
                var crr_card_name = $(this).parent().parent().parent().find('#crr_card_name').text();
                console.log("CATcard name id is: " + crr_card_name);
                var crr_belongs_to = $(this).parent().parent().parent().find('#crr_belongs_to').val();
                console.log("belongs to: " + crr_belongs_to);
                var crr_opens = $(this).parent().parent().parent().find('#crr_opens').val();
                console.log("opens: " + crr_opens);

//

                $("#from_card_row").val(card_row);
                if (crr_active == "Yes") {
                    $("#to_active").prop("checked", true);
                } else {
                    $("#to_active").removeProp("checked");
                }
                $("#to_id_old").val(crr_id);
                $("#to_id").val(crr_id);
                $("#to_card_name").val(crr_card_name);
                $("#to_belongs_to").val(crr_belongs_to);
                $("#to_opens").val(crr_opens);

            }


        }
    // );

        //Update Cat card btn
        $('#updateCatCardBtn').on("click", function () {
            var id_old = $("#to_id_old").val(); //old card id that wanted to be changes
            var id_new = $("#to_id").val(); // ned card id if was changed
            var to_card_name = $("#to_card_name").val();
            var to_belongs_to = $("#to_belongs_to").val();
            var to_opens = $("#to_opens").val();
            var isActive = 0;
            if ($("#to_active").prop('checked')) {
                isActive = 1;
            }
            var row = $("#from_card_row").val();

            console.log("row: :" + row);
            console.log("cat id_old card: :" + id_old);
            console.log("cat new id:" + id_new);
            console.log("to_card_name:" + to_card_name);
            console.log("to_belongs_to_cat_id:" + to_belongs_to);
            console.log("to_opens_box_id:" + to_opens);
            console.log("isActive:" + isActive);

            $.ajax({
                type: "GET",
                url: '/updateCatCard',
                caller: row,
                data: {
                    id_old: id_old,
                    id_new: id_new,
                    to_card_name: to_card_name,
                    to_belongs_to: to_belongs_to,
                    to_opens: to_opens,
                    isActive: isActive
                },
                success: function (data, textStatus, jqXHR) {
                    console.log("back newCardID " + data.newCardID);
                    console.log("back newName " + data.newName);
                    console.log("back newBelongsTo " + data.newBelongsTo);
                    console.log("back newOpens " + data.newOpens);
//                    console.log("back newActive " + data.newActive);

                    console.log("got back forID" + this.caller);
                    console.log($('#card_row_' + this.caller));
                    cards_table_data();
                    scrollToAnchor('card_row_' + this.caller);

                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + textStatus);
                }
            })
            $("#editCardBlock").hide();
            $("#addCardBlock").show();
        });


        //Update ADMIN card btn
        $('#updateAdminCardBtn').on("click", function () {

            var id_old = $("#to_id_old_Admin").val(); //old card id that wanted to be changes
            var id_new = $("#to_id_Admin").val(); // ned card id if was changed
            var to_card_name = $("#to_card_name_Admin").val();

            var isActive = 0;
            if ($("#to_active_Admin").prop('checked')) {
                isActive = 1;
            }
            var row = $("#from_card_row_Admin").val();

            console.log("row: " + row);
            console.log("Admin id_old card: :" + id_old);
            console.log("Admin new id:" + id_new);
            console.log("Admin to_card_name:" + to_card_name);
            console.log("isActive:" + isActive);

            $.ajax({
                type: "GET",
                url: '/updateAdminCard',
                caller: row,
                data: {
                    id_old: id_old,
                    id_new: id_new,
                    to_card_name: to_card_name,
                    isActive: isActive
                },
                success: function (data, textStatus, jqXHR) {
                    console.log("back newCardID " + data.newCardID);
                    console.log("back newName " + data.newName);
                    console.log("got back forID" + this.caller);
                    console.log($('#card_row_' + this.caller));
                    cards_table_data();
                    scrollToAnchor('card_row_' + this.caller);

                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + textStatus);
                }
            })
            $("#editAdminBlockdBlock").hide();
            $("#addAdminBlockBlock").show();
        });

        //Anchor
        function scrollToAnchor(aid) {
            var aTag = $('#' + aid);
            $('html,body').animate({scrollTop: aTag.offset().top - 60}, 'slow');
        }

        //

    </script>
@endsection
