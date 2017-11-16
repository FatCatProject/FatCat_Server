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
                                        <label for="focusedinput" class="col-sm-3 control-label">ID: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="to_id_old" value="">
                                            <input type="hidden" id="from_card_row" value="">
                                            <input type="text" class="form-control1" id="to_id" name="card_id"
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder="" required>
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
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder="" required>
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
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name: <span
                                                style="color: red;">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="card_name" class="form-control1"
                                                   id="to_card_name_Admin"
                                                   placeholder="" required>
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
                                        <button id="updateAdminCardBtn" type="submit" class="btn-success btn" form="adminCardForm">Update Admin
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
            <div class="row" style="padding-top: 20px">
                <div class="col-sm-12">
                    <!--Table of cards-->
                    <div class="tab-content" style="margin-left: 25px">
                        <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                             data-widget-static="" style="margin-top: 0px">
                            <div class="row" style="padding: 14px 0px 6px 30px;">
                                <h4>Registered cards:</h4>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr class="warning">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Belongs to</th>   <!--admin or catName-->
                                    <th>Opens foodbox</th>
                                    <th>Active</th>
                                    <th>Edit/Deactivate</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0;$i<10 && count($myCards)>0;$i++)
                                    @if(empty($myCards[$i]))
                                    @else
                                        {{--<tr id="card_row_{!! $myCards[$i]['card_id'] !!}">--}}
                                        <tr id="card_row_{!! $i !!}" value={!! $i !!}>
                                            <input id="cardRow" type="hidden" value={!! $i !!}>
                                        <input id="myCardID" type="hidden" value="{!! $myCards[$i]['card_id'] !!}">
                                            <input id="isAdmin"
                                                   type="hidden"
                                                   @if(empty($myCards[$i]['cat_name']))
                                                   value="true"
                                                   @else
                                                   value="false"
                                                @endif
                                            >
                                            {{--the url has to be a cklicable LINK, put the same value in HREF as the address itself--}}
                                            <td id="crr_id" class="">{!! $myCards[$i]['card_id'] !!}</td>
                                            <td id="crr_card_name" class="">{!! $myCards[$i]['card_name'] !!}</td>
                                            @if(empty($myCards[$i]['cat_id']))
                                                <td id="crr_belongs_to" class="" value="">Admin</td>
                                            @else
                                                <td hidden id="crr_belongs_to"
                                                    class="">{!! $myCards[$i]['cat_id'] !!}</td>
                                                <td id="" class="">{!! $myCards[$i]['cat_name'] !!}</td>
                                            @endif
                                            @if(empty($myCards[$i]['cat_id']))
                                                <td id="crr_opens" class="">All</td>
                                            @else
                                                <td hidden id="crr_opens"
                                                    class="">{!! $myCards[$i]['foodbox_id'] !!}</td>
                                                <td id="" class="">{!! $myCards[$i]['foodbox_name']  !!}</td>
                                            @endif
                                            @if($myCards[$i]['active'] == 1)
                                                <td id="crr_active" class="">Yes</td>
                                            @else
                                                <td id="crr_active" class="">No</td>
                                            @endif
                                            <td>
                                                <ul id="btnsCards" class="nav nav-pills">
                                                    <li class="editBtnCard"><a href="#Edit"><i class="lnr lnr-pencil"
                                                                                               onclick=""></i></a></li>
                                                    <li class="deactivateBtnCard"
                                                        id="card_del_id_{!! $myCards[$i]['card_id'] !!}"
                                                        value="{!! $myCards[$i]['card_id'] !!}">
                                                        <a><i class="lnr lnr-lock"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endif
                                @endfor
                                </tbody>
                            </table>
                            <div align="right" class="col-md-12 page_1">
                                <nav>
                                    <ul class="pagination">
                                        <li class="disabled"><a href="#" aria-label="Previous"><i
                                                    class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!--END Table -->

                </div>


            </div>
            {{--End Cards--}}


        </div>
        <br><br><br>
    </div>





    <script>
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
        $(".editBtnCard").click(function () {
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
                if(crr_active == "Yes"){
                    $("#to_active_Admin").attr("checked", "");
                }else{
                    $("#to_active_Admin").removeAttr("checked");
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
                var crr_belongs_to = $(this).parent().parent().parent().find('#crr_belongs_to').text();
                console.log("belongs to: " + crr_belongs_to);
                var crr_opens = $(this).parent().parent().parent().find('#crr_opens').text();
                console.log("opens: " + crr_opens);

//

                $("#from_card_row").val(card_row);
                if(crr_active == "Yes"){
                    $("#to_active").attr("checked", "");
                }else{
                    $("#to_active").removeAttr("checked");
                }
                $("#to_id_old").val(crr_id);
                $("#to_id").val(crr_id);
                $("#to_card_name").val(crr_card_name);
                $("#to_belongs_to").val(crr_belongs_to);
                $("#to_opens").val(crr_opens);

            }


        });

        //Update Cat card btn
        $('#updateCatCardBtn').on("click", function () {
            var id_old = $("#to_id_old").val(); //old card id that wanted to be changes
            var id_new = $("#to_id").val(); // ned card id if was changed
            var to_card_name = $("#to_card_name").val();
            var to_belongs_to = $("#to_belongs_to").val();
            var to_opens = $("#to_opens").val();
            var isActive = 0;
            if ($("#to_active").prop('checked')){
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
                    $('#card_row_' + this.caller).find('#crr_id').text(data.newCardID);
                    $('#card_row_' + this.caller).find('#crr_card_name').text(data.newName);
                    $('#card_row_' + this.caller).find('#crr_belongs_to').text(data.newBelongsTo);
                    $('#card_row_' + this.caller).find('#crr_opens').text(data.newOpens);
                    if(data.newActive==0){
                        $('#card_row_' + this.caller).find('#crr_active').text("No");
                    }
                    else {
                        $('#card_row_' + this.caller).find('#crr_active').text("Yes");
                    }

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
            if ($("#to_active_Admin").prop('checked')){
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
                    $('#card_row_' + this.caller).find('#crr_id').text(data.newCardID);
                    $('#card_row_' + this.caller).find('#crr_card_name').text(data.newName);
                    if(data.newActive==0){
                        $('#card_row_' + this.caller).find('#crr_active').text("No");
                    }
                    else {
                        $('#card_row_' + this.caller).find('#crr_active').text("Yes");
                    }

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