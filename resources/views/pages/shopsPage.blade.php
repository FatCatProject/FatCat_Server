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
                {{--add product--}}
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
                                    <label for="checkbox" class="col-sm-3 control-label">Food product? </label>
                                    <div class="col-sm-8">
                                        <div class="checkbox-inline"><label><input type="checkbox">Yes</label></div>
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
                        <tr id="1">
                            {{--the url has to be a cklicable LINK, put the same value in HREF as the address itself--}}
                            <td class="editableColumns">Best Pet</td>
                            <td class="editableColumns"><a href="https://www.chewy.com/" target="_blank">https://www.chewy.com/</a></td>
                            <td class="editableColumns">228 Park Ave S, New York</td>
                            <td class="editableColumns">Sunday-Thursday: 8:00-18-00 , Friday:8:00- 14:00</td>
                            <td class="editableColumns">0544-444444</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues"
                                                                         onclick=""></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="2">
                            <td class="">Best Pet</td>
                            <td class="">https://www.chewy.com/</td>
                            <td class="">228 Park Ave S, New York</td>
                            <td class="">Sunday-Thursday: 8:00-18-00 , Friday:8:00- 14:00</td>
                            <td class="">0544-444444</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="3">
                            <td class="">Best Pet</td>
                            <td class="">https://www.chewy.com/</td>
                            <td class="">228 Park Ave S, New York</td>
                            <td class="">Sunday-Thursday: 8:00-18-00 , Friday:8:00- 14:00</td>
                            <td class="">0544-444444</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="4">
                            <td class="">Best Pet</td>
                            <td class="">https://www.chewy.com/</td>
                            <td class="">228 Park Ave S, New York</td>
                            <td class="">Sunday-Thursday: 8:00-18-00 , Friday:8:00- 14:00</td>
                            <td class="">0544-444444</td>
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
                        <tr id="1">
                            <td class="editableColumns">Royal canin fit 32</td>
                            <td class="editableColumns">15kg</td>
                            <td class="editableColumns">Food</td>
                            <td class="editableColumns">Some img</td>
                            <td class="editableColumns">300nis</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues"
                                                                         onclick=""></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="2">
                            <td class="">Royal canin fit</td>
                            <td class="">2kg</td>
                            <td class="">Food</td>
                            <td class="">Some img</td>
                            <td class="">100nis</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="3">
                            <td class="">Apple sand</td>
                            <td class="">12kg</td>
                            <td class=""></td>
                            <td class="">Some img</td>
                            <td class="">100nis</td>
                            <td>
                                <ul class="nav nav-pills">
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr id="4">
                            <td class="">LaCat chicken</td>
                            <td class="">1kg</td>
                            <td class="">Food</td>
                            <td class="">Some img</td>
                            <td class="">30nis</td>
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