@extends('layouts.master')
@section('content')
    <script>
        $(document).ready(function () {
            $('#title').html('Add a new cat to the family:');
        });
    </script>
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Available Food Boxes:</h3>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-4"  style="padding-bottom: 25px;">
                        <div class="r3_counter_box">
                            {{--If box has 1 cat , print Cat profile img
                            If cat has no profile img print default Box img
                            If box has more than 1 cat that can open it then print SharedBox img
                            --}}
                            <i class="fa" style="width: 150px; margin-left: -30px"><img
                                    src="/images/cat_bowl_1.png"
                                    width="100px"></i>
                            <div align="center" class="stats" style="padding-bottom: 10px;min-height: 250px">
                                <div class="grow groww">
                                    <p>Box name</p>
                                </div>

                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Unique ID:</td>
                                            <td>111</td>
                                        </tr>
                                        <tr>
                                            <td>Box name:</td>
                                            <td>Ellie's box</td>
                                        </tr>
                                        <tr>
                                            <td>Food type:</td>
                                            <td>Food name from db</td>
                                        </tr>
                                        <tr>
                                            <td>Current food amount:</td>
                                            <td>500 gr</td>
                                        </tr>
                                        <tr>
                                            <td>Opens by:</td>
                                            {{--can be 1 or more--}}
                                            <td>Ellie</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row" style="float: right;">
                                        <ul class="nav nav-pills">
                                            {{--Edit will take to catPage--}}
                                            <li class="menu-list"><a href="/editBoxPage"><i class="lnr lnr-pencil editValues" onclick=""></i></a></li>
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
                                    src="/images/cat_bowl_many.png"
                                    width="100px"></i>
                            <div align="center" class="stats" style="padding-bottom: 10px; min-height: 250px">
                                <div class="grow grow1 groww">
                                    <p>Box name</p>
                                </div>
                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Unique ID:</td>
                                            <td>111</td>
                                        </tr>
                                        <tr>
                                            <td>Box name:</td>
                                            <td>Ellie's box</td>
                                        </tr>
                                        <tr>
                                            <td>Food type:</td>
                                            <td>Food name from db</td>
                                        </tr>
                                        <tr>
                                            <td>Current food amount:</td>
                                            <td>500 gr</td>
                                        </tr>
                                        <tr>
                                            <td>Opens by:</td>
                                            {{--can be 1 or more--}}
                                            <td>Elf, Ellie, Laline</td>
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
                            <div align="center" class="stats" style="padding-bottom: 10px; min-height: 250px">
                                <div class="grow grow3 groww">
                                    <p>Box name</p>
                                </div>
                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Unique ID:</td>
                                            <td>111</td>
                                        </tr>
                                        <tr>
                                            <td>Box name:</td>
                                            <td>Ellie's box</td>
                                        </tr>
                                        <tr>
                                            <td>Food type:</td>
                                            <td>Food name from db</td>
                                        </tr>
                                        <tr>
                                            <td>Current food amount:</td>
                                            <td>500 gr</td>
                                        </tr>
                                        <tr>
                                            <td>Opens by:</td>
                                            {{--can be 1 or more--}}
                                            <td>Elf</td>
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
        </div>
    </div>

@endsection