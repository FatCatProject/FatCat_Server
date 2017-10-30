@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Favorite shops & products:</h3>
            {{--add shop--}}
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="blank1">Add shop:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addShop" id="addShop">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Shop name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="shop_name" class="form-control1" id="shopName"
                                               placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Url:</label>
                                    <div class="col-sm-8">
                                        <input type="url" name="url" class="form-control1" id="shopUrl" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-8"><textarea name="address" id="shopAddress"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 30px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Opening hours:</label>
                                    <div class="col-sm-8"><textarea name="hours" id="shopHours"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 30px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Phone number:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="phone" class="form-control1" id="shopTel"
                                               pattern="[0-9]+((?:[0-9]+-)*)[0-9]+" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn-success btn" form="addShop">Add</button>
                                            <button class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{--add product--}}
                <div class="col-sm-6">
                    <h4 class="blank1">Add product:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addProduct" id="addProduct">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="product_name" class="form-control1" id="itemName"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Weight:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" name="weight" id="itemWeight"
                                               step="any" min="0"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" name="price" id="itemPrice"
                                               step="any" min="0"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="checkbox" class="col-sm-3 control-label">Food product? </label>
                                    <div class="col-sm-8">
                                        <div class="checkbox-inline"><label><input type="checkbox"
                                                                                   name="is_food">Yes</label></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profilePicture" class="col-sm-3 control-label">Picture:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="picture" id="itemPicture" class="filestyle"
                                               data-buttonBefore="true" style="margin-top: 6px">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn-success btn" form="addProduct">Add</button>
                                            <button class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--Table of shops-->
            <div class="tab-content">
                <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                     data-widget-static="">
                    <div class="row" style="padding: 14px 0px 6px 30px;">
                        <h4>Favorite shops:</h4>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr class="warning">
                            <th>Shop name</th>
                            <th>Url</th>
                            <th>Address</th>
                            <th>Opening hours</th>
                            <th>Phone number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($index=0;$index<10 && count($shops)>0;$index++)
                            @if(empty($shops[$index]))
                            @else
                                <tr id="{!! $index !!}">
                                    {{--the url has to be a cklicable LINK, put the same value in HREF as the address itself--}}
                                    <td class="editableColumns">{!! $shops[$index]->shop_name !!}</td>
                                    <td class="editableColumns"><a href="{!! $shops[$index]->url !!}"
                                                                   target="_blank">{!! $shops[$index]->url !!}</a>
                                    </td>
                                    <td class="editableColumns">{!! $shops[$index]->address !!}</td>
                                    <td class="editableColumns">{!! $shops[$index]->hours !!}</td>
                                    <td class="editableColumns">{!! $shops[$index]->phone !!}</td>
                                    <td>
                                        <ul class="nav nav-pills">
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues"
                                                                                 onclick=""></i></a></li>
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @endfor
                        </tbody>
                    </table>
                    <div align="right" class="col-md-12 page_1">
                        <nav>
                            <ul class="pagination">
                                <li class="disabled"><a href="#" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                                </li>
                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!--END Table -->
            <br>
            <!--Table of products-->
            <div class="tab-content">
                <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                     data-widget-static="">
                    <div class="row" style="padding: 14px 0px 6px 30px;">
                        <h4>Favorite products:</h4>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr class="warning">
                            <th>Product name</th>
                            <th>Weight</th>
                            <th>Type</th>
                            <th>Picture</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<10 && count($products)>0;$i++)
                            @if(empty($products[$i]))
                            @else
                                <tr id="{!! $i !!}">
                                    <td class="editableColumns">{!! $products[$i]->product_name !!}</td>
                                    <td class="editableColumns">{!! $products[$i]->weight !!}</td>
                                    @if($products[$i]->is_food == 1)
                                        <td class="editableColumns">Food</td>
                                    @else
                                        <td class="editableColumns">Not Food</td>
                                    @endif
                                    <td class="editableColumns">{!! $products[$i]->picture !!}</td>
                                    <td class="editableColumns">{!! $products[$i]->price !!}</td>
                                    <td>
                                        <ul class="nav nav-pills">
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues"
                                                                                 onclick=""></i></a></li>
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @endfor
                        </tbody>
                    </table>
                    <div align="right" class="col-md-12 page_1">
                        <nav>
                            <ul class="pagination">
                                <li class="disabled"><a href="#" aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                                </li>
                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!--END Table -->
        </div>
        <br><br><br>
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