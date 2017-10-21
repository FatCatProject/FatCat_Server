<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1" id="title">Tile</h3>
        <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                @if(empty($cat))
                    <form class="form-horizontal" method="POST" action="addcat" id="catFields">
                @endif
                @if(!empty($cat))
                    <form class="form-horizontal" method="POST" action="editcat" id="catFields">
                    <input type="hidden" name="id" value="{!! $cat['id'] !!}">
                    {{ method_field('PUT') }}
                @endif
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-8">
                            @if(empty($cat))
                                <input type="text"  name="cat_name" class="form-control1" id="focusedinput" placeholder="">
                            @endif
                            @if(!empty($cat))
                                <input type="text"  name="cat_name" value="{!! $cat['cat_name'] !!}" class="form-control1" id="focusedinput" placeholder="">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Breed:</label>
                        <div class="col-sm-8">
                            @if(empty($cat))
                                <input type="text" class="form-control1" id="breed" name="cat_breed" placeholder="">
                            @endif
                            @if(!empty($cat))
                                    <input type="text" class="form-control1" id="breed" value="{!! $cat['cat_breed'] !!}" name="cat_breed" placeholder="">
                            @endif
                        </div>
                    </div>

                    <!--Full dropdown without ajax-->
                    {{--<div class="form-group">--}}
                    {{--<label for="breed_selection" class="col-sm-2 control-label"--}}
                    {{--id="breed_selection">Breed</label>--}}
                    {{--<div class="col-sm-8">--}}
                    {{--<select name="breedd" id="breedd" class="form-control1">--}}
                    {{--<option value="" name="" selected disabled>Please select a breed</option>--}}
                    {{--@foreach ($breeds as $breed)--}}
                    {{--<option value="{!! $breed !!}"--}}
                    {{--name="{!! $breed !!}">{!! $breed !!}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--</div>--}}

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
                            @if(empty($cat))
                                <div class="radio-inline"><label><input type="radio" name="gender" value="male" checked>Male<br></label>
                                </div>
                                <div class="radio-inline"><label><input type="radio" name="gender" value="female">Female<br></label>
                                </div>
                            @endif
                            @if(!empty($cat))
                                @if($cat->gender=="male")
                                    <div class="radio-inline"><label><input type="radio" name="gender" value="male" checked="true">Male<br></label>
                                    </div>
                                    <div class="radio-inline"><label><input type="radio" name="gender" value="female">Female<br></label>
                                    </div>
                                @endif
                                @if($cat->gender=="female")
                                    <div class="radio-inline"><label><input type="radio" name="gender" value="male">Male<br></label>
                                    </div>
                                    <div class="radio-inline"><label><input type="radio" name="gender" value="female" checked="true">Female<br></label>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catDob" class="col-sm-2 control-label">Birthday:</label>
                        <div class="input-group" style="margin: 0px 0px 0px 15px">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            @if(empty($cat))
                            <input class="form-control" id="catDob" name="dob" placeholder="MM/DD/YYYY" type="text" style="width: 120px;"/>
                            @endif
                            @if(!empty($cat))
                                @if($cat->dob == null)
                                    <input class="form-control" id="catDob" name="dob" placeholder="MM/DD/YYYY" type="text" style="width: 120px;"/>
                                @endif
                                @if($cat->dob != null)
                                    <input class="form-control" id="catDob" name="dob" value="{!! $cat['dob'] !!}" placeholder="MM/DD/YYYY" type="text" style="width: 120px;"/>
                                @endif
                            @endif
                        </div>
                        @include('layouts.datePicker')
                    </div>

                    <div class="form-group">
                        <label for="smallinput" class="col-sm-2 control-label label-input-sm">Current
                            weight:</label>
                        <div class="col-sm-8">
                            @if(empty($cat))
                                <input type="number" name="current_weight" step="any" min="0" max="100" class="form-control1 input-sm"
                                   id="currentWeight" placeholder="">
                            @endif
                            @if(!empty($cat))
                                <input type="number" name="current_weight" value="{!! $cat['current_weight'] !!}" step="any" min="0" max="100" class="form-control1 input-sm"
                                           id="currentWeight" placeholder="">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="smallinput" class="col-sm-2 control-label label-input-sm">Target weight:</label>
                        <div class="col-sm-8">
                            @if(empty($cat))
                                <input type="number" name="target_weight" step="any" min="0" max="100" class="form-control1 input-sm"
                                   id="targetWeight" placeholder="">
                            @endif
                            @if(!empty($cat))
                                <input type="number" name="target_weight" value="{!! $cat['target_weight'] !!}" step="any" min="0" max="100" class="form-control1 input-sm"
                                           id="targetWeight" placeholder="">
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="smallinput" class="col-sm-2 control-label label-input-sm">Daily callories:</label>
                        <div class="col-sm-8">
                            @if(empty($cat))
                                <input type="number" name="daily_calories" step="any" min="0" max="1000" class="form-control1 input-sm"
                                   id="dailyCallories" placeholder="">
                            @endif
                            @if(!empty($cat))
                                <input type="number" name="daily_calories" value="{!! $cat['daily_calories'] !!}" step="any" min="0" max="1000" class="form-control1 input-sm"
                                           id="dailyCallories" placeholder="">
                            @endif
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="profilePicture" class="col-sm-2 control-label">Profile picture:</label>
                        <div class="col-sm-8">
                            <input type="file" name="profile_picture" id="profilePicture"  class="filestyle" data-buttonBefore="true" style="margin-top: 6px">
                            {{--<p class="help-block">Example block-level help text here.</p>--}}
                        </div>

                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn" form="catFields">Submit</button>
                                <button class="btn-inverse btn">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>


    </div>
</div>

