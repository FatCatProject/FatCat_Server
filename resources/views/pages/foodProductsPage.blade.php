@extends('layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Food Products Manager:</h3>
            {{--Cards Manager--}}
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="blank1">Add new food product that will be used in the food boxes:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addFood" id="addFoodForm">
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
                                            <input type="number" name="weight_left" step="any" min="0" max="1000"
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
                                            <input type="file" name="profile_picture" id="profilePicture"
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
                                    <div class="col-md-3 widget widget1" style="padding: 10px 0px">
                                        <div style="background-color: white; box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);">
                                            <ul class="nav nav-pills">
                                                <li><a href="#"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
                                                <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="r3_counter_box">
                                            <i class="fa" style="width: 150px;"><img
                                                        src="/images/food2.png"
                                                        width="100px"></i>
                                            {{----}}
                                            <div class="stats">

                                                <div class="gramsNow row" style="margin:0px 0px 0 0">
                                                    <h5>{!! $myFoods[$index]->weight_left !!} <span>grams left</span>
                                                    </h5>
                                                </div>
                                                {{--GramsToADD--}}
                                                <div hidden class="row gramsToAdd" style="margin: 20px 0px 0px;">
                                                        <div class="col-sm-6">
                                                            <input type="number" name="addFoodWeight" step="any" min="0" max="10000"
                                                                   class="form-control1" id="currentWeight" placeholder="" required>
                                                        </div>
                                                        <div class="col-sm-2"  style="margin-top: 20px">
                                                            <p class="help-block">Grams</p>
                                                        </div>
                                                        <div class="col-sm-4"  style="padding: 0px;">
                                                                <ul class="nav nav-pills">
                                                                    <li><a><i class="lnr lnr-checkmark-circle"></i></a></li>
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
    </script>

  popup

    <br><br><br>
@endsection