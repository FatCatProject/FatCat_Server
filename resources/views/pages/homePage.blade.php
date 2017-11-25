@extends('layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="row home">
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
                                       placeholder="YYYY-MM" value="{!! (new DateTime())->format('Y-m') !!}"
                                       type="text" style="width: 90px;"/>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Monthly food ratio</h4>
                        </div>
                    </div>
                    <div id="ratio_legend" class="legend" style="margin:0 0 0 25px">
                    </div>
                    <div align="center">
                        <canvas id="pie" height="250" width="250" style="width: 470px; height: 315px;"></canvas>
                    </div>
                </div>
<script>
function ratioPie(){
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

                $("#pie").css("height","200px").css("width","200px");
            }
        }
    );
}
$("#monthlyFoodRatio").on("changeDate", ratioPie);
// $(document).ready(ratioPie);
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
                                    <input class="form-control" id="yearly_expenses_datepicker" name="dateYear" alt="dateYear"
                                           placeholder="YYYY" value="{!! (new DateTime())->format('Y') !!}"
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
function expenses_bar_chart(){
    var year_date = $("#yearly_expenses_datepicker").val();
    console.log(year_date);

    $.get(
        "{!! URL::route('home_page_expenses') !!}",
    {
        year: year_date
    },
        function(data, status){
            console.log(JSON.stringify(data));
            if(status === "success"){
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
            }
            $("#bar1").css("height","155px").css("width","390px").css("font-size","10px");
        }
    );
}
$("#yearly_expenses_datepicker").on("changeDate", expenses_bar_chart);

// $(document).ready(expenses_bar_chart);
</script>
                </div>
            </div>
            {{--chart 3--}}
            <div class="col-sm-4" >
                <div class="grid_1">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="input-group" style="margin: 15px 0px 0px 25px; width: 20%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="vet_visits_datepicker" name="dateYear" alt="dateYear"
                                       placeholder="YYYY" value="{!! (new DateTime())->format('Y') !!}"
                                       type="text" style="width: 90px;"/>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 style="margin-left: 80px; margin-top: -5px;">Yearly vet visits</h4>
                        </div>
                    </div>
                    <div id="doughnut_legend" class="legend" style="margin:0 0 0 25px">
                    </div>
                    <div align="center">
                        <canvas id="doughnut" height="250" width="250" style="width: 470px; height: 315px;"></canvas>
                    </div>

                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <!-- The Close Button -->
                        <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                        <!-- Modal Content (The Image) -->
                        <img class="modal-content" id="img01">
                        <!-- Modal Caption (Image Text) -->
                        <div id="caption"></div>
                    </div>
                    <!-- The Modal -->
<script>
function visits_doughnut(){
    var year_date = $("#vet_visits_datepicker").val();
    console.log(year_date);

    $.get(
        "{!! URL::route('home_page_vet_visits') !!}",
    {
        year: year_date
    },
        function(data, status){
            if(status === "success"){
                var colors = [
                    ["os-Mac-lbl", "#EF553A"],
                    ["os-Win-lbl", "#8BC34A"],
                    ["os-Other-lbl", "#00ACED"]
                ];
                var colors_index = 0;

                $("#doughnut_legend").empty();
                var doughnut_data = [];
                for(i = 0; i < data.length; i++){
                    $("#doughnut_legend").append(
                        $("<div></div>").append(
                            data[i].cat_name,
                            $("<span></span>").text(Math.round(data[i].visits) + " visits")
                        ).attr("id", colors[colors_index][0])
                    );
                    doughnut_data.push(
                    {
                        value: data[i].visits,
                            color: colors[colors_index][1]
                    }
                );
                    colors_index = ((colors_index + 1) < colors.length) ? (colors_index + 1) : 0;
                }

                new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnut_data);
                $("#doughnut").css("height","200px").css("width","200px");
            }
        }
    );
}
$("#vet_visits_datepicker").on("changeDate", visits_doughnut);
// $(document).ready(ratioPie);
</script>

                </div>
            </div>
        </div>
        <br>
<script>
$(document).ready(
    function(){
        var foodbox_data = {!! $foodbox_data !!};
        for(var foodbox_idx = 0; foodbox_idx < foodbox_data.length;){ 
            var tmp_row = $("<div></div>").addClass("row");
            for(var j = 0; j < 3 && foodbox_idx < foodbox_data.length; j++, foodbox_idx++){
                tmp_row.append(
                    $("<div></div>").append(
                        $("<div></div>").append(
                            $("<i></i>").append(
                                $("<img/>").addClass("myImg").attr("src", foodbox_data[foodbox_idx].profile_picture)
                            ).addClass("fa").css({
                                "width": "150px",
                                "margin-left": "-30px"
                            }),
                            $("<div></div>").append(
                                $("<h5></h5>").append(
                                    foodbox_data[foodbox_idx].current_weight,
                                    $("<span></span>").text("gr")
                                ),
                                $("<div></div>").append(
                                    $("<p></p>").text(foodbox_data[foodbox_idx].foodbox_name)
                                ).addClass("grow").css('background','#EA7E2F')
                            ).addClass("stats")
                        ).addClass("r3_counter_box")
                    ).addClass("col-md-4")
                );
            }
            $("#page-wrapper").append(
                tmp_row,
                $("<br/>")
            );
        } image_popout();
    }
);

function image_popout() {
// Get the modal
    var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = $('.myImg');
    var modalImg = $("#img01");
    var captionText = document.getElementById("caption");
    $('.myImg').click(function () {
        modal.style.display = "block";
        var newSrc = this.src;
        modalImg.attr('src', newSrc);
        captionText.innerHTML = this.alt;
    });

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
}



</script>
    </div>
    @include('layouts.datePicker')
@endsection
