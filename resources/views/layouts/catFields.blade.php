<h3 class="blank1" id="title">Tile</h3>
<div class="tab-content">
    <div class="tab-pane active" id="horizontal-form">
        <form
            action="{!! empty($cat) ? 'addcat' : 'editcat' !!}"
            class="form-horizontal"
            enctype="multipart/form-data"
            id="cat_fields_form"
            method="POST"
        >
            @if(!empty($cat))
                <input name="id" type="hidden" value="{!! $cat->id !!}"/>
                {{ method_field('PUT') }}
            @endif

            <div id="errors_div" class="form-group">
                <ul id="errors_ul" style="color: red;"></ul>
            </div>

            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="focusedinput">Name: <span style="color: red;">*</span></label>
                <div class="col-sm-8">
                    <input
                        class="form-control1"
                        id="cat_name_input"
                        name="cat_name"
                        placeholder=""
                        required
                        type="text"
                        value="{!! !empty($cat->cat_name) ? $cat->cat_name : '' !!}"
                    />
                </div>
            </div>

            <div class="form-group">
                <style>
                    .ui-autocomplete {
                             background: #FFFFFF;
                             padding: 5px 10px;
                             font-size: 13px;
                             color: gray;
                         }
                    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active,
                    a.ui-button:active, .ui-button:active, .ui-state-active.ui-button:hover {
                        border: none;
                        color: #00ACED;
                    }
                </style>
                <label for="focusedinput" class="col-sm-2 control-label">Breed: <span style="color: red;">*</span></label>
                <div class="col-sm-8">
                    <input
                        class="form-control1"
                        id="breed"
                        placeholder=""
                        required
                        type="text"
                        value="{!! @str_replace('_', ' ', str_replace('_cat', '', $cat->cat_breed)) ?? 'Other' !!}"
                    />
                    <input
                        id="breed_name"
                        name="cat_breed"
                        type="hidden"
                        value="{!! $cat->cat_breed ?? 'Other' !!}"
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

<script>
$("#breed").autocomplete({
source: function(request, response){
    console.log("----------------------------------------------------------");
    console.log("--- breed info ---");
    console.log("request: " + JSON.stringify(request));
    console.log("response: " + response);

    $.ajax({
        type: "GET",
        url: '/autocompleteBreed',
        data: {
            searchTerm: request.term
        },
        success: function (data, textStatus) {
            console.log("status: " + textStatus);
            var responseJSON = data;
            console.log("responseJSON: " + JSON.stringify(responseJSON));
            response($.map(data, function(value) {
                return {
                    label: value.replace(/_cat$/, "").replace(/_/, " "),
                    value: value
                }
            }));
        },
        error: function (xmlHttpRequest, statusText, errorThrown) {
            console.log(
                'Your form submission failed.\n\n'
                + 'XML Http Request: ' + JSON.stringify(xmlHttpRequest)
                + ',\nStatus Text: ' + statusText
                + ',\nError Thrown: ' + errorThrown);
        }
    });
},
select: function(event, ui){
    console.log("ui.item.label " + ui.item.label + " - ui.item.value: " + ui.item.value);
    $("#breed").val(ui.item.label);
    $("#breed_name").val(ui.item.value).change();
    // $("#breed").change();
    event.preventDefault();
}
});

$("#breed_name").on("change", function () {
    var breed = $("#breed_name").val();
    console.log(breed);
    $.ajax({
    type: "GET",
        url: "/getCatBreedInfo",
        data: {
        breed_name: breed
    },
        success: function (data, textStatus, jqXHR) {
//                    console.log(data);
            var breedReceived = data;
            console.log("breedReceived: " + breedReceived);
            $("#wikiLink").text(breedReceived.link);
            $("#wikiLink").attr("href", breedReceived.link);
            $("#wikiInfo").text(breedReceived.description);
            console.log("CatBreedSent");
        },
        fail: function (jqXHR, textStatus, errorThrown) {
            console.log("ERROR:" + jqXHR);
            console.log("ERROR:" + textStatus);
        }
    })
});

$("#breed").on("change", function () {
    var breed = $("#breed").val().replace(/\ /, "_");
    $.ajax({
    type: "GET",
        url: "/getCatBreedInfo",
        data: {
        breed_name: breed
    },
        success: function (data, textStatus, jqXHR) {
//                    console.log(data);
            var breedReceived = data;
            console.log("breedReceived: " + JSON.stringify(breedReceived));
            $("#wikiLink").text(breedReceived.link);
            $("#wikiLink").attr("href", breedReceived.link);
            $("#wikiInfo").text(breedReceived.description);
            console.log("CatBreedSent");
            $("#breed_name").val(breedReceived.breed_name);
        },
        fail: function (jqXHR, textStatus, errorThrown) {
            console.log("ERROR:" + jqXHR);
            console.log("ERROR:" + textStatus);
        }
    })
});
</script>

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
                    <label for="smallinput" class="col-sm-2 control-label label-input-sm">Wanted daily food amount: <span style="color: red;">*</span></label>
                    <div class="col-sm-8">
                        <input
                            class="form-control1 input-sm"
                            max="5000"
                            min="1"
                            name="food_allowance"
                            placeholder=""
                            step="any"
                            type="number"
                            value="{!! !empty($cat->food_allowance) ? $cat->food_allowance : '' !!}"
                            required
                        >
                    </div>
                    <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                        <p class="help-block">Grams</p>
                    </div>
                </div>
            <div class="form-group">
                <label for="profilePicture" class="col-sm-2 control-label">Profile picture:</label>
                <div class="col-sm-8">
                    <input
                        class="filestyle"
                        id="profile_picture"
                        name="profile_picture"
                        style="margin-top: 6px"
                        type="file"
                    >
                </div>
            </div>

            <div class="">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button
                            class="btn-success btn"
                            id="submit_button"
                            form="cat_fields_form"
                            type="submit"
                        >
                            Submit
                        </button>
                        <button class="btn-inverse btn" type="reset">Reset</button>
                    </div>
                </div>
            </div>

        </form>
<script>
    $("#cat_name_input").on("change", function(event){
        console.log("--- cat_name_input change ---");

        var cat_id = "{!! $cat->id ?? 0!!}";
        var cat_name = $("#cat_name_input").val();
        console.log("cat_id: " + cat_id + " - cat_name: " + cat_name);

        $("#submit_button").addClass("disabled");
        $.getJSON(
            url = "{!! URL::route('add_cat_check_cat_exists') !!}",
            data = {
                cat_id: cat_id,
                cat_name: cat_name
            },
            success = function(data, textStatus, jqXHR){
                console.log("textStatus: " + textStatus);
                if(textStatus === "success"){
                    console.log("data: " + JSON.stringify(data));
                    if(data.exists){
                        $("#submit_button").addClass("disabled");
                        $("#errors_ul").children("#cat_name_error_li").remove();
                        $("#errors_ul").append(
                            $("<li></li>").attr("id", "cat_name_error_li").text("A cat by that name already exists. please choose another name.")
                        );
                    }else{
                        $("#errors_ul").children("#cat_name_error_li").remove();
                        if(! $("#errors_ul").is(":parent")){
                            $("#submit_button").removeClass("disabled");
                        }
                    }
                }
            }
        );
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
</script>
    </div>
</div>

