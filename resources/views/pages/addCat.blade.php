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
                            {{--<div class="col-sm-2 jlkdfj1">--}}
                            {{--<p class="help-block">Your help text!</p>--}}
                            {{--</div>--}}
                        </div>
                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-2 control-label">Breed:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" id="breed" placeholder="" onKeyup="trackChange(this.value)">
                                Info:
                                <div id="wikiInfo"></div>
                                Url:
                                <a id="wikiLink" href=""></a>

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
                            @include('layouts.datePicker')
                        </div>

                        <div class="form-group">
                            <label for="smallinput" class="col-sm-2 control-label label-input-sm">Current weight:</label>
                            <div class="col-sm-8">
                                <input type="number"  step="any" min="0" max="100" class="form-control1 input-sm" id="currentWeight" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="smallinput" class="col-sm-2 control-label label-input-sm">Target weight:</label>
                            <div class="col-sm-8">
                                <input type="number"  step="any" min="0" max="100" class="form-control1 input-sm" id="targetWeight" placeholder="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="smallinput" class="col-sm-2 control-label label-input-sm">Daily callories:</label>
                            <div class="col-sm-8">
                                <input type="number"  step="any" min="0" max="1000" class="form-control1 input-sm" id="dailyCallories" placeholder="">
                            </div>
                        </div>
                    </form>
                </div>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="panel-footer">
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
@endsection