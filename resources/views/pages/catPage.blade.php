@extends('layouts.master')
@section('content')

    <div id="page-wrapper">

        @include('layouts.datePicker')
        <div class="row">
            <h3 class="blank1">{!! $cat['cat_name'] !!} information</h3>
        </div>

        <div class="graph_box">
            {{-- Chart1 Daily consumption --}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 25px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>

                                <input
                                    alt="date"
                                    class="form-control"
                                    id="daily_consumption_datepicker"
                                    name="date"
                                    placeholder="YYYY-MM-DD"
                                    style="width: 110px;"
                                    type="text"
                                    value="{!! $today->format('Y-m-d') !!}"
                                />
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Daily consumption</h4>
                        </div>
                    </div>
                    <div class="legend" style="width: 105px; margin: 0 0 0 25px">
                        <div id="os-Other-lbl">
                            Food eaten
                            <span></span>
                        </div>
                        <div id="os-Win-lbl">
                            Food left
                            <span></span>
                        </div>

                        <div id="os-Mac-lbl">
                            Food overeaten
                            <span></span>
                        </div>
                    </div>

                    <center>
                        <canvas id="pie" height="200" width="250"
                                style="background: none; width: 470px; height: 315px;">
                        </canvas>
                    </center>

<script>
function daily_consumption(){
    console.log("--- daily_consumption ---");
    var day_date = $("#daily_consumption_datepicker").val();
    var cat_id = {!! $cat->id !!};
    console.log("date: " + day_date + " - cat_id: " + cat_id);

    $.get(
        "{!! URL::route('cat_page_consumption') !!}",
    {
        cat_id: cat_id,
            day_date: day_date
    },
        function(data, status){
            console.log("status: " + status);
            console.log("data: " + JSON.stringify(data));
                if(status === "success"){
                    var pie_data = [
                {
                    value: data.ate_allowance,
                        color: "#00ACED"
                },
                {
                    value: data.food_left,
                        color: "#8BC34A"
                },
                {
                    value: data.over_ate,
                        color: "#EF553A"
                }
                    ];
                    console.log("pie_data: " + JSON.stringify(pie_data))
                        new Chart(document.getElementById("pie").getContext("2d")).Pie(pie_data);
                }
        }
    );
}
$("#daily_consumption_datepicker").on("changeDate", daily_consumption);
</script>
                </div>
            </div>

            {{-- Chart2 Daily --}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="switch-right-grid">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>

                                <input
                                    alt="date"
                                    class="form-control"
                                    id="daily_logs_datepicker"
                                    name="date"
                                    onkeypress=""
                                    placeholder="YYYY-MM-DD"
                                    style="width: 110px;"
                                    type="text"
                                    value="{!! $today->format('Y-m-d') !!}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-10" style="margin-left: -40px">
                            <h4 style="margin-left: 50px; margin-top: -5px;">Daily</h4>
                        </div>

                        <div class="switch-right-grid1">
                            <p>All daily meals by eaten amount of food per meal</p>
                            <br/><br/>
                        </div>

                        <div class="row" align="center">
                            <canvas id="line1" height="137" width="400" style="width: 450px; height: 100px;"></canvas>
                        </div>

<script>
function daily_logs(){
    console.log("--- daily_logs ---");
    var day_date = $("#daily_logs_datepicker").val();
    var cat_id = {!! $cat->id !!};
    console.log("date: " + day_date + " - cat_id: " + cat_id);

    $.get(
        "{!! URL::route('cat_page_daily_logs') !!}",
    {
        cat_id: cat_id,
            day_date: day_date
    },
        function(data, status){
        console.log("status: " + status);
        console.log("data: " + JSON.stringify(data));
        if(status === "success"){
            data.unshift(0);
            var daily_logs_labels = [];
            for(var i = 0; i < data.length; i++){
                daily_logs_labels.push('' + i);
            }
            console.log("daily_logs_labels: " + daily_logs_labels);
            new Chart(document.getElementById("line1").getContext("2d")).Line(
                {
                    labels: daily_logs_labels,
                    datasets: [{
                        fillColor: "#FFF",
                        strokeColor: "#9358AC",
                        pointColor: "#FBFBFB",
                        pointStrokeColor: "#9358AC",
                        data: data
                    }]
                }
            );
        }
    }
);
}
$("#daily_logs_datepicker").on("changeDate", daily_logs);
</script>
                    </div>
                </div>
            </div>

            {{-- Chart3 Monthly --}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="switch-right-grid">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>

                                <input
                                    alt="dateMonth"
                                    class="form-control"
                                    id="monthly_logs_datepicker"
                                    name="dateMonth"
                                    placeholder="YYYY-MM"
                                    style="width: 110px;"
                                    type="text"
                                    value="{!! $today->format('Y-m') !!}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-10" style="margin-left: -40px">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Monthly</h4>
                        </div>

                        <div class="switch-right-grid1">
                            <p>All monthly meals by eaten amount of food per day</p>
                            <br/><br/>
                        </div>

                        <div class="row" align="center">
                            <canvas id="bar1" height="137" width="415"></canvas>
                        </div>
                    </div>

<script>
function monthly_logs(){
    console.log("--- monthly_logs ---");
    var month_date = $("#monthly_logs_datepicker").val();
    var cat_id = {!! $cat->id !!};
    console.log("date: " + month_date + " - cat_id: " + cat_id);

    $.get(
        "{!! URL::route('cat_page_monthly_logs') !!}",
    {
        cat_id: cat_id,
            month_date: month_date
    },
        function(data, status){
            console.log("status: " + status);
            console.log("data: " + JSON.stringify(data));
            if(status === "success"){
                var month_logs_labels = [];
                for(var i = 1; i <= data.length; i++){
                    month_logs_labels.push(i);
                }
                console.log("month_logs_labels: " + month_logs_labels);
            }

            var bar_chart_data = {
                labels: month_logs_labels,
                datasets: [{
                    fillColor: "#00ACED",
                    strokeColor: "#00ACED",
                    data: data
                }]
            };
            console.log(JSON.stringify(bar_chart_data));
            new Chart(document.getElementById("bar1").getContext("2d")).Bar(bar_chart_data);
        }
    );
}
$("#monthly_logs_datepicker").on("changeDate", monthly_logs);
</script>
                </div>
            </div>
        </div>

        <div class="clearfix">
        </div>

        <!-- Table-->
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
                            style="width: 90px;"
                            type="text"
                            value="{!! $today->format('Y-m') !!}"
                        />
                    </div>
                </div>
                <div class="col-sm-10" style="margin:8px 0 0 25px;color: #999; font-size: 13px;">
                    Pick a month or view 10 last visits
                </div>
            </div>
                {{--</div>--}}
                {{--</div>--}}
                <table id="logs_table" class="table table-striped">
                    <thead>
                        <tr class="warning">
                            <th>Opened time</th>
                            <th>Closed time</th>
                            <th>Total time</th>
                            <th>Amount of food</th>
                        </tr>
                    </thead>
                </table>

                <div align="right" class="col-md-12 page_1">
                    <nav>
                        <ul id="table_pages" class="pagination">
                        </ul>
                    </nav>
                </div>
<script>
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
        var diff_dates = new Date((new Date(row.close_time)) - (new Date(row.open_time)));
        var diff_minutes = diff_dates.getMinutes();
        var diff_seconds = diff_dates.getSeconds();
        logs_table.append(
            $("<tr></tr>").append(
                $("<td></td>").text(row.open_time),
                $("<td></td>").text(row.close_time),
                $("<td></td>").text(diff_minutes + " minutes, " + diff_seconds + " seconds"),
                $("<td></td>").text((row.start_weight - row.end_weight).toFixed(1)).append("&nbsp; &nbsp; Gram"),
            )
        );
    }
}

function table_logs_datepicker_event(){
    console.log("--- table_logs_datepicker_event ---");
    var month_date = $("#logs_table_datepicker").val();
    var cat_id = {!! $cat->id !!};
    var page = 1;
    var entries_per_page = 10;
    console.log(
        "month_date: " + month_date +
        " - cat_id: " + cat_id +
        " - page: " + page +
        " - entries_per_page: " + entries_per_page
    );

    $.get(
        "{!! URL::route('cat_page_table_logs') !!}",
    {
        month_date: month_date,
            cat_id: cat_id,
            page: page,
            entries_per_page: entries_per_page
    },
    function(data, status){
        if(status === "success"){
            table_rows(data.feeding_logs);
            table_pages(data.number_of_pages, data.page_number);
        }
    }
);
}

function page_li_btn_event(){
    console.log("--- page_li_btn_event ---");
    var month_date = $("#logs_table_datepicker").val();
    var cat_id = {!! $cat->id !!};
    var entries_per_page = 10;
    var page = ($(this).hasClass("page_li_btn")) ? $(this).find("a").first().html() : (
        ($(this).attr("id") == "page_previous") ?
        ($(this).parent().find(".active").first().find("a").first().html() - 1) :
        ($(this).parent().find(".active").first().find("a").first().html() - -1)  // Haha...
    );
    console.log(
        "month_date: " + month_date +
        " - cat_id: " + cat_id +
        " - page: " + page +
        " - entries_per_page: " + entries_per_page
    );

    if($(this).hasClass("disabled")){
        return;
    }

    $.get(
        "{!! URL::route('cat_page_table_logs') !!}",
    {
        month_date: month_date,
            cat_id: cat_id,
            page: page,
            entries_per_page: entries_per_page
    },
        function(data, status){
            if(status === "success"){
                table_rows(data.feeding_logs);
                table_pages(data.number_of_pages, data.page_number);
            }
        }
    );
}

$("#logs_table_datepicker").on("changeDate", table_logs_datepicker_event);
</script>
        <!--END Table-->
        </div>
        {{--<div id="editCat" class="editCat"></div>--}}
        <!--Edit Cat information-->
        <div id="EditCat" class="row">
            <div class="col-md-12">
                <div class="banner-bottom-video-grid-left">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title asd" style="width: 100%;">
                                    <a
                                        aria-controls="collapseThree"
                                        aria-expanded="false"
                                        style="width: 100%;"
                                        class="pa_italic collapsed"
                                        data-parent="#accordion"
                                        data-toggle="collapse"
                                        href="#collapseThree"
                                        role="button"
                                    >
                                        <span class="lnr lnr-chevron-down"></span>
                                        <i class="lnr lnr-chevron-up">
                                        </i>
                                        <label style="width: 80%;">Edit {!! $cat['cat_name'] !!}'s information</label>
                                    </a>
                                </h4>
                            </div>
                            <div
                                aria-labelledby="headingThree"
                                class="panel-collapse collapse"
                                id="collapseThree"
                                role="tabpanel"
                            >
                                <div class="panel-body panel_text">
                                    <!-- Change Cat info -->
                                    <script>
                                        $(document).ready(function () {
                                            $('#title').html('Edit information:');
                                        });
                                    </script>
                                    @include("layouts.catFields")
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br/><br/><br/><br/>

        <script>
            $(document).ready(function() {
                var referrer =  document.referrer;
                if (referrer.indexOf("addCat") > -1) {
                    $("#collapseThree").removeClass("collapse");
                    setTimeout(function() {
                        scrollToAnchor('EditCat');
                    }, 2000);
                }

            });
            //Anchor
            function scrollToAnchor(aid){
                var aTag = $('#'+ aid);
                $('html,body').animate({scrollTop: aTag.offset().top},'slow');
            }
        </script>
@endsection

