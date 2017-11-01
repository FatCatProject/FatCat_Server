@extends('layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            {{--chart 1--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 25px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="monthlyFoodRatio" name="dateMonth" placeholder="MM/YYYY"
                                       type="text" style="width: 90px;"/>
                            </div>
                            @include('layouts.datePicker')
                        </div>
                        <div class="col-lg-10">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Monthly ratio of food</h4>
                        </div>
                    </div>
                    <div class="legend" style="margin:0 0 0 25px">
                        <div id="os-Mac-lbl">Cat 1<span>$x grams</span></div>
                        <div id="os-Win-lbl">Cat 2<span>$x grams</span></div>
                        <div id="os-Other-lbl">Cat 3<span>$x grams</span></div>
                    </div>
                    <div align="center">
                        <canvas id="pie" height="200" width="200" style="width: 100px; height: 100px;"></canvas>
                    </div>
                    <script>
                        var pieData = [
                            {
                                value: 30,
                                color: "#ef553a"
                            },
                            {
                                value: 50,
                                color: "#8BC34A"
                            },
                            {
                                value: 40,
                                color: "#00ACED"
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
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="input-group" style="margin: 15px 0px 0px 15px; width: 20%">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control" id="catDob" name="dateYear" placeholder="YYYY"
                                           type="text" style="width: 90px;"/>
                                </div>
                                @include('layouts.datePicker')
                            </div>
                            <div class="col-lg-10" style="margin-left: -40px">
                                <h4 style="margin-left: 80px; margin-top: -5px;">Yearly expenses</h4>
                            </div>
                        </div>

                        <div class="switch-right-grid1" style="padding: 0 0 0 15px">
                            <p>Yearly expenses for all cats by month</p>
                            <br/>
                        </div>
                        <div class="row" align="center">
                            <canvas id="bar1" height="155" width="390"></canvas>
                        </div>
                    </div>
                    <script>
                        var barChartData = {
                            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
                            datasets: [
                                {
                                    fillColor: "#00ACED",
                                    strokeColor: "#00ACED",
                                    data: [25, 40, 0, 65, 55, 30, 0, 30, 20, 33, 25, 40]
                                }
                            ]
                        };
                        new Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData);
                    </script>
                </div>
            </div>
            {{--chart 3--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 25px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="monthlyFoodRatio" name="dateYear" placeholder="YYYY"
                                       type="text" style="width: 90px;"/>
                            </div>
                            @include('layouts.datePicker')
                        </div>
                        <div class="col-lg-10">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Yearly vet visits</h4>
                        </div>
                    </div>
                    <div class="legend" style="margin:0 0 0 25px">
                        <div id="os-Mac-lbl">Cat 1<span>$x times</span></div>
                        <div id="os-Win-lbl">Cat 2<span>$x times</span></div>
                        <div id="os-Other-lbl">Cat 3<span>$x times</span></div>
                    </div>
                    <div align="center">
                        <canvas id="doughnut" height="200" width="200" style="width: 100px; height: 100px;"></canvas>
                    </div>
                    <script>
                        var doughnutData = [
                            {
                                value: 30,
                                color: "#F44336"
                            },
                            {
                                value: 50,
                                color: "#8BC34A"
                            },
                            {
                                value: 100,
                                color: "#00aced"
                            },
                        ];
                        new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
                    </script>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            {{--chart 1--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="row">
                    </div>
                </div>
            </div>
            {{--chart 2--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="row">
                    </div>
                </div>
            </div>
            {{--chart 3--}}
            <div class="col-sm-4">
                <div class="grid_1">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="r3_counter_box">
                    <i class="fa" style="width: 150px; margin-left: -30px"><img
                                src="https://cdn2.iconfinder.com/data/icons/cat-power/128/cat_drunk.png" width="100px"></i>
                    <div class="stats">
                        <h5>50 <span>gr</span></h5>
                        <div class="grow">
                            <p>Cat name</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="r3_counter_box">
                    <i class="fa" style="width: 150px; margin-left: -30px"><img
                                src="https://cdn3.iconfinder.com/data/icons/cat-force/128/cat_paper.png" width="100px"></i>
                    <div class="stats">
                        <h5>150 <span>gr</span></h5>
                        <div class="grow grow1">
                            <p>Cat name</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="r3_counter_box">
                    <i class="fa" style="width: 150px; margin-left: -30px"><img
                                src="https://cdn3.iconfinder.com/data/icons/cat-force/128/cat_upsidedown.png"
                                width="100px"></i>
                    <div class="stats">
                        <h5>10 <span>gr</span></h5>
                        <div class="grow grow3">
                            <p>Cat name</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection