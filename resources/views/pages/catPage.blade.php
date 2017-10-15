@extends('layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">



            ///


            ///
            <h3 class="blank1">Cat Name information</h3>
                <h1 style="color: red">ADD DATE PICKER SHOW CHARTS FOR CHOSEN DATE/Dates with pagination</h1>
                <div class="graph_box">
                    <div class="col-md-4 grid_2">

                    </div>
                    <div class="col-md-4 grid_2">

                    </div>
                    <div class="col-md-4 grid_2">

                    </div>
                    <div class="clearfix"></div>
                </div>
                <!---728x90--->
                <div class="graph_box1">
                    <div class="col-md-5 grid_2 grid_2_bot">
                        <div class="grid_1">

                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="catDob" name="date" placeholder="MM/DD/YYYY" type="text" style="width: 120px;"/>
                                    </div>
                                    @include('layouts.datePicker')
                                </div>
                                <div class="col-lg-11">
                                    <h4>Daily consumption</h4>
                                </div>
                            </div>






                            <div class="legend">
                                <div id="os-Mac-lbl">Food left<span></span></div>
                                <div id="os-Win-lbl">Food eaten<span></span></div>
                            </div>

                            <canvas id="pie" height="315" width="400" style="width: 470px; height: 315px;"></canvas>
                            <script>
                                var pieData = [
                                    {
                                        value: 10,
                                        color: "#ef553a"
                                    },
//                                {
//                                    value: 50,
//                                    color: "#00aced"
//                                },
                                    {
                                        value: 100,
                                        color: "#8BC34A"
                                    }

                                ];
                                new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
                            </script>
                        </div>
                    </div>
                    <div class="col-md-7 grid_2 grid_2_bot">
                        <div class="grid_1">
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="catDob" name="date" placeholder="MM/DD/YYYY" type="text" style="width: 120px;" onkeypress=""/>
                                    </div>
                                    @include('layouts.datePicker')
                                </div>
                                <div class="col-lg-11" style="margin-left: -40px">
                                    <h4>Daily</h4>
                                </div>
                            </div>
                            <canvas id="line1" height="100" width="800" style="width: 600px; height: 100px;"></canvas>
                            <script>
                                var lineChartData = {
                                    labels: ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10",
                                        "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22","23"],
                                    datasets: [
                                        {
                                            fillColor: "#fff",
                                            strokeColor: "#9358AC",
                                            pointColor: "#fbfbfb",
                                            pointStrokeColor: "#9358AC",
                                            data: [20, 35, 45, 30, 10, 65, 40, 20, 35, 45, 30, 10, 65, 40, 20, 35, 45, 30, 10, 65, 40,22,23]
                                        }
                                    ]

                                };
                                new Chart(document.getElementById("line1").getContext("2d")).Line(lineChartData);
                            </script>
                        </div>
                        <div class="line-bottom-grid">
                            <div class="grid_1">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" id="catDob" name="date" placeholder="MM/DD/YYYY" type="text" style="width: 120px;"/>
                                        </div>
                                        @include('layouts.datePicker')
                                    </div>
                                    <div class="col-lg-11" style="margin-left: -40px">
                                        <h4>Monthly</h4>
                                    </div>
                                </div>
                                <canvas id="bar1" height="100" width="800" style="width: 600px; height: 100px;"></canvas>
                                <script>
                                    var barChartData = {
                                        labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10",
                                            "11", "12", "13", "14", "15", "16", "17", "18", "19","20",
                                            "21", "22", "23", "24", "25", "26", "27", "28", "29","30","31"],
                                        datasets: [
                                            {
                                                fillColor: "#00ACED",
                                                strokeColor: "#00ACED",
                                                data: [25, 40, 50, 65, 55, 30, 20, 30, 20, 33, 25, 40, 50, 65, 55, 30, 20, 30, 33, 22, 25, 40, 50, 65, 55, 30, 20, 30, 14, 11,11]
                                            }
                                        ]

                                    };
                                    new Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData);
                                </script>
                            </div>
                        </div>
                    </div>
                <div class="clearfix"></div>
            </div>



            <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                 data-widget-static="">
                <h1 style="color: red">ADD DATE PICKER SHOW LOGS FOR CHOSEN DATE</h1>
                <div class="panel-body no-padding">
                    <h4 style="margin-left: -15px; color: gray"> Last 10 logs:</h4>
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
                </div>
            </div>

            <br/>

        </div>
    </div>
    </div>
<br/><br/>





@endsection