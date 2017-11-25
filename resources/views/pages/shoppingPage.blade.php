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
                                    <div class="col-sm-9"><textarea name="description" id="description"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 70px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="smallinput" class="col-sm-2 control-label label-input-sm">Price: <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" name="price" step="any" min="0" max="9999"
                                               class="form-control1 input-sm"
                                               id="vetLogPrice" placeholder="" required>
                                    </div>
                                    <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                                        <p class="help-block">USD</p>
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
                                    <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                                        <p class="help-block">USD</p>
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
                <div class="col-sm-4">
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
                                            <input
                                                alt="dateYear"
                                                class="form-control"
                                                id="yearly_expenses_datepicker"
                                                name="dateYear"
                                                placeholder="YYYY"
                                                style="width: 60px;"
                                                type="text"
                                                value="{!! (new DateTime())->format('Y') !!}"
                                            />
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
                                        <canvas
                                            height="207"
                                            id="bar1"
                                            style="width:450px; height: 100px;"
                                            width="450px"
                                        ></canvas>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: 15px">
                                    <h3 id="expenses_sum_h" style="color: #999;"></h3>
                                </div>
<script>
function expenses_bar_chart(){
    var year_date = $("#yearly_expenses_datepicker").val();
    console.log("year_date: " + year_date);

    $.get(
        "{!! URL::route('shopping_page_yearly_expenses') !!}",
        {
            year_date: year_date,
        },
        function(data, status){
            console.log("status: " + status);
            if(status === "success"){
                console.log("data: " + JSON.stringify(data));
                new Chart(
                    document.getElementById("bar1").getContext("2d")).Bar(
                        {
                            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            datasets: [
                                {
                                    fillColor: "#00ACED",
                                    strokeColor: "#00ACED",
                                    data: data
                                }
                            ]
                        }
                    );
                    var expenses_sum = data.reduce(function(previous, current){ return previous + current; });
                    $("#expenses_sum_h").text("Total expenses: " + expenses_sum + " USD");
            }
            $("#bar1").css("height", "155px").css("width", "390px").css("font-size", "10px");
        }
    );
}
$("#yearly_expenses_datepicker").on("changeDate", expenses_bar_chart);
</script>

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
                                <input
                                    alt="dateMonth"
                                    class="form-control"
                                    id="logs_table_datepicker"
                                    name="dateMonth"
                                    placeholder="YYYY-MM"
                                    type="text" style="width: 90px; "
                                    value="{!! (new DateTime())->format('Y-m') !!}"
                                />
                            </div>
                        </div>
                        <div class="col-sm-10" style="margin:8px 0 0 25px;color: #999; font-size: 13px;">
                            Pick a month to view purchases
                        </div>
                    </div>
                    <table id="logs_table" class="table table-striped">
                        <thead>
                        <tr class="warning">
                            <th>Date</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div align="right" class="col-md-12 page_1">
                        <nav>
                            <ul id="table_pages" class="pagination">
                            </ul>
                        </nav>
                    </div>
<script>
//Edit btn - opens hidden div and populates it
function edit_table_row_func(){
    $("#addBlock").hide();
    $("#editBlock").show();

    var id = $(this).parent().parent().parent().find('#logID').val();
    console.log("id:" + id);
    var crr_date = $(this).parent().parent().parent().find('#crr_date').text();
    console.log("date is:" + crr_date);
    var crr_desc = $(this).parent().parent().parent().find('#crr_desc').text() || "";
    console.log("crr_desc:" + crr_desc);
    var crr_price = parseInt($(this).parent().parent().parent().find('#crr_price').text());
    console.log("crr_price:" + crr_price);

    $("#to_logID").val(id);
    $("#to_date").val(crr_date);
    $("#to_desc").val(crr_desc);
    $("#to_price").val(crr_price);
}

$("#cancelBtn").click(function () {
    $("#editBlock").hide();
    $("#addBlock").show();
});


//Delete table row
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
            $('#row_' + this.caller).find('#crr_desc').text(data.newDesc || "");
            $('#row_' + this.caller).find('#crr_price').text(data.newPrice).append(" USD");
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

function table_pages(number_of_pages, active_page){
    console.log("--- table_pages ---");
    console.log("number_of_pages: " + number_of_pages + " - active_page: " + active_page);
    number_of_pages = (number_of_pages > 0) ? number_of_pages : 1;
    active_page = (active_page < 1) ? 1 : ((active_page >= number_of_pages) ? number_of_pages : active_page);
    var table_pages_ul = $("#table_pages");
    table_pages_ul.empty();

    table_pages_ul.append(
        $("<li></li>").append(
            $("<a></a>").append(
                $("<i></i>").addClass("fa fa-angle-left")
            )
        ).attr("id", "page_previous").on("click", page_li_btn_event)
    );

    for(var i = 1; i <= number_of_pages; i++){
        var tmp_li = $("<li></li>").append(
            $("<a></a>").append(i)
        ).addClass("page_li_btn").on("click", page_li_btn_event);
        if(i == active_page){
            tmp_li.addClass("active");
        }
        table_pages_ul.append(tmp_li);
    }

    table_pages_ul.append(
        $("<li></li>").append(
            $("<a></a>").append(
                $("<i></i>").addClass("fa fa-angle-right")
            )
        ).attr("id", "page_next").on("click", page_li_btn_event)
    );
    if(active_page < 2){
        $("#page_previous").addClass("disabled");
    }
    if(active_page >= number_of_pages){
        $("#page_next").addClass("disabled");
    }
}

function table_rows(data){
    console.log("--- table_rows ---");
    console.log("data: " + JSON.stringify(data));
    var logs_table = $("#logs_table");
    $("#logs_table tr").not("thead tr").remove();

    for(row_idx in data){
        var row = data[row_idx];
        logs_table.append(
            $("<tr></tr>").attr("id", "row_" + row.id).append(
                $("<input/>").attr("id", "logID").attr("type", "hidden").val(row.id),
                $("<td></td>").attr("id", "crr_date").text(row.shopping_date),
                $("<td></td>").attr("id", "crr_desc").text(row.description || ""),
                $("<td></td>").attr("id", "crr_price").text(row.price + " USD"),
                $("<td></td>").append(
                    $("<ul></ul>").attr("id", "btns").addClass("nav nav-pills").append(
                        $("<li></li>").addClass("editBtn").append(
                            $("<a></a>").attr("href", "#Edit").append(
                                $("<i></i>").addClass("lnr lnr-pencil editValues")
                            )
                        ).on("click", edit_table_row_func),
                        $("<li></li>").attr("id", "del_id_" + row.id).addClass("deleteBtn").val(row.id).append(
                            $("<a></a>").append(
                                $("<i></i>").addClass("lnr lnr-trash")
                            )
                        ).on("click", delete_table_row_func)
                    )
                )
            )
        );
    }
}

function table_logs_datepicker_event(){
    console.log("--- table_logs_datepicker_event ---");
    var month_date = $("#logs_table_datepicker").val();
    var page = 1;
    var entries_per_page = 10;
    console.log(
        "month_date: " + month_date +
        " - page: " + page +
        " - entries_per_page: " + entries_per_page
    );

    $.get(
        "{!! URL::route('shopping_page_table_data') !!}",
        {
            month_date: month_date,
            page: page,
            entries_per_page: entries_per_page
        },
        function(data, status){
            if(status === "success"){
                table_rows(data.shopping_logs);
                table_pages(data.number_of_pages, data.page_number);
            }
        }
    );
}

function page_li_btn_event(){
    console.log("--- page_li_btn_event ---");
    var month_date = $("#logs_table_datepicker").val();
    var entries_per_page = 10;
    var page = ($(this).hasClass("page_li_btn")) ? $(this).find("a").first().html() : (
        ($(this).attr("id") == "page_previous") ?
        ($(this).parent().find(".active").first().find("a").first().html() - 1) :
        ($(this).parent().find(".active").first().find("a").first().html() - -1)
    );
    console.log(
        "month_date: " + month_date +
        " - page: " + page +
        " - entries_per_page: " + entries_per_page
    );

    if($(this).hasClass("disabled")){
        return;
    }

    $.get(
        "{!! URL::route('shopping_page_table_data') !!}",
    {
        month_date: month_date,
            page: page,
            entries_per_page: entries_per_page
    },
        function(data, status){
            if(status === "success"){
                table_rows(data.shopping_logs);
                table_pages(data.number_of_pages, data.page_number);
            }
        }
    );
}

$("#logs_table_datepicker").on("changeDate", table_logs_datepicker_event);
</script>
                </div>
            </div>
            <!--END Table -->
            <br>
        </div>
        <br><br><br>
    </div>

@endsection
