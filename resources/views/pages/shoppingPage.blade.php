@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div id="Edit" class="graphs">
            <h3 class="blank1">Shopping history:</h3>
            <!---728x90--->
            <div class="row">

                {{--Add Shopping Log--}}
                <div class="col-sm-7" id="addBlock">
                    <h4 class="blank1">Add shopping entry:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addShopping" id="addShoppingForm">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="catDob" class="col-sm-2 control-label">Date: <span
                                            style="color: red;">*</span></label>
                                    <div class="row" style="padding: 10px">
                                        <div class="input-group" style="margin: 0px 0px 0px 15px">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" id="vetDate" name="shopping_date" alt="date"
                                                   placeholder="YYYY-MM-DD"
                                                   type="text" required style="width: 120px;"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-2 control-label">Description:</label>
                                    <div class="col-sm-8"><textarea name="description" id="description"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 70px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="smallinput" class="col-sm-2 control-label label-input-sm">Price: <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="price" step="any" min="0" max="999"
                                               class="form-control1 input-sm"
                                               id="vetLogPrice" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button type="submit" class="btn-success btn" form="addShoppingForm">Add
                                            </button>
                                            <button type="reset" class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                {{--Edit shopping log--}}
                <div hidden class="col-sm-7" id="editBlock">
                    <h4 class="blank1">Edit shopping entry:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="GET" action="" id="">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <input type="hidden" name="to_logID" id="to_logID" value="">
                                    <label for="shopDate" class="col-sm-2 control-label">Date: <span
                                            style="color: red;">*</span></label>
                                    <div class="row" style="padding: 10px">
                                        <div class="input-group" style="margin: 0px 0px 0px 15px">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" id="to_date" name="to_date"
                                                   alt="date"
                                                   placeholder="YYYY-MM-DD"
                                                   type="text" required style="width: 120px;"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-2 control-label">Description:</label>
                                    <div class="col-sm-8"><textarea name="to_desc" id="to_desc"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 70px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="smallinput" class="col-sm-2 control-label label-input-sm">Price: <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="to_price" step="any" min="0" max="10000"
                                               class="form-control1 input-sm"
                                               id="to_price" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button id="updateBtn" type="submit" class="btn-success btn"
                                                    form="">Update
                                            </button>
                                            <button id="cancelBtn" type="reset" class="btn-inverse btn">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Stats-->
                <div class="col-sm-4" style="min-width:500px;">
                    <div class="tab-content">
                        <div class="panel panel-warning" style="margin-top:0px"
                             data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                             data-widget-static="">
                            <div class="grid_1">
                                <div class="row" style="padding: 10px">
                                    <div class="col-sm-4">
                                        <div class="input-group" style="margin: 0px 0px 0px 0px; width: 30%">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" id="vetStatsYear" name="dateYear" alt="dateYear"
                                                   placeholder="YYYY"
                                                   type="text" style="width: 60px; "/>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <p style="margin:5px 0 10px 0">Yearly expenses</p>
                                    </div>
                                </div>
                                <div class="row" style="margin-left:2px;">
                                    <div class="col-sm-12" style="color: #999; font-size: 13px; margin-bottom: 30px">
                                        Pick a year to see the shopping expenses for a specific year
                                    </div>
                                </div>
                                <div class="row">
                                    <div align="center">
                                        <canvas id="bar1" height="207" width="450px"
                                                style="width:450px; height: 100px;"></canvas>
                                        <script>
                                            var barChartData = {
                                                labels: ["Jun", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                                datasets: [
                                                    {
                                                        fillColor: "#00BCD4",
                                                        strokeColor: "#00BCD4",
                                                        data: {!! $yearly_expenses !!}
                                                    },
                                                ]
                                            };
                                            new Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData).fontcolor("999");
                                        </script>
                                    </div>

                                </div>
                                <div class="row" style="margin-left: 15px">
                                    <h3 style="color: #999;">Total amout:{!! $totalExpenses !!}</h3>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!--END Stats -->

                </div>
                <!--End Stats-->
            </div>
            <!--Table-->
            <div class="tab-content">
                <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                     data-widget-static="">
                    <div class="row" style="padding: 10px">
                        <div class="col-sm-1">
                            <div class="input-group" style="margin: 0px 0px 0px 0px; width: 30%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="logsMonth" name="dateMonth" alt="dateMonth"
                                       placeholder="YYYY-MM"
                                       type="text" style="width: 90px; "/>
                            </div>
                        </div>
                        <div class="col-sm-10" style="margin:8px 0 0 25px;color: #999; font-size: 13px;">
                            Pick a month or view 10 last purchases
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr class="warning">
                            <th>Date</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($index=0;$index < count($shoppingLogs);$index++)

                            <tr id="row_{!! $shoppingLogs[$index]->id !!}">

                                @if(empty($shoppingLogs[$index]))
                                @endif
                                @if(!empty($shoppingLogs[$index]))
                                    <input id="logID" type="hidden" value="{!! $shoppingLogs[$index]->id !!}">
                                    <td id="crr_date"> {!! $shoppingLogs[$index]->shopping_date !!} </td>
                                    <td id="crr_desc"> {!! $shoppingLogs[$index]->description !!} </td>
                                    <td id="crr_price"> {!! $shoppingLogs[$index]->price !!} </td>
                                    <td>
                                        <ul id="btns" class="nav nav-pills">
                                            <li class="editBtn"><a href="#Edit"><i class="lnr lnr-pencil editValues"
                                                                                   onclick=""></i></a></li>
                                            <li class="deleteBtn" id="del_id_{!! $shoppingLogs[$index]->id !!}"
                                                value="{!! $shoppingLogs[$index]->id !!}">
                                                <a><i class="lnr lnr-trash"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                @endif
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                    <div align="right" class="col-md-12 page_1">
                        <nav>
                            <ul class="pagination">
                                <li class="disabled"><a href="#" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
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
            <br>
        </div>
        <br><br><br>
    </div>

    <script>


        //Edit btn - opens hiden div and populates it
        $(".editBtn").click(function () {
            $("#addBlock").hide();
            $("#editBlock").show();

            var id = $(this).parent().parent().parent().find('#logID').val();
            console.log("id:" + id);
            var crr_date = $(this).parent().parent().parent().find('#crr_date').text();
            console.log("date is:" + crr_date);
            var crr_desc = $(this).parent().parent().parent().find('#crr_desc').text();
            console.log("crr_desc:" + crr_desc);
            var crr_price = parseInt($(this).parent().parent().parent().find('#crr_price').text());
            console.log("crr_price:" + crr_price);

            $("#to_logID").val(id);
            $("#to_date").val(crr_date);
            $("#to_desc").val(crr_desc);
            $("#to_price").val(crr_price);

        });

        //Cancel Edit btn
        $("#cancelBtn").click(function () {
            $("#editBlock").hide();
            $("#addBlock").show();
        });


        //Delete table row
        $('.deleteBtn').on("click", delete_table_row_func);

        function delete_table_row_func() {
            var id = $(this).parent().parent().parent().find('#logID').val();
            console.log("shoplog id is" + id);
            $.ajax({
                type: "GET",
                url: '/deleteShoppingLog',
                caller: id,
                data: {
                    id: id,
                },
                success: function (data, status, jqXHR) {
                    console.log("llll:" + data);
                    $("#row_" + this.caller).remove();
                },
                fail: function (jqXHR, status, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + status);
                }
            })
        }

        //Update btn
        $('#updateBtn').on("click", function () {
            var id = $('#to_logID').val();
            var to_date = $('#to_date').val();
            var to_desc = $('#to_desc').val();
            var to_price = $('#to_price').val();
            console.log("this is the id of log in ajax:" + id);
            console.log("new to_date:" + to_date);
            console.log("new to_desc:" + to_desc);
            console.log("new price:" + to_price);
            $.ajax({
                type: "GET",
                url: '/updateShoppingLog',
                caller: id,
                data: {
                    id: id,
                    to_date: to_date,
                    to_desc: to_desc,
                    to_price: to_price,

                },
                success: function (data, textStatus, jqXHR) {
                    console.log("back newDate " + data.newDate);
                    console.log("back newDesc " + data.newDesc);
                    console.log("back newPrice " + data.newPrice);
                    console.log("got back forID" + this.caller);
//                    $("#row_" + this.caller).html(newWeight+"<span>&nbsp;&nbsp;grams left</span>");
                    console.log(  $('#row_' + this.caller));
                    $('#row_' + this.caller).find('#crr_date').text(data.newDate);
                    $('#row_' + this.caller).find('#crr_desc').text(data.newDesc);
                    $('#row_' + this.caller).find('#crr_price').text(data.newPrice);
                    scrollToAnchor('row_' + this.caller);

                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + textStatus);
                }
            })
            $("#editBlock").hide();
            $("#addBlock").show();
        });

//Anchor
        function scrollToAnchor(aid){
            var aTag = $('#'+ aid);
            $('html,body').animate({scrollTop: aTag.offset().top -60},'slow');
        }

    </script>
@endsection