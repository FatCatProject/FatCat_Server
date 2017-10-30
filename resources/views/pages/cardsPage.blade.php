@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Cards Manager:</h3>
            {{--Cards Manager--}}
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="blank1">Add cat card:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">ID:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control1" id="cardID"
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control1" id="shopUrl" placeholder="">
                                        </div>
                                    </div>
                                    {{--Choose cat--}}
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Belongs to:</label>
                                        <!--Full dropdown without ajax-->
                                        <div class="col-sm-9">
                                            <select name="foodBox" id="foodBox" class="form-control1">
                                                <option value="" name="" selected disabled>Please choose a cat for this card:
                                                </option>
                                                <option value="1" name="1">Ellie</option>
                                                <option value="2" name="2">Elf</option>
                                                <option value="3" name="3">Chavka</option>
                                                {{--@foreach ($breeds as $breed)--}}
                                                {{--<option value="{!! $breed !!}"--}}
                                                {{--name="{!! $breed !!}">{!! $breed !!}</option>--}}
                                                {{--@endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    {{--Choose which box to open--}}
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Opens foodbox:</label>
                                        <!--Full dropdown without ajax-->
                                        <div class="col-sm-9">
                                            <select name="foodBox" id="foodBox" class="form-control1">
                                                <option value="" name="" selected disabled>Please choose a foodbox this
                                                    card can open:
                                                </option>
                                                <option value="1" name="1">box 1</option>
                                                <option value="2" name="2">box 2</option>
                                                <option value="3" name="3">box 3</option>
                                                {{--@foreach ($breeds as $breed)--}}
                                                {{--<option value="{!! $breed !!}"--}}
                                                {{--name="{!! $breed !!}">{!! $breed !!}</option>--}}
                                                {{--@endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-3 control-label">Active:</label>
                                        <div class="col-sm-9">
                                            <div class="checkbox-inline"><label><input type="checkbox">Yes</label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5" style="margin:50px 0 0 15px">
                                        <button class="btn-success btn">Add Cat Card</button>
                                        <button class="btn-inverse btn">Reset</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                {{--admin cards--}}
                <div class="col-sm-6 vr">
                    <h4 class="blank1">Add admin card:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">ID:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control1" id="cardID"
                                                   pattern="\b\d{3}-\d{3}-\d{3}-\d{3}-\d{3}\b" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control1" id="shopUrl" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkbox" class="col-sm-3 control-label">Active:</label>
                                        <div class="col-sm-9">
                                            <div class="checkbox-inline"><label><input type="checkbox">Yes</label></div>
                                        </div>
                                    </div>

                                    <h6>* This card will open all available food boxes</h6>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5" style="margin:50px 0 0 15px">
                                        <button class="btn-success btn">Add Admin Card</button>
                                        <button class="btn-inverse btn">Reset</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-12" >
                    <!--Table of cards-->
                    <div class="tab-content" style="margin-left: 25px">
                        <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                             data-widget-static="" style="margin-top: 0px">
                            <div class="row" style="padding: 14px 0px 6px 30px;">
                                <h4>Registered cards:</h4>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr class="warning">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Opens foodbox</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="1">
                                    {{--the url has to be a cklicable LINK, put the same value in HREF as the address itself--}}
                                    <td class="editableColumns">111-111-111-111-111</td>
                                    <td class="editableColumns">Ellie's Card</td>
                                    <td class="editableColumns">1</td>
                                    <td class="editableColumns">Yes</td>
                                    <td>
                                        <ul class="nav nav-pills">
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues"
                                                                                 onclick=""></i></a></li>
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id="2">
                                    <td class="">222-222-222-222-222</td>
                                    <td class="">Chavkas's Card</td>
                                    <td class="">2</td>
                                    <td class="">Yes</td>
                                    <td>
                                        <ul class="nav nav-pills">
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr id="3">
                                    <td class="">333-333-333-333-333</td>
                                    <td class="">Elf's Card</td>
                                    <td class="">3</td>
                                    <td class="">No</td>
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


            </div>
            {{--End Cards--}}
            <hr>
            {{--Boxes Manager--}}
            <div class="row">


            </div>
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