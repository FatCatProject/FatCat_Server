@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">User Manager:</h3>
            {{--User information--}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                                  action="/editUser" id="editUser">
                                {!! csrf_field() !!}

                                <div id="errors_div" class="form-group">
                                    <ul id="errors_ul" style="color: red;"></ul>
                                </div>

                                <div class="col-sm-6">
                                    <h4 class="blank1">User Information:</h4>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label"
                                               disabled="">Email:</label>
                                        <div class="col-sm-8">
                                            <input disabled="" type="email" class="form-control1" id="disabledinput"
                                                   placeholder="" style="background-color: #F8F8F8" name="user_email"
                                                   value="{!! $current_user->email !!}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">First name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="first_name" placeholder=""
                                                   name="first_name" value="{!! $current_user->first_name !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Last name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" name="last_name"
                                                   value="{!! $current_user->last_name !!}" id="last_name"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Country:</label>
                                        <div class="col-sm-8">
                                            <select name="country" id="country" class="form-control1" required>
                                                <option value="" name="" selected>Please choose a country
                                                </option>
                                                @foreach($countries as $country)
                                                    @if($country == $current_user->country)
                                                        <option selected="selected" value="{!! $country !!}"
                                                                name="foodbox_id">{!! $country !!}</option>
                                                    @else
                                                        <option value="{!! $country !!}"
                                                                name="foodbox_id">{!! $country !!}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Phone number:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="phone_number"
                                                   name="phone_number"
                                                   pattern="[0-9]+((?:[0-9]+-)*)[0-9]+" placeholder=""
                                                   value="{!! $current_user->phone !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_picture" class="col-sm-3 control-label">Profile
                                            picture:</label>
                                        <div class="col-sm-8">
                                            <input
                                                class="filestyle"
                                                data-buttonBefore="true"
                                                id="profile_picture"
                                                name="picture"
                                                style="margin-top: 6px"
                                                type="file"
                                            />
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <h4 class="blank1">Email Reminders & Notifications:</h4>
                                    {{--reminders / mail notifications--}}
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-7 control-label">Reminder to buy food when
                                            only 10% is left :</label>
                                        <div class="col-sm-5">
                                            @if($current_user->buy_food_reminder == 1)
                                                <div class="checkbox-inline"><label><input type="checkbox"
                                                                                           name="buy_food"
                                                                                           checked="checked">Yes</label>
                                                </div>
                                            @else
                                                <div class="checkbox-inline"><label><input type="checkbox"
                                                                                           name="buy_food">Yes</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-7 control-label">Reseive Daily feeding
                                            reports:</label>
                                        <div class="col-sm-5">
                                            @if($current_user->daily_reminder == 1)
                                                <div class="checkbox-inline"><label><input type="checkbox"
                                                                                           name="daily_reminder"
                                                                                           checked="checked">Yes</label>
                                                </div>
                                            @else
                                                <div class="checkbox-inline"><label><input type="checkbox"
                                                                                           name="daily_reminder">Yes</label>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-7 control-label">Receive notification
                                            twice
                                            a day if cat is not eating for 12 hours:</label>
                                        <div class="col-sm-5">
                                            @if($current_user->not_eating_reminder == 1)
                                                <div class="checkbox-inline"><label><input type="checkbox"
                                                                                           name="not_eating"
                                                                                           checked="checked">Yes</label>
                                                </div>
                                            @else
                                                <div class="checkbox-inline"><label><input type="checkbox"
                                                                                           name="not_eating">Yes</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12" style="margin:50px 0 0 15px">
                                            <button
                                                class="btn-success btn"
                                                id="submit_button"
                                                type="submit"
                                            >
                                                Save changes
                                            </button>
                                            <button type="reset" class="btn-inverse btn">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br><br>
    </div>
    <script>
        $('.editValues').click(function () {
            $(this).parents('tr').find('td.editableColumns').each(function () {
                var html = $(this).text();
                var input = $('<input class="editableColumnsStyle" type="text" />');
                input.val(html);
                $(this).html(input);
            });
        });


$("#profile_picture").bind("change", function(event){
    console.log("--- profile_picture change ---");
    if(this.files[0].length < 1){
        $("#errors_ul").children("#file_size_error_li").remove();
        $("#errors_ul").children("#file_extension_error_li").remove();
        if(! $("#errors_ul").is(":parent")){
            $("#submit_button").removeClass("disabled");
        }
        return;
    }
    var file_size_bytes = this.files[0].size;
    var file_extension = (this.files[0].name.toLowerCase().split("."))[this.files[0].name.split(".").length - 1];
    var allowed_file_extensions = ["gif", "jpeg", "jpg", "png"];
    console.log("file_size_bytes: " +  file_size_bytes + " - file_extension: " + JSON.stringify(file_extension));

    if(file_size_bytes > 10485760){
    $("#submit_button").addClass("disabled");
    $("#errors_ul").children("#file_size_error_li").remove();
    $("#errors_ul").append(
        $("<li></li>").attr("id", "file_size_error_li").text("File size too large - max 10MB.")
    );
    }else{
        $("#errors_ul").children("#file_size_error_li").remove();
    }
    if($.inArray(file_extension, allowed_file_extensions) == -1){
        $("#submit_button").addClass("disabled");
        $("#errors_ul").children("#file_extension_error_li").remove();
        $("#errors_ul").append(
            $("<li></li>").attr("id", "file_extension_error_li").text(
                "File extension not allowed. - Allowed extensions: " + JSON.stringify(allowed_file_extensions)
            )
        );
    }else{
        $("#errors_ul").children("#file_extension_error_li").remove();
    }
    if(! $("#errors_ul").is(":parent")){
        $("#submit_button").removeClass("disabled");
    }
});
$("button[type='reset']").on("click", function(){
    $("#errors_ul").empty();
    $("#submit_button").removeClass("disabled");
});
    </script>
@endsection
