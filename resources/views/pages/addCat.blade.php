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
                @php ($index = 0)
                @for($row=0;$row<$numberOfRows;$row++)
                <div class="row">
                    @for(;$index<count($allMyCats);$index++)
                    <div id="catInfo_{!! $allMyCats[$index]['id']!!}" class="col-md-4"  style="padding-bottom: 25px;">

                        <div class="r3_counter_box">
                            <i class="fa" style="width: 150px; margin-left: -30px">
                                <img
                                    src="{!! $cat_profile_pictures[$allMyCats[$index]['cat_name']] !!}"
                                    width="100px"
                                >
                            </i>
                            <div  align="center" class="stats" style="padding-bottom: 10px">
                                <div class="grow groww">
                                    <p>{!! $allMyCats[$index]['cat_name']!!}</p>
                                </div>

                                <form class="form-horizontal">
                                    <table class="catCardTable">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{!! $allMyCats[$index]['cat_name']!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Breed:</td>
                                            <td>{!! @str_replace('_', ' ', str_replace('_cat', '', $allMyCats[$index]['cat_breed'])) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Wiki page:</td>
                                            <td><a style="color: #337ab7" href="{!! $allMyCats[$index]->catBreed->link !!}" target="_blank">Learn more about your cat</a></td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td>{!! $allMyCats[$index]['gender'] !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Birthday:</td>
                                            <td>{!! $allMyCats[$index]['dob'] !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Current weight:</td>
                                            <td>{!! $allMyCats[$index]['current_weight'] !!} Kg</td>
                                        </tr>
                                        <tr>
                                            <td>Target weight:</td>
                                            <td>{!! $allMyCats[$index]['target_weight'] !!} Kg</td>
                                        </tr>
                                        <tr>
                                            <td>Daily calories:</td>
                                            <td>{!! $allMyCats[$index]['food_allowance'] !!}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="catID" value="{!! $allMyCats[$index]['id']!!}">
                                        <div class="row" style="float: right;">
                                                <ul class="nav nav-pills">
                                                    <li id="editBtn" class="pencil editBtn" name="editBtn">
                                                        <a href="/catPage/{!! $allMyCats[$index]['id']!!}">
                                                            <i class="lnr lnr-pencil editValues" onclick=""></i>
                                                        </a>
                                                    </li>
                                                    <li id="{!! $allMyCats[$index]['id']!!}" class="deleteCatBtn"><a><i class="lnr lnr-trash"></i></a></li>
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
            <div id="EditCat" class="row" style="margin: 25px">
                {{--spacing div please don't remove //Natalie--}}
            </div>
            <hr>
            <div id=""></div>
            @include("layouts.catFields")

            <div class="row" style="margin: 25px">
                {{--spacing div please don't remove //Natalie--}}
            </div>

        </div>
    </div>
    <script>

        //Delete Cat
        $('.deleteCatBtn').on("click", delete_cat_func);

        function delete_cat_func() {
            var id = $(this).parent().parent().parent().find('#catID').val();
            console.log("catID id is" + id);
            $.ajax({
                type: "GET",
                url: '/deleteCat',
                caller: id,
                data: {
                    id: id,
                },
                success: function (data, status, jqXHR) {
                    console.log("catIDBack: " + data);
                    $("#catInfo_" + this.caller).remove();
                },
                fail: function (jqXHR, status, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + status);
                }
            })
        }






        $(document).ready(function () {
            if( window.location.toString().includes("cat_id=")){
                $('#title').html('Edit Information:');
                setTimeout(function() {
                    scrollToAnchor('EditCat');
                }, 500);
            }


        });

        //Anchor
        function scrollToAnchor(aid){
            var aTag = $('#'+ aid);
            $('html,body').animate({scrollTop: aTag.offset().top -60},'slow');
        }

    </script>
@endsection
