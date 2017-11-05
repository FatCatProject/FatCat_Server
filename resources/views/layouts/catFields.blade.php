<h3 class="blank1" id="title">Tile</h3>
<div class="tab-content">
    <div class="tab-pane active" id="horizontal-form">
        <form
            action="{!! empty($cat) ? 'addcat' : 'editcat' !!}"
            class="form-horizontal"
            enctype="multipart/form-data"
            id="catFields"
            method="POST"
        >
            @if(!empty($cat))
                <input name="id" type="hidden" value="{!! $cat->id !!}"/>
                {{ method_field('PUT') }}
            @endif

            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="focusedinput">Name: <span style="color: red;">*</span></label>
                <div class="col-sm-8">
                    <input
                        class="form-control1"
                        id="focusedinput"
                        name="cat_name"
                        placeholder=""
                        required
                        type="text"
                        value="{!! !empty($cat->cat_name) ? $cat->cat_name : '' !!}"
                    />
                </div>
            </div>

            <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label">Breed: <span style="color: red;">*</span></label>
                <div class="col-sm-8">
                    <input
                        class="form-control1"
                        name="cat_breed"
                        placeholder=""
                        required
                        type="text"
                        value="{!! !empty($cat) ? $cat->cat_breed : '' !!}"
                    />
                </div>
            </div>

            <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label">Wiki page:</label>
                <div class="col-sm-8" style="margin-top: 6px">
                    <a id="wikiLink" href="{!! !empty($cat) ? $cat->catBreed->link : '' !!}"></a>
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
                <label for="radio" class="col-sm-2 control-label">Gender: <span style="color: red;">*</span></label>
                <div class="col-sm-8">
                    <div class="radio-inline">
                        <label>
                            <input
                                name="gender"
                                required
                                type="radio"
                                value="male"
                                {!! (empty($cat) or $cat->gender == "male") ? 'checked' : '' !!}
                            />
                            Male<br>
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input
                                name="gender"
                                required
                                type="radio"
                                value="female"
                                {!! (!empty($cat) and $cat->gender == "female") ? 'checked' : '' !!}
                            />
                            Female<br>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="catDob" class="col-sm-2 control-label">Birthday:</label>
                <div class="input-group" style="margin: 0px 0px 0px 15px">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input
                        alt="date"
                        class="form-control"
                        name="dob"
                        placeholder="YYYY-MM-DD"
                        type="text"
                        value ="{!! !empty($cat->dob) ? $cat->dob : '' !!}" style="width: 120px;"
                    />
                </div>
                @include('layouts.datePicker')
            </div>

            <div class="form-group">
                <label for="smallinput" class="col-sm-2 control-label label-input-sm">Current weight:</label>
                <div class="col-sm-8">
                    <input
                        class="form-control1 input-sm"
                        max="100"
                        min="0"
                        name="current_weight"
                        placeholder=""
                        step="any"
                        type="number"
                        value="{!! !empty($cat->current_weight) ? $cat->current_weight : '' !!}"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="smallinput" class="col-sm-2 control-label label-input-sm">Target weight:</label>
                <div class="col-sm-8">
                    <input
                        class="form-control1 input-sm"
                        max="100"
                        min="0"
                        name="target_weight"
                        placeholder=""
                        step="any"
                        type="number"
                        value="{!! !empty($cat->target_weight) ? $cat->target_weight : '' !!}"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="smallinput" class="col-sm-2 control-label label-input-sm">Daily calories:</label>
                <div class="col-sm-8">
                        <input
                            class="form-control1 input-sm"
                            max="1000"
                            min="0"
                            name="daily_calories"
                            placeholder=""
                            step="any"
                            type="number"
                            value="{!! !empty($cat->daily_calories) ? $cat->daily_calories : '' !!}"
                        >
                </div>
            </div>

            <div class="form-group">
                <label for="profilePicture" class="col-sm-2 control-label">Profile picture:</label>
                <div class="col-sm-8">
                    <input
                        class="filestyle"
                        name="profile_picture"
                        style="margin-top: 6px"
                        type="file"
                    >
                    {{--<p class="help-block">Example block-level help text here.</p>--}}
                </div>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button class="btn-success btn" form="catFields" type="submit">Submit</button>
                        <button class="btn-inverse btn" type="reset">Reset</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

