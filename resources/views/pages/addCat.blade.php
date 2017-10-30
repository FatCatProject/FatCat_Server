@extends('layouts.master')
@section('content')
    <script>
        $(document).ready(function () {
            $('#title').html('Add a new cat to the family:');
        });
    </script>
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Your cat familly:</h3>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-4"  style="padding-bottom: 25px;">
                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                    src="https://cdn2.iconfinder.com/data/icons/cat-power/128/cat_drunk.png"
                                    width="100px"></i>
                            <div  align="center" class="stats" style="padding-bottom: 10px">
                                <div class="grow groww">
                                    <p>Cat name</p>
                                </div>

                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>Ellie</td>
                                        </tr>
                                        <tr>
                                            <td>Breed:</td>
                                            <td>Devon rex</td>
                                        </tr>
                                        <tr>
                                            <td>Wiki page:</td>
                                            <td>some link</td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td>Female</td>
                                        </tr>
                                        <tr>
                                            <td>Birthday:</td>
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
                                        <div class="row" style="float: right;">
                                                <ul class="nav nav-pills">
                                                    {{--Edit will take to catPage--}}
                                                    <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
                                                </ul>

                                        </div>
                                    <!-- /.table-responsive -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"  style="padding-bottom: 25px;">
                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                    src="https://cdn3.iconfinder.com/data/icons/cat-force/128/cat_paper.png"
                                    width="100px"></i>
                            <div align="center" class="stats" style="padding-bottom: 10px">
                                <div class="grow grow1 groww">
                                    <p>Cat name</p>
                                </div>
                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>Ellie</td>
                                        </tr>
                                        <tr>
                                            <td>Breed:</td>
                                            <td>Devon rex</td>
                                        </tr>
                                        <tr>
                                            <td>Wiki page:</td>
                                            <td>some link</td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td>Female</td>
                                        </tr>
                                        <tr>
                                            <td>Birthday:</td>
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
                                    <div class="row" style="float: right;">
                                        <ul class="nav nav-pills">
                                            {{--Edit will take to catPage--}}
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
                                        </ul>

                                    </div>
                                    <!-- /.table-responsive -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"  style="padding-bottom: 25px;">
                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                    src="https://cdn3.iconfinder.com/data/icons/cat-force/128/cat_upsidedown.png"
                                    width="100px"></i>
                            <div align="center" class="stats" style="padding-bottom: 10px">
                                <div class="grow grow3 groww">
                                    <p>Cat name</p>
                                </div>
                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>Ellie</td>
                                        </tr>
                                        <tr>
                                            <td>Breed:</td>
                                            <td>Devon rex</td>
                                        </tr>
                                        <tr>
                                            <td>Wiki page:</td>
                                            <td>some link</td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td>Female</td>
                                        </tr>
                                        <tr>
                                            <td>Birthday:</td>
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
                                    <div class="row" style="float: right;">
                                        <ul class="nav nav-pills">
                                            {{--Edit will take to catPage--}}
                                            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
                                        </ul>

                                    </div>
                                    <!-- /.table-responsive -->
                                </form>
                            </div>
                        </div>
                    </div>






                </div>
            </div>
            <div class="row" style="margin: 25px">
                {{--spacing div please don't remove //Natalie--}}
            </div>
            <hr>
            @include("layouts.catFields")

            <div class="row" style="margin: 25px">
                {{--spacing div please don't remove //Natalie--}}
            </div>

        </div>
    </div>

@endsection