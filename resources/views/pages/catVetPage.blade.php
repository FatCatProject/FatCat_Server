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
                                <input id="cat_id_to_edit" type="hidden" name="cat_id_to_edit"
                                       value="{!! $cat['id'] !!}">
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
                                            <button id="cancelEditVetLog" type="reset" class="btn-inverse btn">Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <script>
                    $("#prescription_picture_input_add").bind("change", function (event) {
                        console.log("--- prescription_picture_input_add change ---");
                        if (this.files[0].length < 1) {
                            $("#errors_ul_add").children("#file_size_error_li_add").remove();
                            $("#errors_ul_add").children("#file_extension_error_li_add").remove();
                            if (!$("#errors_ul_add").is(":parent")) {
                                $("#submit_button_add").removeClass("disabled");
                            }
                            return;
                        }
                        var file_size_bytes = this.files[0].size;
                        var file_extension = (this.files[0].name.toLowerCase().split("."))[this.files[0].name.split(".").length - 1];
                        var allowed_file_extensions = ["gif", "jpeg", "jpg", "png"];
                        console.log("file_size_bytes: " + file_size_bytes + " - file_extension: " + JSON.stringify(file_extension));

                        if (file_size_bytes > 10485760) {
                            $("#submit_button_add").addClass("disabled");
                            $("#errors_ul_add").children("#file_size_error_li_add").remove();
                            $("#errors_ul_add").append(
                                $("<li></li>").attr("id", "file_size_error_li_add").text("File size too large - max 10MB.")
                            );
                        } else {
                            $("#errors_ul_add").children("#file_size_error_li_add").remove();
                        }
                        if ($.inArray(file_extension, allowed_file_extensions) == -1) {
                            $("#submit_button_add").addClass("disabled");
                            $("#errors_ul_add").children("#file_extension_error_li_add").remove();
                            $("#errors_ul_add").append(
                                $("<li></li>").attr("id", "file_extension_error_li_add").text(
                                    "File extension not allowed. - Allowed extensions: " + JSON.stringify(allowed_file_extensions)
                                )
                            );
                        } else {
                            $("#errors_ul_add").children("#file_extension_error_li_add").remove();
                        }
                        if (!$("#errors_ul_add").is(":parent")) {
                            $("#submit_button_add").removeClass("disabled");
                        }
                    });
                    $("#to_pic").bind("change", function (event) {
                        console.log("--- to_pic change ---");
                        if (this.files[0].length < 1) {
                            $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
                            $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
                            if (!$("#errors_ul_edit").is(":parent")) {
                                $("#updateBtn").removeClass("disabled");
                            }
                            return;
                        }
                        var file_size_bytes = this.files[0].size;
                        var file_extension = (this.files[0].name.toLowerCase().split("."))[this.files[0].name.split(".").length - 1];
                        var allowed_file_extensions = ["gif", "jpeg", "jpg", "png"];
                        console.log("file_size_bytes: " + file_size_bytes + " - file_extension: " + JSON.stringify(file_extension));

                        if (file_size_bytes > 10485760) {
                            $("#updateBtn").addClass("disabled");
                            $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
                            $("#errors_ul_edit").append(
                                $("<li></li>").attr("id", "file_size_error_li_edit").text("File size too large - max 10MB.")
                            );
                        } else {
                            $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
                        }
                        if ($.inArray(file_extension, allowed_file_extensions) == -1) {
                            $("#updateBtn").addClass("disabled");
                            $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
                            $("#errors_ul_edit").append(
                                $("<li></li>").attr("id", "file_extension_error_li_edit").text(
                                    "File extension not allowed. - Allowed extensions: " + JSON.stringify(allowed_file_extensions)
                                )
                            );
                        } else {
                            $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
                        }
                        if (!$("#errors_ul_edit").is(":parent")) {
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
                                        Pick a year to see the expenses for a specific year
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
                                        <script>
                                            function expenses_bar_chart() {
                                                var year_date = $("#yearly_expenses_datepicker").val();
                                                var cat_id = {!! $cat->id !!}
                                                console.log("year_date: " + year_date + " - cat_id: " + cat_id);

                                                $.get(
                                                    "{!! URL::route('cat_vet_page_expenses') !!}",
                                                    {
                                                        year: year_date,
                                                        cat_id: cat_id
                                                    },
                                                    function (data, status) {
                                                        console.log("status: " + status);
                                                        if (status === "success") {
                                                            console.log("data: " + JSON.stringify(data));
                                                            new Chart(
                                                                document.getElementById("bar1").getContext("2d")).Bar(
                                                                {
                                                                    labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
                                                                    datasets: [
                                                                        {
                                                                            fillColor: "#00ACED",
                                                                            strokeColor: "#00ACED",
                                                                            data: data
                                                                        }
                                                                    ]
                                                                }
                                                            );
                                                            var expenses_sum = data.reduce(function (previous, current) {
                                                                return previous + current;
                                                            });
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
                                <div class="row" style="margin-left: 15px">
                                    <h3 id="expenses_sum_h" style="color: #999;"></h3>
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
                                <input
                                    alt="dateMonth"
                                    class="form-control"
                                    id="logs_table_datepicker"
                                    name="dateMonth"
                                    placeholder="YYYY-MM"
                                    style="width: 90px; "
                                    type="text"
                                    value="{!! (new DateTime())->format('Y-m') !!}"
                                />
                            </div>
                        </div>
                        <div class="col-sm-10" style="margin:8px 0 0 25px;color: #999; font-size: 13px;">
                            Pick a month or view 10 last visits
                        </div>
                    </div>
                    <table id="logs_table" class="table table-striped">
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
                        </tbody>
                    </table>
                    <div align="right" class="col-md-12 page_1">
                        <nav>
                            <ul id="table_pages" class="pagination">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!--END Table -->
            <br>
        </div>
        <br><br><br>
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
    </div>


    <script>
        function edit_event() {
            var id = $(this).parent().parent().find('#logID').val();
            console.log("id:" + id);
            var cat_id_to_edit = $("#cat_id_to_edit").val();
            console.log("cat_id_to_edit:" + cat_id_to_edit);
            var crr_date = $(this).parent().parent().find('#crr_date').text();
            console.log("date is:" + crr_date);
            var crr_clinic = $(this).parent().parent().find('#crr_clinic').text();
            console.log("crr_clinic:" + crr_clinic);
            var crr_subject = $(this).parent().parent().find('#crr_subject').text();
            console.log("crr_subject:" + crr_subject);
            var crr_desc = $(this).parent().parent().find('#crr_desc').text();
            console.log("crr_desc:" + crr_desc);
            var crr_pic = $(this).parent().parent().find('#crr_pic').text();
            console.log("crr_pic:" + crr_pic);
            var crr_price = $(this).parent().parent().find('#crr_price').text().split(" ")[0];
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
        }

        $("#cancelEditVetLog").click(function () {
            $("#editVetLogBlock").hide();
            $("#addVetLogBlock").show();
        });

        function delete_event() {
            var id = $(this).parent().parent().find('#logID').val();
            console.log("log id is" + id);
            $.ajax({
                type: "GET",
                url: '/deleteVetLog',
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

        function table_pages(number_of_pages, active_page) {
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

            for (var i = 1; i <= number_of_pages; i++) {
                var tmp_li = $("<li></li>").append(
                    $("<a></a>").append(i)
                ).addClass("page_li_btn").on("click", page_li_btn_event);
                if (i == active_page) {
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
            if (active_page < 2) {
                $("#page_previous").addClass("disabled");
            }
            if (active_page >= number_of_pages) {
                $("#page_next").addClass("disabled");
            }
        }

        function table_rows(data, prescription_pictures) {
            console.log("--- table_rows ---");
            console.log("data: " + JSON.stringify(data));
            var logs_table = $("#logs_table");
            $("#logs_table tr").not("thead tr").remove();

            for (row_idx in data) {
                var row = data[row_idx];
                var tmp_picture = (prescription_pictures[row.id]) ? $("<img/>").attr(
                    {
                        class: "myImg",
                        id: "myImg_" + [row.id],
                        src: prescription_pictures[row.id],
                        width: "50px",
                        height: "50px",
                        align: "center"
                    }
                ) : "No prescription picture";
                var tmp_tr = $("<tr></tr>").append(
                    $("<input/>").attr(
                        {
                            id: "logID",
                            type: "hidden"
                        }
                    ).val(row.id),
                    $("<td></td>").attr("id", "crr_date").text(row.visit_date),
                    $("<td></td>").attr("id", "crr_clinic").text(row.clinic_name || ""),
                    $("<td></td>").attr("id", "crr_subject").text(row.subject || ""),
                    $("<td></td>").attr("id", "crr_desc").text(row.description || ""),
                    $("<td></td>").attr("id", "crr_pic").append(tmp_picture),
                    $("<td></td>").attr("id", "crr_price").text(row.price + " USD"),
                    $("<td></td>").append("<ul></ul>").attr("id", "btns").addClass("nav nav-pills").append(
                        $("<li></li>").addClass("editBtn").append(
                            $("<a></a>").attr("href", "#Edit").append(
                                $("<i></i>").addClass("lnr lnr-pencil editValues")
                            )
                        ).on("click", edit_event),
                        $("<li></li>").addClass("deleteBtn").attr("id", "del_id_" + row.id).val(row.id).append(
                            $("<a></a>").attr("href", "#Edit").append(
                                $("<i></i>").addClass("lnr lnr-trash")
                            )
                        ).on("click", delete_event)
                    )
                ).attr("id", "row_" + row.id)
                logs_table.append(tmp_tr);
            }
            image_popout();
        }

        function table_logs_datepicker_event() {
            console.log("--- table_logs_datepicker_event ---");
            var month_date = $("#logs_table_datepicker").val();
            var cat_id = "{!! $cat->id !!}";
            var page = 1;
            var entries_per_page = 10;
            console.log(
                "month_date: " + month_date +
                " - cat_id: " + cat_id +
                " - page: " + page +
                " - entries_per_page: " + entries_per_page
            );

            $.get(
                "{!! URL::route('cat_vet_page_table_data') !!}",
                {
                    month_date: month_date,
                    cat_id: cat_id,
                    page: page,
                    entries_per_page: entries_per_page
                },
                function (data, status) {
                    if (status === "success") {
                        table_rows(data.cat_vet_logs, data.prescription_pictures);
                        table_pages(data.number_of_pages, data.page_number);
                    }
                }
            );
        }

        function page_li_btn_event() {
            console.log("--- page_li_btn_event ---");
            var month_date = $("#logs_table_datepicker").val();
            var cat_id = "{!! $cat->id !!}";
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

            if ($(this).hasClass("disabled")) {
                return;
            }

            $.get(
                "{!! URL::route('cat_vet_page_table_data') !!}",
                {
                    month_date: month_date,
                    cat_id: cat_id,
                    page: page,
                    entries_per_page: entries_per_page
                },
                function (data, status) {
                    if (status === "success") {
                        table_rows(data.cat_vet_logs, data.prescription_pictures);
                        table_pages(data.number_of_pages, data.page_number);
                    }
                }
            );
        }

        $("#logs_table_datepicker").on("changeDate", table_logs_datepicker_event);
        $("button[type='reset']").on("click", function () {
            $("#errors_ul_add").empty();
            $("#submit_button_add").removeClass("disabled");
        });


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
@endsection
