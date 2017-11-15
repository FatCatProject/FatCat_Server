@extends('layouts.master')
@section('content')
    <script>
        $(document).ready(function () {
            $('#title').html('Add a new cat to the family:');
        });
    </script>
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Available Food Boxes:</h3>
            <div class="col-sm-12">
                @php ($index = 0)
                    @for($row=0;$row<$numberOfRows;$row++)
                        <div class="row">
                            @for(;$index<sizeof($foodbox_data);$index++)
                                <div class="col-md-4" style="padding-bottom: 25px;">
                                    <input id="box_id" type="hidden" value="{!! $foodbox_data[$index]['id'] !!}">
                                    <div class="r3_counter_box">
                                        {{--If box has 1 cat , print Cat profile img
                                        If cat has no profile img print default Box img
                                        If box has more than 1 cat that can open it then print SharedBox img
                                        --}}
                                        <i class="fa" style="width: 150px; margin-left: -30px"><img
                                                src={!! $foodbox_data[$index]['profile_picture'] !!}
                                                    width="100px"></i>
                                        <div align="center" class="stats"
                                             style="padding-bottom: 10px;min-height: 250px">
                                            <div class="grow groww">
                                                <p id="box_{!! $foodbox_data[$index]['id']!!}_title">{!! $foodbox_data[$index]['foodbox_name']!!}</p>
                                            </div>

                                            <form class="form-horizontal">
                                                <input type="hidden" id="crr_id" class="crr_id" value="{!! $foodbox_data[$index]['id']!!}">
                                                <table class="catCardTable" style="margin-top: 30px">
                                                    <tbody>
                                                    <tr>
                                                        <td>Unique ID:</td>
                                                        <td>{!! $foodbox_data[$index]['foodbox_id']!!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Box name:</td>
                                                        <td id="box_{!! $foodbox_data[$index]['id']!!}_name">{!! $foodbox_data[$index]['foodbox_name']!!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Food type:</td>
                                                        <td id="box_{!! $foodbox_data[$index]['id']!!}_food">{!! $foodbox_data[$index]['food_name']!!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Current food amount:</td>
                                                        <td>{!! $foodbox_data[$index]['current_weight']!!} gram</td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td>Opens by:</td>
                                                        {{--can be 1 or more--}}
                                                        <td>{!! $foodbox_data[$index]['cat_name']!!}</td>
                                                    </tr>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="row" style="float: right;">
                                                    <ul class="nav nav-pills">
                                                        {{--Edit will take to catPage--}}
                                                        <li class="editBtn" id="editBtn"><a><i
                                                                    class="lnr lnr-pencil editValues"
                                                                    onclick=""></i></a></li>
                                                    </ul>

                                                </div>
                                                <!-- /.table-responsive -->
                                            </form>

                                        </div>

                                    </div>
                                    {{--Edit form--}}
                                    <div id="editForm" hidden>
                                        <form class="form-horizontal">
                                            <div class="r3_counter_box" style="padding:25px 0 5px 0px">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="focusedinput">Box name:
                                                        <span
                                                            style="color: red;">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input
                                                            class="form-control1"
                                                            id="new_box_name"
                                                            name="new_box_name"
                                                            placeholder=""
                                                            required
                                                            type="text"
                                                            value=""
                                                        />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-3 control-label">Food type:
                                                        <span style="color: red;">*</span></label>
                                                    <!--Full dropdown without ajax-->
                                                    <div class="col-sm-8">
                                                        <select name="new_food_type"
                                                                class="form-control1" required>
                                                            <option value="" name=""  disabled>Please choose a
                                                                food
                                                                product:
                                                            </option>
                                                            @if(!empty($foods))
                                                                @foreach($foods as $food)
                                                                    <option
                                                                        value="{!! $food->id !!}"
                                                                        name="new_food_id"
                                                                        {!! ($food->food_name == $foodbox_data[$index]['food_name']) ?
                                                                        'selected' : ''!!}
                                                                    >{!! $food->food_name !!}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row" align="left" style="margin-left: 5px">
                                                        <div class="col-lg-12">
                                                            <button id="updateBtn" type="submit" class="btn-success btn updateBtn"
                                                                    form="update">Update
                                                            </button>
                                                            <button id="cancelBtn" type="reset" class="btn-inverse btn cancelBtn">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endfor
                            @endfor

                        </div>
                        <br/><br/><br/><br/><br/>
            </div>
        </div>
    </div>
    <script>
        {{--Click on edit opens edit diolog and populates fields--}}
        $(document).ready(function () {
            $(".editBtn").click(function () {
                console.log("bla:");
                var crr_box_id  = $(this).parent().parent().parent().find('#crr_id').val();
                var crr_food_name =$(this).parent().parent().parent().find('#box_'+crr_box_id+'_name').text();
                console.log("crr_box_id:"+crr_box_id);
                console.log("crr_food_name:"+crr_food_name);
                $(this).parent().parent().parent().parent().parent().parent().find('#editForm').show();
                $(this).parent().parent().parent().parent().parent().parent().find('#new_box_name').val(crr_food_name);



            });
            {{--Click on Cancel closes edit diolog--}}
            $(".cancelBtn").click(function () {
                $(this).parent().parent().parent().parent().parent().parent().parent().find('#editForm').hide();
            });
        });


        //Update foodbox info
        $(document).ready(function () {
            $('.updateBtn').on("click", function () {
                var id = $(this).parent().parent().parent().parent().parent().parent().parent().find('#box_id').val(); //foodBoxID
                var new_box_name = $(this).parent().parent().parent().parent().find('#new_box_name').val();
                var new_food_name = $(this).parent().parent().parent().parent().find(':selected').text();
                var new_food_id = $(this).parent().parent().parent().parent().find(':selected').val();

                console.log("this is the id:"+id);
                console.log("new name:"+new_box_name);
                console.log("new food:"+new_food_name);
                console.log("new food id:"+new_food_id);

                $.ajax({
                    type: "GET",
                    url: './updateBox',
                    caller: id,
                    data: {
                        id: id,
                        new_box_name: new_box_name,
                        new_food_name: new_food_name,
                        new_food_id:new_food_id
                    },
                    success: function (data, textStatus, jqXHR) {
                        console.log("textStatus: " + textStatus);
                        var new_box_name = data.new_box_name;
                        var new_food_name = data.new_food_name;
                        console.log("new_box_name_back_" +new_box_name+ " " +this.caller);
                        console.log("new_food_name_back_" +new_food_name+ " " + this.caller);

                        $("#box_" + this.caller+"_name").html(new_box_name);
                        $("#box_" + this.caller+"_food").html(new_food_name);
                        $("#box_" + this.caller+"_title").html(new_box_name);
                        console.log("#box_" + this.caller+"_name");
                        console.log("#box_" + this.caller+"_food");
                    },
                    fail: function (jqXHR, textStatus, errorThrown) {
                        console.log("ERROR:" + jqXHR);
                        console.log("ERROR:" + textStatus);
                    }
                })
                $(this).parent().parent().parent().parent().parent().parent().parent().find('#editForm').hide();

            });

        });
    </script>

@endsection