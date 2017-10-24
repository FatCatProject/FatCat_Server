@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Favorite shops:</h3>
            <!---728x90--->
            <div class="row">
                <div class="col-sm-7">
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="catDob" class="col-sm-2 control-label">Date:</label>
                                    <div class="row" style="padding: 10px">
                                        <div class="input-group" style="margin: 0px 0px 0px 15px">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" id="vetDate" name="date"
                                                   placeholder="MM/DD/YYYY"
                                                   type="text" style="width: 120px;"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Subject:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="vetLogSubject" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-2 control-label">Description:</label>
                                    <div class="col-sm-8"><textarea name="vetLogDescription" id="vetLogDescription"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 70px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="smallinput" class="col-sm-2 control-label label-input-sm">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="any" min="0" max="100" class="form-control1 input-sm"
                                               id="vetLogPrice" placeholder="">
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
                    <table class="table table-striped"   >
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
                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
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
            $(this).parents('tr').find('td.editableColumns').each(function() {
                var html = $(this).text();
                var input = $('<input class="editableColumnsStyle" type="text" />');
                input.val(html);
                $(this).html(input);
            });
        });


    </script>
@endsection