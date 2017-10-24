@extends('layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="row"> <h3 class="blank1">$CatName information</h3></div>
        <div class="row">
            {{--chart 1--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 25px; width: 20%">
                                <div class="input-group-addon" >
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="catDob" name="date" placeholder="MM/DD/YYYY"
                                       type="text" style="width: 110px;"/>
                            </div>
                            @include('layouts.datePicker')
                        </div>
                        <div class="col-lg-10">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Daily consumption</h4>
                        </div>
                    </div>

                    <div class="legend">
                        <div id="os-Mac-lbl">Food left<span></span></div>
                        <div id="os-Win-lbl">Food eaten<span></span></div>
                    </div>

                    <canvas id="pie" height="200" width="250" style="width: 470px; height: 315px;"></canvas>
                    <script>
                        var pieData = [
                            {
                                value: 10,
                                color: "#ef553a"
                            },
                            {
                                value: 100,
                                color: "#8BC34A"
                            }

                        ];
                        new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
                    </script>
                </div>
            </div>
            {{--chart 2--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="switch-right-grid">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="catDob" name="date" placeholder="MM/DD/YYYY"
                                       type="text" style="width: 110px;" onkeypress=""/>
                            </div>
                            @include('layouts.datePicker')
                        </div>
                        <div class="col-lg-10" style="margin-left: -40px">
                            <h4 style="margin-left: 50px; margin-top: -5px;">Daily</h4>
                        </div>
                        <div class="switch-right-grid1">
                            <p>All daily meals by eaten amount of food per meal</p>
                            <br/> <br/>
                        </div>
                        <div class="row" align="center"><canvas id="line1" height="137" width="400" style="width: 450px; height: 100px;"></canvas></div>

                        <script>
                            var lineChartData = {
                                labels: ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10",
                                    "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
                                datasets: [
                                    {
                                        fillColor: "#fff",
                                        strokeColor: "#9358AC",
                                        pointColor: "#fbfbfb",
                                        pointStrokeColor: "#9358AC",
                                        data: [20, 35, 45, 30, 10, 65, 40, 20, 35, 45, 30, 10, 65, 40, 20, 35, 45, 30, 10, 65, 40, 22, 23]
                                    }
                                ]

                            };
                            new Chart(document.getElementById("line1").getContext("2d")).Line(lineChartData);
                        </script>
                    </div>
                </div>

            </div>
            {{--chart 3--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="switch-right-grid">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="catDob" name="dateMonth" placeholder="MM/YYYY"
                                       type="text" style="width: 110px;"/>
                            </div>
                            @include('layouts.datePicker')
                        </div>
                        <div class="col-lg-10" style="margin-left: -40px">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Monthly</h4>
                        </div>
                        <div class="switch-right-grid1">
                            <p>All monthly meals by eaten amount of food per day</p>
                            <br/> <br/>
                        </div>
                        <div class="row" align="center"><canvas id="bar1" height="137" width="415"></canvas></div>

                    </div>

                    <script>
                        var barChartData = {
                            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10",
                                "11", "12", "13", "14", "15", "16", "17", "18", "19", "20",
                                "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
                            datasets: [
                                {
                                    fillColor: "#00ACED",
                                    strokeColor: "#00ACED",
                                    data: [25, 40, 50, 65, 55, 30, 20, 30, 20, 33, 25, 40, 50, 65, 55, 30, 20, 30, 33, 22, 25, 40, 50, 65, 55, 30, 20, 30, 14, 11, 11]
                                }
                            ]

                        };
                        new Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData);
                    </script>
                </div>

            </div>
        </div>

        <!-- Table-->
        <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
             data-widget-static="">



            <div class="panel-body no-padding">
                <div class="row">

                        <div class="col-sm-2">
                        <div class="input-group" style="margin: 0px 0px 10px 0px; width: 20%">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="form-control" id="logsMonth" name="dateMonth" placeholder="MM/YYYY"
                                   type="text" style="width: 100px; "/>
                        </div>
                    </div>
                    <div class="col-sm-10" style="color: #999; font-size: 13px;margin: 10px 0px 10px -60px">Pick a month or view 10 last feeding logs</div>


                </div>
                <table class="table table-striped">
                    <thead>
                    <tr class="warning">
                        <th>Opened time</th>
                        <th>Closed time</th>
                        <th>Toatl time</th>
                        <th>Amout of food</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
                    <tr>
                        <td>2017-10-14 00:00:00</td>
                        <td>2017-10-14 00:00:05</td>
                        <td>5 sec</td>
                        <td>50 gram</td>
                    </tr>
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
        <!--END Table-->

        <!--Edit Cat information-->
        <div class="row">
            <div class="col-md-12">
                <div class="banner-bottom-video-grid-left">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title asd">
                                    <a class="pa_italic collapsed" role="button" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                       aria-controls="collapseThree">
                                        <span class="lnr lnr-chevron-down"></span><i
                                                class="lnr lnr-chevron-up"></i><label>Edit $Cat's information</label>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingThree">
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


    </div>
    <br/><br/>
    <br/><br/>




@endsection