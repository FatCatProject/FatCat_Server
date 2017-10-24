@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Favorite shops & products:</h3>



            {{--add items--}}
            <div class="row">
                <div class="col-md-6">
                    <div class="banner-bottom-video-grid-left">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingShop">
                                    <h4 class="panel-title asd">
                                        <a class="pa_italic collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                           aria-controls="collapseThree">
                                            <span class="lnr lnr-chevron-down"></span><i
                                                    class="lnr lnr-chevron-up"></i><label>Add shop</label>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body panel_text">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="banner-bottom-video-grid-left">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingItem">
                                    <h4 class="panel-title asd">
                                        <a class="pa_italic collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                           aria-controls="collapseThree">
                                            <span class="lnr lnr-chevron-down"></span><i
                                                    class="lnr lnr-chevron-up"></i><label>Add product</label>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body panel_text">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            {{--add shop--}}
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="blank1">Add shop:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Shop name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="shopName" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Url:</label>
                                    <div class="col-sm-8">
                                        <input type="url" class="form-control1" id="shopUrl" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-8"><textarea name="shopAddress" id="shopAddress"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 30px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Opening hours:</label>
                                    <div class="col-sm-8"><textarea name="shopHours" id="shopHours"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 30px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Phone number:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="shopTel"
                                               pattern="[0-9]+((?:[0-9]+-)*)[0-9]+" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn-success btn">Add</button>
                                            <button class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{--add shop--}}
                <div class="col-sm-6">
                    <h4 class="blank1">Add product:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="itemName" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Weight:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" id="itemWeight" step="any" min="0"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" id="itemPrice" step="any" min="0"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="radio" class="col-sm-3 control-label">Type:</label>
                                    <div class="col-sm-8">
                                        <div class="radio-inline"><label><input type="radio" name="itemType"
                                                                                value="food">Food<br></label>
                                        </div>
                                        <div class="radio-inline"><label><input type="radio" name="itemType"
                                                                                value="sand"
                                                                                checked="true">Sand<br></label>
                                        </div>
                                        <div class="radio-inline"><label><input type="radio" name="itemType"
                                                                                value="other"
                                                                                checked="true">Other<br></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profilePicture" class="col-sm-3 control-label">Picture:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="itemPicture" id="itemPicture" class="filestyle"
                                               data-buttonBefore="true" style="margin-top: 6px">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn-success btn">Add</button>
                                            <button class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--Table-->
            <div class="tab-content">
                <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                     data-widget-static="">
                    <div class="row" style="padding: 10px">
                        <div class="col-sm-1">
                            <div class="input-group" style="margin: 0px 0px 0px 0px; width: 30%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="logsMonth" name="dateMonth" placeholder="MM/YYYY"
                                       type="text" style="width: 90px; "/>
                            </div>
                        </div>
                        <div class="col-sm-10" style="margin:8px 0 0 25px;color: #999; font-size: 13px;">
                            Pick a month or view 10 last purchases
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr class="warning">
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="1">
                            <td class="editableColumns">2017-10-14</td>
                            <td class="editableColumns">Food for Ellie</td>
                            <td class="editableColumns">15kg royal canin for Ellie, had 10% disscount</td>
                            <td class="editableColumns">100</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues"
                                                                         onclick=""></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="2">
                            <td>2017-10-14</td>
                            <td>Sand</td>
                            <td>Sand "Apple tree", item was on sale</td>
                            <td>200</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="3">
                            <td>2017-10-14</td>
                            <td>Treats and food</td>
                            <td>3kg laCat and 2 boxed of tuna</td>
                            <td>30</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="4">
                            <td>2017-10-14</td>
                            <td>Scratching stand</td>
                            <td>Scratching stand with 3 floors</td>
                            <td>100</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
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