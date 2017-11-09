@extends('layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="graphs" id="Edit">
            <h3 class="blank1">Food Products Manager:</h3>
            {{--Cards Manager--}}
            <div class="row">
                {{--Add Product Block--}}
                <div id="addProductBlock" class="col-sm-6">
                    <h4 class="blank1">Add new food product that will be used in the food boxes:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="addFood" id="addFoodForm">
                                {!! csrf_field() !!}
                                <div class="col-sm-12">
                                    {{--Product name--}}
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name: <span style="color: red;">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" name="food_name" id="shopUrl"
                                                   placeholder="" required>
                                        </div>
                                    </div>
                                    {{--product weight--}}
                                    <div class="form-group">
                                        <label for="foodWeight"
                                               class="col-sm-3 control-label label-input-sm">Weight: <span style="color: red;">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="number" name="weight_left" step="any" min="0" max="100000"
                                                   class="form-control1 input-sm" id="currentWeight" placeholder="Enter weight in Grams" required>
                                        </div>
                                        <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                                            <p class="help-block">Grams</p>
                                        </div>
                                    </div>
                                    {{--Product picture--}}
                                    <div class="form-group">
                                        <label for="profilePicture" class="col-sm-3 control-label">Product
                                            picture:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="picture" id="picture"
                                                   class="filestyle"
                                                   data-buttonBefore="true" style="margin-top: 6px">
                                            {{--<p class="help-block">Example block-level help text here.</p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5" style="margin:20px 0 0 15px">
                                        <button type="submit" class="btn-success btn" form="addFoodForm">Add Product</button>
                                        <button type="reset" class="btn-inverse btn">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
{{--Edit Product Block--}}
                <div hidden id="editProductBlock" class="col-sm-6">
                    <h4 class="blank1">Edit product:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="editFood" id="editFoodForm">
                                {!! csrf_field() !!}
                                <input type="hidden" name="oldname" id="oldname" value="">
                                <div class="col-sm-12">
                                    {{--Product name--}}
                                    <div class="form-group">

                                        <label for="focusedinput" class="col-sm-3 control-label">Name: <span style="color: red;">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" name="food_name" id="food_name_to_edit"
                                                   placeholder="" required>
                                            <input type="hidden" name="id" id="food_id_to_edit" value="">
                                        </div>
                                    </div>
                                    {{--Product picture--}}
                                    <div class="form-group">
                                        <label for="profilePicture" class="col-sm-3 control-label">Product
                                            picture:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="profile_picture" id="food_profilePicture_to_edit"
                                                   class="filestyle"
                                                   data-buttonBefore="true" style="margin-top: 6px">
                                            {{--<p class="help-block">Example block-level help text here.</p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5" style="margin:20px 0 0 15px">
                                        <button id="editFoodProductBtn" type="submit" class="btn-success btn" form="editFoodForm">Edit Product</button>
                                        <button id="cancelEditFoodProductBtn" type="reset" class="btn-inverse btn">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--End Edit Product Block--}}

                <div class="col-sm-5" style="padding: 20px">
                    <img src="/images/catFood.png" width="100px">
                </div>
            </div>
            <hr>
            <div class="row" style="padding-top: 20px">
                {{--Foods--}}
                <div class="widgets_top">
                    @php ($index = 0)
                    @for($row=0;$row<$numberOfRows;$row++)
                            @for(;$index<count($myFoods);$index++)
                                @if(!empty($myFoods))
                                    <div id="food_id_{!! $myFoods[$index]->id !!}" class="col-md-3 widget widget1" style="padding: 10px 0px">
                                        <div style="background-color: white; box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);">
                                            <ul class="nav nav-pills">
                                                <li class="editFoodBtn"><a href="#Edit"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>

                                                <li class="deleteFoodBtn"><a><i class="lnr lnr-trash"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="r3_counter_box">
                                            <i class="fa" style="width: 150px;"><img
                                                        src="{!! $food_pictures[$myFoods[$index]->id] !!}"
                                                        width="100px"></i>
                                            {{----}}
                                            <div class="stats">
                                                <input type="hidden" id="foodID" value="{!! $myFoods[$index]->id !!}">
                                                <input type="hidden" id="foodName" value="{!! $myFoods[$index]->food_name !!}">
                                                <div class="gramsNow row" style="margin:0px 0px 0 0">
                                                    <h5 id="weight_left_id{!! $myFoods[$index]->id !!}">{!! $myFoods[$index]->weight_left !!} <span>grams left</span>
                                                    </h5>
                                                </div>
                                                {{--GramsToADD--}}
                                                <div hidden class="row gramsToAdd" style="margin: 20px 0px 0px;">
                                                        <div class="col-sm-6" style="padding: 0px;">
                                                            <input type="number" id="addFoodWeight" step="any" min="0" max="10000"
                                                                   class="form-control1" id="currentWeight" placeholder="" required>
                                                        </div>
                                                        <div class="col-sm-2"  style="padding:0px; margin-top: 20px">
                                                            <p class="help-block">Grams</p>
                                                        </div>
                                                        <div class="col-sm-4"  style="padding: 0px;">
                                                                <ul class="nav nav-pills">
                                                                    <li class="updateBtn"><a><i class="lnr lnr-checkmark-circle"></i></a></li>
                                                                    <li class="cancelAdd"><a><i class="lnr lnr-cross-circle"></i></a></li>
                                                                </ul>
                                                        </div>

                                                </div>

                                                <div class="grow foodGrow">
                                                    <p>{!! $myFoods[$index]->food_name !!}</p>
                                                </div>
                                                <div class="addBtn row" style="margin:-18px; float: right ">
                                                    <ul class="nav nav-pills">
                                                        <li class="add"><a><i
                                                                        class="lnr lnr-plus-circle editValues"
                                                                        onclick=""></i>Add</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif
                            @endfor
                        </div>
                    @endfor
                </div>
                <!---728x90--->
            </div>
        </div>
        <br><br><br>


    <script>
        $(document).ready(function(){
            $(".add").click(function(){
                $(this).parent().parent().parent().find('.gramsNow').hide();
                $(this).parent().parent().hide();
                $(this).parent().parent().parent().find('.gramsToAdd').show();
            });
            $(".cancelAdd").click(function(){
                $(this).parent().parent().parent().hide();
                $(this).parent().parent().parent().parent().find('.addBtn').show();
                $(this).parent().parent().parent().parent().find('.gramsNow').show();

            });
        });

//Update Food Amount in grams
        $(document).ready(function () {
            $('.updateBtn').on("click", function () {
                var id = $(this).parent().parent().parent().parent().find('#foodID').val();
                var addFoodWeight = $(this).parent().parent().parent().find('#addFoodWeight').val();
                console.log("this is the id:"+id);
                console.log(addFoodWeight);
                $.ajax({
                    type: "GET",
                    url: './updateWeight',
                    caller: id,
                    data: {
                        id: id,
                        addFoodWeight: addFoodWeight
                    },
                    success: function (data, textStatus, jqXHR) {
                        console.log("hhhhh "+data.newWeight);
                        var newWeight = data.newWeight;
                        console.log("weight_left_id" + this.caller);
                        $("#weight_left_id" + this.caller).html(newWeight+"<span>&nbsp;&nbsp;grams left</span>");
                    },
                    fail: function (jqXHR, textStatus, errorThrown) {
                        console.log("ERROR:" + jqXHR);
                        console.log("ERROR:" + textStatus);
                    }
                })
                $(this).parent().parent().parent().hide();
                $(this).parent().parent().parent().parent().find('.addBtn').show();
                $(this).parent().parent().parent().parent().find('.gramsNow').show();
            });

        });



//  Edit name/picture for a specific food
        $(document).ready(function(){
            $(".editFoodBtn").click(function(){
                var id = $(this).parent().parent().parent().find('#foodID').val();
                var foodName = $(this).parent().parent().parent().find('#foodName').val();
                var oldname = $(this).parent().parent().parent().find('#foodName').val();


                console.log("id is" + id);
                console.log("name is" +foodName);
                $("#addProductBlock").hide();
                $("#editProductBlock").show();
                $("#food_name_to_edit").val(foodName);
                $("#food_id_to_edit").val(id);
                $("#oldname").val(oldname);
//                $("#food_profilePicture_to_edit").val(); // TODO
            });
            $("#cancelEditFoodProductBtn").click(function(){
                $("#addProductBlock").show();
                $("#editProductBlock").hide();

            });
        });

        //Delete Food Product
        $(document).ready(function () {
            $('.deleteFoodBtn').on("click", function () {
                var id = $(this).parent().parent().parent().find('#foodID').val();
                var foodName = $(this).parent().parent().parent().find('#foodName').val();
                console.log("id is" + id);
                console.log("name is" +foodName);
                $.ajax({
                    type: "GET",
                    url: './deleteFood/'+id,
                    caller: id,
                    data: {
                        id: id,
                    },
                    success: function (data, textStatus, jqXHR) {
                        $("#food_id_" + this.caller).hide();
                    },
                    fail: function (jqXHR, textStatus, errorThrown) {
                        console.log("ERROR:" + jqXHR);
                        console.log("ERROR:" + textStatus);
                    }
                })
            });
        });
    </script>
    <br><br><br>
@endsection
