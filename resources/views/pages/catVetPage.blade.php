@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div id="Edit" class="graphs">
            <h3 class="blank1">Vet entries for {!! $cat['cat_name'] !!}:</h3>
            <div class="row">
                {{--addVetLogBlock--}}
                <div id="addVetLogBlock" class="col-sm-7">

                    <div id="errors_div_add" class="form-group">
                        <ul id="errors_ul_add" style="color: red;"></ul>
                    </div>

                    <h4 class="blank1">Add new vet log:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                                  action="/addvetlog" id="addvetlog">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{!! $cat['id'] !!}">
                                <input type="hidden" name="id" value="{!! $cat['id'] !!}">
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                                <div class="form-group">
                                    <label for="catDob" class="col-sm-2 control-label">Date: <span
                                                style="color: red;">*</span></label>
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
                                        <input type="text" name="clinic_name" class="form-control1" id="clinicLogName"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Subject:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="subject" class="form-control1" id="vetLogSubject"
                                               placeholder="">
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
                                        <input
                                            class="filestyle"
                                            id="prescription_picture_input_add"
                                            name="prescription_picture"
                                            style="margin-top: 6px"
                                            type="file"
                                        />
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="smallinput" class="col-sm-2 control-label label-input-sm">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="price" step="any" min="0" max="10000"
                                               class="form-control1 input-sm"
                                               id="vetLogPrice" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button
                                                class="btn-success btn"
                                                form="addvetlog"
                                                id="submit_button_add"
                                                type="submit"
                                            >
                                                Add
                                            </button>
                                            <button type="reset" class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{--editVetLogBlock--}}
                <div hidden id="editVetLogBlock" class="col-sm-7">

                    <div id="errors_div_edit" class="form-group">
                        <ul id="errors_ul_edit" style="color: red;"></ul>
                    </div>

                    <h4 class="blank1">Edit vet log:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                                  action="/update" id="update">
                                {!! csrf_field() !!}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="to_logID" id="to_logID" value="">
                                <input id="cat_id_to_edit" type="hidden" name="cat_id_to_edit" value="{!! $cat['id'] !!}">
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                                <div class="form-group">
                                    <label for="date" class="col-sm-2 control-label">Date: <span
                                            style="color: red;">*</span></label>
                                    <div class="row" style="padding: 10px">
                                        <div class="input-group" style="margin: 0px 0px 0px 15px">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" id="to_date" name="to_date" alt="date"
                                                   placeholder="YYYY-MM-DD"
                                                   type="text" required style="width: 120px;"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Clinic:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="to_clinic" class="form-control1" id="to_clinic"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Subject:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="to_subject" class="form-control1" id="to_subject"
                                               placeholder="">
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
                                    <label for="profilePicture" class="col-sm-2 control-label">Picture:</label>
                                    <div class="col-sm-8">
                                        <input
                                            type="file"
                                            name="to_pic"
                                            id="to_pic"
                                            class="filestyle"
                                            style="margin-top: 6px">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="smallinput" class="col-sm-2 control-label label-input-sm">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="to_price" step="any" min="0" max="10000"
                                               class="form-control1 input-sm"
                                               id="to_price" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button
                                                class="btn-success btn"
                                                form="update"
                                                id="updateBtn"
                                                type="submit"
                                            >
                                                Update
                                            </button>
                                            <button id="cancelEditVetLog" type="reset" class="btn-inverse btn">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
<script>
$("#prescription_picture_input_add").bind("change", function(event){
    console.log("--- prescription_picture_input_add change ---");
    if(this.files[0].length < 1){
        $("#errors_ul_add").children("#file_size_error_li_add").remove();
        $("#errors_ul_add").children("#file_extension_error_li_add").remove();
            if(! $("#errors_ul_add").is(":parent")){
                $("#submit_button_add").removeClass("disabled");
            }
            return;
    }
    var file_size_bytes = this.files[0].size;
    var file_extension = (this.files[0].name.toLowerCase().split("."))[this.files[0].name.split(".").length - 1];
    var allowed_file_extensions = ["gif", "jpeg", "jpg", "png"];
    console.log("file_size_bytes: " +  file_size_bytes + " - file_extension: " + JSON.stringify(file_extension));

    if(file_size_bytes > 10485760){
        $("#submit_button_add").addClass("disabled");
        $("#errors_ul_add").children("#file_size_error_li_add").remove();
        $("#errors_ul_add").append(
            $("<li></li>").attr("id", "file_size_error_li_add").text("File size too large - max 10MB.")
        );
    }else{
        $("#errors_ul_add").children("#file_size_error_li_add").remove();
    }
    if($.inArray(file_extension, allowed_file_extensions) == -1){
        $("#submit_button_add").addClass("disabled");
        $("#errors_ul_add").children("#file_extension_error_li_add").remove();
        $("#errors_ul_add").append(
            $("<li></li>").attr("id", "file_extension_error_li_add").text(
                "File extension not allowed. - Allowed extensions: " + JSON.stringify(allowed_file_extensions)
            )
        );
    }else{
        $("#errors_ul_add").children("#file_extension_error_li_add").remove();
    }
    if(! $("#errors_ul_add").is(":parent")){
        $("#submit_button_add").removeClass("disabled");
    }
});
$("#to_pic").bind("change", function(event){
    console.log("--- to_pic change ---");
    if(this.files[0].length < 1){
        $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
        $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
            if(! $("#errors_ul_edit").is(":parent")){
                $("#updateBtn").removeClass("disabled");
            }
            return;
    }
    var file_size_bytes = this.files[0].size;
    var file_extension = (this.files[0].name.toLowerCase().split("."))[this.files[0].name.split(".").length - 1];
    var allowed_file_extensions = ["gif", "jpeg", "jpg", "png"];
    console.log("file_size_bytes: " +  file_size_bytes + " - file_extension: " + JSON.stringify(file_extension));

    if(file_size_bytes > 10485760){
        $("#updateBtn").addClass("disabled");
        $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
        $("#errors_ul_edit").append(
            $("<li></li>").attr("id", "file_size_error_li_edit").text("File size too large - max 10MB.")
        );
    }else{
        $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
    }
    if($.inArray(file_extension, allowed_file_extensions) == -1){
        $("#updateBtn").addClass("disabled");
        $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
        $("#errors_ul_edit").append(
            $("<li></li>").attr("id", "file_extension_error_li_edit").text(
                "File extension not allowed. - Allowed extensions: " + JSON.stringify(allowed_file_extensions)
            )
        );
    }else{
        $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
    }
    if(! $("#errors_ul_edit").is(":parent")){
        $("#updateBtn").removeClass("disabled");
    }
});
</script>
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
                                        <canvas id="bar1" height="207" width="450px"
                                                style="width:450px; height: 100px;"></canvas>
                                        <script>
                                            var barChartData = {
                                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                                datasets: [
                                                    {

                                                        fillColor: "#00BCD4",
                                                        strokeColor: "#00BCD4",
                                                        data: {!! $month_expenses !!}
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
                        @php ($index = 0)
                        @for(;$index<count($vet_logs);$index++)
                            <tr id="row_{!! $vet_logs[$index]->id !!}">
                                <input id="logID" type="hidden" value="{!! $vet_logs[$index]->id !!}">
                                <td id="crr_date">{!! $vet_logs[$index]->visit_date !!}</td>
                                <td id="crr_clinic">{!! $vet_logs[$index]->clinic_name !!}</td>
                                <td id="crr_subject">{!! $vet_logs[$index]->subject !!}</td>
                                <td id="crr_desc">{!! $vet_logs[$index]->description !!}</td>
                                @if($vet_prescription_pictures[$vet_logs[$index]->id] == "No prescription picture")
                                    <td id="crr_pic">No prescrition image</td>
                                @else
                                    <td id="editableColumns"><img
                                                src="{!! $vet_prescription_pictures[$vet_logs[$index]->id] !!}"
                                                width="50px"
                                                height="50px"
                                                align="center"
                                        ></td>
                                @endif
                                <td id="crr_price">{!! $vet_logs[$index]->price !!}</td>
                                <td>
                                    <ul id="btns" class="nav nav-pills">
                                        <li class="editBtn"><a href="#Edit"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
                                        <li class="deleteBtn" id="del_id_{!! $vet_logs[$index]->id !!}" value="{!! $vet_logs[$index]->id !!}" >
                                            <a><i class="lnr lnr-trash"></i></a>
                                        </li>
                                    </ul>
                                </td>
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

        //  Edit vet log
        $(document).ready(function(){
            $(".editBtn").click(function(){
                var id = $(this).parent().parent().parent().find('#logID').val();
                console.log("id:" + id);
                var cat_id_to_edit = $("#cat_id_to_edit").val();
                console.log("cat_id_to_edit:" + cat_id_to_edit);
                var crr_date = $(this).parent().parent().parent().find('#crr_date').text();
                console.log("date is:" + crr_date);
                var crr_clinic = $(this).parent().parent().parent().find('#crr_clinic').text();
                console.log("crr_clinic:" + crr_clinic);
                var crr_subject = $(this).parent().parent().parent().find('#crr_subject').text();
                console.log("crr_subject:" + crr_subject);
                var crr_desc = $(this).parent().parent().parent().find('#crr_desc').text();
                console.log("crr_desc:" + crr_desc);
                var crr_pic = $(this).parent().parent().parent().find('#crr_pic').text();
                console.log("crr_pic:" + crr_pic);
                var crr_price = $(this).parent().parent().parent().find('#crr_price').text();
                console.log("crr_price:" + crr_price);


                $("#errors_ul_edit").empty();
                $("#updateBtn").removeClass("disabled");
                $("#addVetLogBlock").hide();
                $("#editVetLogBlock").show();
                $("#to_logID").val(id);
                $("#to_date").val(crr_date);
                $("#to_clinic").val(crr_clinic);
                $("#to_subject").val(crr_subject);
                $("#to_desc").val(crr_desc);
                $("#to_price").val(crr_price);
                $("#to_pic").val(crr_pic); //TODO
            });
            $("#cancelEditVetLog").click(function(){
                $("#editVetLogBlock").hide();
                $("#addVetLogBlock").show();
            });
        });

        $(document).ready(function () {
            $('#updateBtnnnnnnnn').on("click", function () {
                var id = $('#to_logID').val();
                var to_date = $('#to_date').val();
                var to_clinic = $('#to_clinic').val();
                var to_subject = $('#to_subject').val();
                var to_desc = $('#to_desc').val();
                var to_pic = $('#to_pic').val();
                var to_price = $('#to_price').val();
                console.log("this is the id ajax:"+id);
                console.log("new to_date:"+to_date);
                console.log("new to_clinic:"+to_clinic);
                console.log("new to_subject:"+to_subject);
                console.log("new to_desc:"+to_desc);
                console.log("new price:"+to_price);
                $.ajax({
                    type: "GET",
                    url: './updateLog',
                    caller: id,
                    data: {
                        id: id,
                        visit_date: to_date,
                        clinic_name: to_clinic,
                        subject: to_subject,
                        description: to_desc,
                        prescription_picture: to_pic,
                        price: to_price
                    },
                    success: function (data, textStatus, jqXHR) {
                        console.log("ok "+data.subject);
                        console.log("got back for" + this.caller);
//                        $("#weight_left_id" + this.caller).html(newWeight+"<span>&nbsp;&nbsp;grams left</span>");
                    },
                    fail: function (jqXHR, textStatus, errorThrown) {
                        console.log("ERROR:" + jqXHR);
                        console.log("ERROR:" + textStatus);
                    }
                })
                $("#editVetLogBlock").hide();
                $("#addVetLogBlock").show();
            });

        });



        //Delete table row
        $(document).ready(function () {
            $('.deleteBtn').on("click", function () {
                var id = $(this).parent().parent().parent().find('#logID').val();
                console.log("log id is" + id);
                $.ajax({
                    type: "GET",
                    url: '/deleteVetLog',
                    caller: id,
                    data: {
                        id: id,
                    },
                    success: function (data, status, jqXHR) {
                        console.log("llll:"+data);
                        $("#row_" + this.caller).remove();
                    },
                    fail: function (jqXHR, status, errorThrown) {
                        console.log("ERROR:" + jqXHR);
                        console.log("ERROR:" + status);
                    }
                })
            });
        });


    </script>
@endsection
