@extends('layouts.master')
@section('content')

    <div id="page-wrapper">

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
                                    id="catDob"
                                    name="date"
                                    placeholder="YYYY-MM-DD"
                                    style="width: 110px;"
                                    type="text"
                                    value="{!! $today->format('Y-m-d') !!}"
                                />
                            </div>
                            @include('layouts.datePicker')
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
                        var pieData = [
                            {
                                value: {!! $daily_consumption['ate_allowance'] !!},
                                color: "#00ACED"
                            },
                            {
                                value: {!! $daily_consumption['food_left'] !!},
                                color: "#8BC34A"
                            },
                            {
                                value: {!! $daily_consumption['over_ate'] !!},
                                color: "#EF553A"
                            }
                        ];
                        new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
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
                                    id="catDob"
                                    name="date"
                                    onkeypress=""
                                    placeholder="YYYY-MM-DD"
                                    style="width: 110px;"
                                    type="text"
                                    value="{!! $today->format('Y-m-d') !!}"
                                />
                            </div>
                            @include('layouts.datePicker')
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
                            var lineChartData = {
                                labels: {!! $daily_logs_labels !!},
                                datasets: [
                                    {
                                        fillColor: "#fff",
                                        strokeColor: "#9358AC",
                                        pointColor: "#fbfbfb",
                                        pointStrokeColor: "#9358AC",
                                        data: {!! $daily_logs !!}
                                    }
                                ]
                            };
                            new Chart(document.getElementById("line1").getContext("2d")).Line(lineChartData);
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
                                    id="catDob"
                                    name="dateMonth"
                                    placeholder="YYYY-MM-DD"
                                    style="width: 110px;"
                                    type="text"
                                    value="{!! $today->format('Y-m') !!}"
                                />
                            </div>
                            @include('layouts.datePicker')
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
                        var barChartData = {
                            labels: {!! $month_logs_labels !!},
                            datasets: [
                                {
                                    fillColor: "#00ACED",
                                    strokeColor: "#00ACED",
                                    data: {!! $month_logs !!}
                                }
                            ]
                        };
                        new Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData);
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
                        <input class="form-control" id="logsMonth" name="dateMonth" alt="dateMonth" placeholder="YYYY-MM"
                               type="text" style="width: 90px; "/>
                    </div>
                </div>
                <div class="col-sm-10" style="margin:8px 0 0 25px;color: #999; font-size: 13px;">
                    Pick a month or view 10 last visits
                </div>
            </div>
                {{--</div>--}}
                {{--</div>--}}
                <table class="table table-striped">
                    <thead>
                    <tr class="warning">
                        <th>Opened time</th>
                        <th>Closed time</th>
                        <th>Total time</th>
                        <th>Amount of food</th>
                    </tr>
                    </thead>
                    @foreach($feeding_logs as $row)
                        <tr>
                            <td>{!! $row->open_time !!}</td>
                            <td>{!! $row->close_time !!}</td>
                            <td>{!! (date_create($row->close_time)->diff(date_create($row->open_time)))->format("%i minutes, %s seconds") !!}</td>
                            <td>{!! $row->start_weight - $row->end_weight !!}</td>
                        </tr>
                    @endforeach
                </table>
                <!--END Table-->

                <div align="right" class="col-md-12 page_1">
                    <nav>
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-angle-left">
                                    </i>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">
                                    1
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            @for($i=1; $i < $number_of_pages; $i++)
                                <li>
                                    <a href="#">
                                        {!! $i !!}
                                    </a>
                                </li>
                            @endfor
                            <li class="{!! ($number_of_pages < 2) ? 'disabled' : '' !!}">
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-angle-right">
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        {{--<div id="editCat" class="editCat"></div>--}}
        <!--Edit Cat information-->
        <div class="row">
            <div class="col-md-12">
                <div class="banner-bottom-video-grid-left">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title asd">
                                    <a
                                        aria-controls="collapseThree"
                                        aria-expanded="false"
                                        class="pa_italic collapsed"
                                        data-parent="#accordion"
                                        data-toggle="collapse"
                                        href="#collapseThree"
                                        role="button"
                                    >
                                        <span class="lnr lnr-chevron-down"></span>
                                        <i class="lnr lnr-chevron-up">
                                        </i>
                                        <label>Edit {!! $cat['cat_name'] !!}'s information</label>
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


@endsection

