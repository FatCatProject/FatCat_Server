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
                @php ($index = 0)
                    @for($row=0;$row<$numberOfRows;$row++)
                <div class="row">
                    @for(;$index<sizeof($foodbox_data);$index++)
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
                                    <p>{!! $foodbox_data[$index]['foodbox_name']!!}</p>
                                </div>

                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Unique ID:</td>
                                            <td>{!! $foodbox_data[$index]['foodbox_id']!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Box name:</td>
                                            <td>{!! $foodbox_data[$index]['foodbox_name']!!}</td>                                        </tr>
                                        <tr>
                                            <td>Food type:</td>
                                            <td>{!! $foodbox_data[$index]['food_name']!!}</td>                                        </tr>
                                        <tr>
                                            <td>Current food amount:</td>
                                            <td>{!! $foodbox_data[$index]['current_weight']!!}</td>                                        </tr>
                                        </tr>
                                        <tr>
                                            <td>Opens by:</td>
                                            {{--can be 1 or more--}}
                                            <td>{!! $foodbox_data[$index]['cat_name']!!}</td>                                        </tr>
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
                    @endfor
                    @endfor

                </div>
            </div>
        </div>
    </div>

@endsection