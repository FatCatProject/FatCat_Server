@extends('layouts.master')
@section('content')
    <script>
        $( document ).ready(function() {
            $('#title').html('Add a new cat to the family:');
        });
    </script>
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Your cat familly:</h3>
            <div class="col-sm-12" >
                <div class="row">
                    <div class="col-md-4">
                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                    src="https://cdn2.iconfinder.com/data/icons/cat-power/128/cat_drunk.png" width="100px"></i>
                            <div class="stats">
                                <div class="grow">
                                    <p>Cat name</p>
                                </div>



                                <div class="">
                                    <div class="">
                                        <table class="table catCardTable">
                                            <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>Ellie</td>
                                            </tr>
                                            <tr>
                                                <td>Breed</td>
                                                <td>Devon rex</td>
                                            </tr>
                                            <tr>
                                                <td>Wiki page</td>
                                                <td>some link</td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>Female</td>
                                            </tr>
                                            <tr>
                                                <td>Birthday</td>
                                                <td>2007-10-10</td>
                                            </tr>
                                            <tr>
                                                <td>Current weight:</td>
                                                <td>5</td>
                                            </tr>
                                            <tr>
                                                <td>Target weight:</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <td>Daily calories:</td>
                                                <td>400</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                    src="https://cdn3.iconfinder.com/data/icons/cat-force/128/cat_paper.png" width="100px"></i>
                            <div class="stats">
                                <h5>150 <span>gr</span></h5>
                                <div class="grow grow1">
                                    <p>Cat name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                    src="https://cdn3.iconfinder.com/data/icons/cat-force/128/cat_upsidedown.png"
                                    width="100px"></i>
                            <div class="stats">
                                <h5>10 <span>gr</span></h5>
                                <div class="grow grow3">
                                    <p>Cat name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin: 50px">
            {{--spacing div please don't remove //Natalie--}}
            </div>
    @include("layouts.catFields")
<hr>

    <div class="col-sm-12" >
        <!--Table of cards-->
        <div class="tab-content" style="margin-left: 25px">
            <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"
                 data-widget-static="" style="margin-top: 0px">
                <div class="row" style="padding: 14px 0px 6px 30px;">
                    <h4>All cats:</h4>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr class="warning">
                        <th>Name</th>
                        <th>Breed</th>
                        <th>Wiki page</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Current weight</th>
                        <th>Target weight</th>
                        <th>Daily calories</th>
                        <th>Profile picture</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="1">
                        {{--the url has to be a cklicable LINK, put the same value in HREF as the address itself--}}
                        <td class="editableColumns">Ellie</td>
                        <td class="editableColumns">Devon_Rex</td>
                        <td class=""><a href="https://en.wikipedia.org/wiki/Devon_Rex">https://en.wikipedia.org/wiki/Devon_Rex</td>
                        <td class="editableColumns">female</td>
                        <td class="editableColumns">2007-12-12</td>
                        <td class="editableColumns">5</td>
                        <td class="editableColumns">4</td>
                        <td class="editableColumns">400</td>
                        <td class="editableColumns">some img</td>
                        <td>
                            <ul class="nav nav-pills">
                                <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues"
                                                                     onclick=""></i></a></li>
                                <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr id="2">
                        <td class="">Elf</td>
                        <td class="">Devon_Rex</td>
                        <td class="">https://en.wikipedia.org/wiki/Devon_Rex</td>
                        <td class="">female</td>
                        <td class="">2007-12-12</td>
                        <td class="">5</td>
                        <td class="">4</td>
                        <td class="">400</td>
                        <td class="">some img</td>
                        <td>
                            <ul class="nav nav-pills">
                                <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i></a></li>
                                <li class="menu-list"><a href="#"><i class="lnr lnr-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr id="3">
                        <td class="">Chavka</td>
                        <td class="">Devon_Rex</td>
                        <td class="">https://en.wikipedia.org/wiki/Devon_Rex</td>
                        <td class="">female</td>
                        <td class="">2007-12-12</td>
                        <td class="">5</td>
                        <td class="">4</td>
                        <td class="">400</td>
                        <td class="">some img</td>
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
        <br><br><br><br><br><br>
        <!--END Table -->

    </div></div></div>

@endsection