@extends('layouts.master')
@section('content')

    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Add a new cat:</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="focusedinput" placeholder="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="breed_selection" class="col-sm-2 control-label"
                                   id="breed_selection">Breed</label>
                            <div class="col-sm-8">
                                <select name="breedd" id="breedd" class="form-control1">
                                    <option value="" name="" selected disabled>Please select a breed</option>
                                    @foreach ($breeds as $breed)
                                        <option value="{!! $breed !!}"
                                                name="{!! $breed !!}">{!! $breed !!}</option>
                                    @endforeach
                                </select>


                                <input type="text" id="breed" name="breed">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Wiki page:</label>
                            <div class="col-sm-8" style="margin-top: 6px">
                                <a id="wikiLink" href=""></a>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Wiki info:</label>
                            <div class="col-sm-8" style="margin-top: 6px">
                                <div id="wikiInfo"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            @include('layouts.wikiInfo')
                        </div>
                        <div class="form-group">
                            <label for="radio" class="col-sm-2 control-label">Gender:</label>
                            <div class="col-sm-8">
                                <div class="radio-inline"><label><input type="radio" name="gender" value="male" checked>Male<br></label>
                                </div>
                                <div class="radio-inline"><label><input type="radio" name="gender" value="female">Female<br></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catDob" class="col-sm-2 control-label">Birthday:</label>
                            <div class="input-group" style="margin: 0px 0px 0px 15px">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="catDob" name="date" placeholder="MM/DD/YYYY" type="text" style="width: 120px;"/>
                            </div>
                            @include('layouts.datePicker')
                        </div>

                        <div class="form-group">
                            <label for="smallinput" class="col-sm-2 control-label label-input-sm">Current
                                weight:</label>
                            <div class="col-sm-8">
                                <input type="number" step="any" min="0" max="100" class="form-control1 input-sm"
                                       id="currentWeight" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="smallinput" class="col-sm-2 control-label label-input-sm">Target weight:</label>
                            <div class="col-sm-8">
                                <input type="number" step="any" min="0" max="100" class="form-control1 input-sm"
                                       id="targetWeight" placeholder="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="smallinput" class="col-sm-2 control-label label-input-sm">Daily
                                callories:</label>
                            <div class="col-sm-8">
                                <input type="number" step="any" min="0" max="1000" class="form-control1 input-sm"
                                       id="dailyCallories" placeholder="">
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal">



                        <div class="form-group">
                            <label for="profilePicture" class="col-sm-2 control-label">Profile picture:</label>
                            <div class="col-sm-8">
                                <input type="file" id="profilePicture"  class="filestyle" data-buttonBefore="true" style="margin-top: 6px">
                            {{--<p class="help-block">Example block-level help text here.</p>--}}
                            </div>

                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn-success btn">Submit</button>
                                    <button class="btn-default btn">Cancel</button>
                                    <button class="btn-inverse btn">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    </div>

@endsection