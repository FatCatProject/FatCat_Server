@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Vet entries for {!! $cat['cat_name'] !!}:</h3>
            <div class="row">
                <div class="col-sm-7">
                    <div class="tab-content" style="padding:0px">
        <div class="tab-pane active" id="horizontal-form">
        <form class="form-horizontal" enctype="multipart/form-data"  method="POST" action="/addvetlog" id="addvetlog">
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{!! $cat['id'] !!}">
        <input type="hidden" value="{{csrf_token()}}" name="_token">
        <div class="form-group">
            <label for="catDob" class="col-sm-2 control-label">Date: <span style="color: red;">*</span></label>
            <div class="row" style="padding: 10px">
                <div class="input-group" style="margin: 0px 0px 0px 15px">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="visit_date" name="date" alt="date"
                           placeholder="YYYY-MM-DD"
                           type="text" required style="width: 120px;"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Clinic:</label>
            <div class="col-sm-8">
                <input type="text" name="clinic_name" class="form-control1" id="clinicLogName" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Subject:</label>
            <div class="col-sm-8">
                <input type="text" name="subject" class="form-control1" id="vetLogSubject" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="txtarea1" class="col-sm-2 control-label">Description:</label>
            <div class="col-sm-8"><textarea name="description" id="vetLogDescription"
                                            cols="50"
                                            rows="10" class="form-control1"
                                            style="min-height: 70px"></textarea></div>
        </div>
        <div class="form-group">
            <label for="profilePicture" class="col-sm-2 control-label">Picture:</label>
            <div class="col-sm-8">
                <input type="file" name="prescription_picture" id="prescription_picture" class="filestyle"
                       style="margin-top: 6px">
            </div>

        </div>
        <div class="form-group">
            <label for="smallinput" class="col-sm-2 control-label label-input-sm">Price:</label>
            <div class="col-sm-8">
                <input type="number" name="price" step="any" min="0" max="10000" class="form-control1 input-sm"
                       id="vetLogPrice" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <button type="submit" class="btn-success btn" form="addvetlog">Add</button>
                    <button type="reset" class="btn-inverse btn">Reset</button>
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
                Pick a year to see the expenses for a specific year
            </div>
        </div>
        <div class="row">
            <div align="center">
                <canvas id="bar1" height="207" width="450px" style="width:450px; height: 100px;"></canvas>
                <script>
                    var barChartData = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [
                            {

                                fillColor: "#00BCD4",
                                strokeColor: "#00BCD4",
                                data: [25, 40, 50, 65, 55, 30, 20, 10, 6, 4, 20, 30]
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
        <input class="form-control" id="logsMonth" name="dateMonth" alt="dateMonth" placeholder="YYYY-MM"
               type="text" style="width: 90px; "/>
    </div>
</div>
<div class="col-sm-10" style="margin:8px 0 0 25px;color: #999; font-size: 13px;">
    Pick a month or view 10 last visits
</div>
</div>
<table class="table table-striped">
<thead>
<tr class="warning">
    <th>Date</th>
    <th>Clinic</th>
    <th>Subject</th>
    <th>Description</th>
    <th>Picture</th>
    <th>Price</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($vetLogs as $log)
<tr id="1">
    <td class="editableColumns">{!! $log->visit_date !!}</td>
    <td class="editableColumns">{!! $log->clinic_name !!}</td>
    <td class="editableColumns">{!! $log->subject !!}</td>
    <td class="editableColumns">{!! $log->description !!}</td>
    <td class="editableColumns">{!! base64_decode($log->prescription_picture) !!}</td>
    <td class="editableColumns">{!! $log->price !!}</td>
    <td>
        <ul class="nav nav-pills">
            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
            <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
        </ul>
    </td>
</tr>
@endforeach
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
$('.editValues').click(function () {
$(this).parents('tr').find('td.editableColumns').each(function() {
var html = $(this).text();
var input = $('<input class="editableColumnsStyle" type="text" />');
input.val(html);
$(this).html(input);
});
});


</script>
@endsection