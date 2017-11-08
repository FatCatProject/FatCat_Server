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
                                <input class="form-control" id="monthlyFoodRatio" name="dateMonth" alt="dateMonth"
                                       placeholder="YYYY-MM"
                                       type="text" style="width: 90px;"/>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Monthly ratio of food</h4>
                        </div>
                    </div>
                    <div id="ratio_legend" class="legend" style="margin:0 0 0 25px">
                    </div>
                    <div align="center">
                        <canvas id="pie" height="200" width="200" style="width: 100px; height: 100px;"></canvas>
                    </div>
                </div>
<script>
function ratioPie(){
    console.log("ratioPie -- ");
    var month_date = $("#monthlyFoodRatio").val();
    console.log(month_date);

    $.get(
        "{!! URL::route('home_page_ratio') !!}",
    {
        date: month_date
    },
        function(data, status){
            if(status === "success"){
                var colors = [
                    ["os-Mac-lbl", "#EF553A"],
                    ["os-Win-lbl", "#8BC34A"],
                    ["os-Other-lbl", "#00ACED"]
                ];
                var colors_index = 0;

                $("#ratio_legend").empty();
                var pie_data = [];
                for(i = 0; i < data.length; i++){
                    $("#ratio_legend").append(
                        $("<div></div>").append(
                            data[i].cat_name,
                            $("<span></span>").text(Math.round(data[i].eaten) + " grams")
                        ).attr("id", colors[colors_index][0])
                    );
                    pie_data.push(
                    {
                        value: Math.round(data[i].eaten),
                            color: colors[colors_index][1]
                    }
                );
                    colors_index = ((colors_index + 1) < colors.length) ? (colors_index + 1) : 0;
                }

                new Chart(document.getElementById("pie").getContext("2d")).Pie(pie_data);
            }
        }
    );
}
$("#monthlyFoodRatio").on("change", ratioPie);
$(document).ready(ratioPie);
</script>
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
                                    <input class="form-control" id="catDob" name="dateYear" alt="dateYear"
                                           placeholder="YYYY"
                                           type="text" style="width: 90px;"/>
                                </div>
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
                                <input class="form-control" id="monthlyFoodRatio" name="dateYear" alt="dateYear"
                                       placeholder="YYYY"
                                       type="text" style="width: 90px;"/>
                            </div>
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
        @php ($index = 0)
        @for($row=0;$row<$numberOfRows;$row++)
            <div class="row">
                @for(;$index<count($cats);$index++)
                    <div class="col-md-4">
                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                        src="https://cdn2.iconfinder.com/data/icons/cat-power/128/cat_drunk.png"
                                        width="100px"></i>
                            <div class="stats">
                                <h5>50 <span>gr</span></h5>
                                <div class="grow">
                                    <p>{!! $cats[$index]['cat_name'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <br>
        @endfor
    </div>
    @include('layouts.datePicker')
@endsection
