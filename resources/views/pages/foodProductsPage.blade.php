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
                                        <div class="r3_counter_box">
                                            <i class="fa" style="width: 150px;"><img
                                                        src="/images/food2.png"
                                                        width="100px"></i>
                                            <div class="stats">
                                                <div class="row" style="margin:0px 0px 0 0">
                                                    <h5>{!! $myFoods[$index]->weight_left !!} <span>grams left</span>
                                                    </h5>
                                                </div>
                                                <div class="grow foodGrow">
                                                    <p>{!! $myFoods[$index]->food_name !!}</p>
                                                </div>
                                                <div class="row" style="margin:-18px; float: right ">
                                                    <ul class="nav nav-pills">
                                                        {{--Edit will take to catPage--}}
                                                        <li id="addMoreProduct" class=""><a href="#"><i class="lnr lnr-plus-circle editValues" onclick=""></i>Add</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                {{--Popup--}}
                                                <div id="addDialog" title="Add more product:">
                                                    <p></p>
                                                </div>
                                                {{--Popup--}}
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

        $(document).ready(function () {
            $("#addMoreProduct").click(function () {
                $("#addDialog").dialog({modal: true, height: 590, width: 1005 });
            });
        });

    </script>
@endsection