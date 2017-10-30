@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')

    add food products
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">User Manager:</h3>
            {{--User information--}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal">

                                <div class="col-sm-6">
                                    <h4 class="blank1">User Information:</h4>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label"
                                               disabled="">Email:</label>
                                        <div class="col-sm-8">
                                            <input disabled="" type="email" class="form-control1" id="disabledinput"
                                                   placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">First name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="shopUrl" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Last name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="shopUrl" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Country:</label>
                                        <div class="col-sm-8">
                                            <input type="url" class="form-control1" id="shopUrl" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Phone number:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="shopTel"
                                                   pattern="[0-9]+((?:[0-9]+-)*)[0-9]+" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profilePicture" class="col-sm-3 control-label">Profile
                                            picture:</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="itemPicture" id="itemPicture" class="filestyle"
                                                   data-buttonBefore="true" style="margin-top: 6px">
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
                                            <div class="checkbox-inline"><label><input type="checkbox">Yes</label></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-7 control-label">Reseive Daily feeding
                                            reports:</label>
                                        <div class="col-sm-5">
                                            <div class="checkbox-inline"><label><input type="checkbox">Yes</label></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-7 control-label">Receive notification twice
                                            a day if cat is not eating for 12 hours:</label>
                                        <div class="col-sm-5">
                                            <div class="checkbox-inline"><label><input type="checkbox">Yes</label></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12" style="margin:50px 0 0 15px">
                                            <button class="btn-success btn">Save changes</button>
                                            <button class="btn-inverse btn">Cancel</button>
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


    </script>
@endsection