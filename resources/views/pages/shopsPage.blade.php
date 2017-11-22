@extends('layouts.master')
@section('content')
    @include('layouts.datePicker')
    <div id="page-wrapper">
        <div id="Edit" class="graphs">
            <h3 class="blank1">Favorite shops & products:</h3>
            {{--add shop--}}
            <div class="row">
                {{--addShopBlock--}}
                <div id="addShopBlock" class="col-sm-6">
                    <h4 class="blank1">Add shop:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addShop" id="addShop">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Shop name: <span style="color: red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="shop_name" class="form-control1" id="shopName"
                                               placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Url:</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="url" class="form-control1" id="shopUrl" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-9"><textarea name="address" id="shopAddress"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 50px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Opening hours:</label>
                                    <div class="col-sm-9"><textarea name="hours" id="shopHours"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 50px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Phone number:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control1" id="shopTel"
                                               pattern="[0-9]+((?:[0-9]+-)*)[0-9]+" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-2">
                                            <button type="submit" class="btn-success btn" form="addShop">Add</button>
                                            <button type="reset" class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                {{--editShopBlock--}}
                <div hidden id="editShopBlock" class="col-sm-6">
                    <h4 class="blank1">Edit shop:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" action="addShop" id="addShop">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <input type="hidden" name="to_shopID" id="to_shopID" value="">
                                    <label for="focusedinput" class="col-sm-3 control-label">Shop name: <span style="color: red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="to_crr_shop_name" type="text" name="shop_name" class="form-control1" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Url:</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="url" class="form-control1" id="to_crr_url" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-9"><textarea name="address" id="to_crr_address"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 50px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-3 control-label">Opening hours:</label>
                                    <div class="col-sm-9"><textarea name="hours" id="to_crr_open_hours"
                                                                    cols="50"
                                                                    rows="10" class="form-control1"
                                                                    style="min-height: 50px"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Phone number:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control1" id="to_crr_number"
                                               pattern="[0-9]+((?:[0-9]+-)*)[0-9]+" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-2">
                                            <button id="updateBtnShop" type="submit" class="btn-success btn" form="">Update</button>
                                            <button id="cancelBtnShop" type="reset" class="btn-inverse btn">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                {{--addProductBlock--}}
                <div id="addProductBlock" class="col-sm-6">
                    <div id="errors_div_add" class="form-group">
                        <ul id="errors_ul_add" style="color: red;"></ul>
                    </div>
                    <h4 class="blank1">Add product:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="addProduct" id="addProduct">
                                {!! csrf_field() !!}
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Name: <span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="product_name" class="form-control1" id="itemName"
                                               placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Weight: <span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" name="weight" id="itemWeight"
                                               step="any" min="0"
                                               placeholder="Enter weight in Kg" required>
                                    </div>
                                    <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                                        <p class="help-block">Kg</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Price: <span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" name="price" id="itemPrice"
                                               step="any" min="0"
                                               placeholder="" required>
                                    </div>
                                    <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                                        <p class="help-block">USD</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="checkbox" class="col-sm-3 control-label">Food product?</label>
                                    <div class="col-sm-8">
                                        <div class="checkbox-inline"><label><input type="checkbox"
                                                                                   name="is_food">Yes</label></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profilePicture" class="col-sm-3 control-label">Picture:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="picture" id="picture_input_add" class="filestyle"
                                               data-buttonBefore="true" style="margin-top: 6px">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button id="submit_button_add" type="submit" class="btn-success btn" form="addProduct">Add</button>
                                            <button id="product_reset_button" type="reset" class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{--editProductBlock--}}
                <div hidden id="editProductBlock" class="col-sm-6">
                    <div id="errors_div_edit" class="form-group">
                        <ul id="errors_ul_edit" style="color: red;"></ul>
                    </div>
                    <h4 class="blank1">Edit product:</h4>
                    <div class="tab-content" style="padding:0px">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="addProduct" id="addProduct">
                                {!! csrf_field() !!}
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                                <div class="form-group">
                                    <input type="hidden" name="to_productID" id="to_productID" value="">
                                    <label for="focusedinput" class="col-sm-3 control-label">Name: <span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="product_name" class="form-control1" id="to_crr_name"
                                               placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Weight: <span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" name="weight" id="to_crr_weight"
                                               step="any" min="0"
                                               placeholder="Enter weight in Kg" required>
                                    </div>
                                    <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                                        <p class="help-block">Kg</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-3 control-label">Price: <span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" name="price" id="to_crr_price"
                                               step="any" min="0"
                                               placeholder="" required>
                                    </div>
                                    <div class="col-sm-1" style="padding: 0px; margin: 20px 0 0 -10px">
                                        <p class="help-block">USD</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="checkbox" class="col-sm-3 control-label">Food product?</label>
                                    <div class="col-sm-8">
                                        <div class="checkbox-inline"><label><input type="checkbox"
                                                                                   name="is_food"
                                                                            id="isFoodCheckBox"
                                                                            >Yes</label></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profilePicture" class="col-sm-3 control-label">Picture:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="picture" id="picture_input_edit" class="filestyle"
                                               data-buttonBefore="true" style="margin-top: 6px">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button id="updateBtnProduct" type="submit" class="btn-success btn" form="">Update</button>
                                            <button id="cancelBtnProduct" type="reset" class="btn-inverse btn">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
<script>

    $("#picture_input_add").bind("change", function(event){
        console.log("--- picture_input_add change ---");
        if(this.files[0].length < 1){
            $("#errors_ul_add").children("#file_size_error_li_add").remove();
            $("#errors_ul_add").children("#file_extension_error_li_add").remove();
            if(! $("#errors_ul_add").is(":parent")){
                $("#submit_button_add").removeClass("disabled");
            }
            return;
        }
        var file_size_bytes = this.files[0].size;
        var file_extension = (this.files[0].name.toLowerCase().split("."))[this.files[0].name.split(".").length - 1];
        var allowed_file_extensions = ["gif", "jpeg", "jpg", "png"];
        console.log("file_size_bytes: " +  file_size_bytes + " - file_extension: " + JSON.stringify(file_extension));

        if(file_size_bytes > 10485760){
            $("#submit_button_add").addClass("disabled");
            $("#errors_ul_add").children("#file_size_error_li_add").remove();
            $("#errors_ul_add").append(
                $("<li></li>").attr("id", "file_size_error_li_add").text("File size too large - max 10MB.")
            );
        }else{
            $("#errors_ul_add").children("#file_size_error_li_add").remove();
        }
        if($.inArray(file_extension, allowed_file_extensions) == -1){
            $("#submit_button_add").addClass("disabled");
            $("#errors_ul_add").children("#file_extension_error_li_add").remove();
            $("#errors_ul_add").append(
                $("<li></li>").attr("id", "file_extension_error_li_add").text(
                    "File extension not allowed. - Allowed extensions: " + JSON.stringify(allowed_file_extensions)
                )
            );
        }else{
            $("#errors_ul_add").children("#file_extension_error_li_add").remove();
        }
        if(! $("#errors_ul_add").is(":parent")){
            $("#submit_button_add").removeClass("disabled");
        }
    });

    $("#picture_input_edit").bind("change", function(event){
        console.log("--- picture_input_edit change ---");
        if(this.files[0].length < 1){
            $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
            $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
            if(! $("#errors_ul_edit").is(":parent")){
                $("#updateBtnProduct").removeClass("disabled");
            }
            return;
        }
        var file_size_bytes = this.files[0].size;
        var file_extension = (this.files[0].name.toLowerCase().split("."))[this.files[0].name.split(".").length - 1];
        var allowed_file_extensions = ["gif", "jpeg", "jpg", "png"];
        console.log("file_size_bytes: " +  file_size_bytes + " - file_extension: " + JSON.stringify(file_extension));

        if(file_size_bytes > 10485760){
            $("#updateBtnProduct").addClass("disabled");
            $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
            $("#errors_ul_edit").append(
                $("<li></li>").attr("id", "file_size_error_li_edit").text("File size too large - max 10MB.")
            );
        }else{
            $("#errors_ul_edit").children("#file_size_error_li_edit").remove();
        }
        if($.inArray(file_extension, allowed_file_extensions) == -1){
            $("#updateBtnProduct").addClass("disabled");
            $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
            $("#errors_ul_edit").append(
                $("<li></li>").attr("id", "file_extension_error_li_edit").text(
                    "File extension not allowed. - Allowed extensions: " + JSON.stringify(allowed_file_extensions)
                )
            );
        }else{
            $("#errors_ul_edit").children("#file_extension_error_li_edit").remove();
        }
        if(! $("#errors_ul_edit").is(":parent")){
            $("#updateBtnProduct").removeClass("disabled");
        }
    });
$("#product_reset_button").on("click", function(){
    $("#errors_ul_add").empty();
    $("#submit_button_add").removeClass("disabled");
});
</script>
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
                        @for($index=0;$index<count($shops);$index++)
                            @if(empty($shops[$index]))
                            @else
                                <tr id="shop_row_{!! $shops[$index]->id !!}">
                                    {{--the url has to be a cklicable LINK, put the same value in HREF as the address itself--}}
                                    <input id="shopID" type="hidden" value="{!! $shops[$index]->id !!}">
                                    <td id="crr_shop_name" class="">{!! $shops[$index]->shop_name ?? ""!!}</td>
                                    <td id="crr_url" class="" style=""><a href="{!! $shops[$index]->url !!}"
                                                                   target="_blank">{!! $shops[$index]->url ?? ""!!}</a>
                                    </td>
                                    <td id="crr_address" class="">{!! $shops[$index]->address ?? "" !!}</td>
                                    <td id="crr_open_hours" class="">{!! $shops[$index]->hours ?? "" !!}</td>
                                    <td id="crr_number" class="">{!! $shops[$index]->phone ?? ""!!}</td>
                                    <td>
                                        <ul id="btnsShop" class="nav nav-pills">
                                            <li class="editBtnShop"><a href="#Edit"><i class="lnr lnr-pencil"
                                                                                   onclick=""></i></a></li>
                                            <li class="deleteBtnShop" id="shop_del_id_{!! $shops[$index]->id !!}"
                                                value="{!! $shops[$index]->id !!}">
                                                <a><i class="lnr lnr-trash"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @endfor
                        </tbody>
                    </table>

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
                        @for($i=0;$i<count($products);$i++)
                            @if(empty($products[$i]))
                            @else
                                <tr id="product_row_{!! $products[$i]->id !!}">
                                    <input id="productID" type="hidden" value="{!! $products[$i]->id !!}">
                                    <td id="crr_name" class="">{!! $products[$i]->product_name !!}</td>
                                    <td id="crr_weight" class="">{!! $products[$i]->weight !!} Kg</td>
                                    @if($products[$i]->is_food == 1)
                                        <td id="crr_is_food" class="" value="1">Food</td>
                                    @else
                                        <td id="crr_is_food"  class="" value="0">Not Food</td>
                                    @endif
                                    @if($pictures[$products[$i]->id] == "No picture")
                                        <td class="">No image</td>
                                    @else
                                        <td class=""><img
                                                    class="myImg"
                                                    src="{!! $pictures[$products[$i]->id] !!}"
                                                    align="center"
                                            ></td>
                                    @endif
                                    <td id="crr_price" class="">{!! $products[$i]->price !!} USD</td>
                                    <td>
                                        <ul id="btns" class="nav nav-pills">
                                            <li class="editBtnProduct"><a href="#Edit"><i class="lnr lnr-pencil editValues"
                                                                                   onclick=""></i></a></li>
                                            <li class="deleteBtnProduct" id="product_del_id_{!! $products[$i]->id !!}"
                                                value="{!! $products[$i]->id !!}">
                                                <a><i class="lnr lnr-trash"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <!--END Table -->
        </div>
        <br><br><br>
    </div>


    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- The Close Button -->
        <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
    <!-- The Modal -->


    <script>
        //Delete SHOP table row
        $('.deleteBtnShop').on("click", shop_delete_table_row_func);

        function shop_delete_table_row_func() {
            var id = $(this).parent().parent().parent().find('#shopID').val();
            console.log("shopID id is" + id);
            $.ajax({
                type: "GET",
                url: '/deleteShop',
                caller: id,
                data: {
                    id: id,
                },
                success: function (data, status, jqXHR) {
                    console.log("llll:" + data.id);
                    $("#shop_row_" + this.caller).remove();
                },
                fail: function (jqXHR, status, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + status);
                }
            })
        }

        //Delete Product table row
        $('.deleteBtnProduct').on("click", product_delete_table_row_func);

        function product_delete_table_row_func() {
            var id = $(this).parent().parent().parent().find('#productID').val();
            console.log("shopID id is" + id);
            $.ajax({
                type: "GET",
                url: '/deleteProduct',
                caller: id,
                data: {
                    id: id,
                },
                success: function (data, status, jqXHR) {
                    console.log("llll:" + data.id);
                    $("#product_row_" + this.caller).remove();
                },
                fail: function (jqXHR, status, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + status);
                }
            })
        }

        //Edit SHOP btn - opens hiden div and populates it
        $(".editBtnShop").click(function () {
            $("#addShopBlock").hide();
            $("#editShopBlock").show();

            var id = $(this).parent().parent().parent().find('#shopID').val();
            console.log("id:" + id);
            var crr_shop_name = $(this).parent().parent().parent().find('#crr_shop_name').text();
            console.log("crr_shop_name:" + crr_shop_name);
            var crr_url = $(this).parent().parent().parent().find('#crr_url').text();
            console.log("crr_url:" + crr_url);
            var crr_address = $(this).parent().parent().parent().find('#crr_address').text();
            console.log("crr_address:" + crr_address);
            var crr_open_hours = $(this).parent().parent().parent().find('#crr_open_hours').text();
            console.log("crr_open_hours:" + crr_open_hours);
            var crr_number = $(this).parent().parent().parent().find('#crr_number').text();
            console.log("crr_number:" + crr_number);

            $("#to_shopID").val(id);
            $("#to_crr_shop_name").val(crr_shop_name);
            $("#to_crr_url").val(crr_url);
            $("#to_crr_address").val(crr_address);
            $("#to_crr_open_hours").val(crr_open_hours);
            $("#to_crr_number").val(crr_number);

        });

        //Cancel SHOP Edit btn
        $("#cancelBtnShop").click(function () {
            $("#editShopBlock").hide();
            $("#addShopBlock").show();
        });

        //Edit Product btn - opens hiden div and populates it
        $(".editBtnProduct").click(function () {
            console.log("HERE")

            $("#errors_ul_edit").empty();
            $("#updateBtnProduct").removeClass("disabled");
            $("#addProductBlock").hide();
            $("#editProductBlock").show();

            var id = $(this).parent().parent().parent().find('#productID').val();
            console.log("id:" + id);
            var crr_name = $(this).parent().parent().parent().find('#crr_name').text();
            console.log("crr_name:" + crr_name);
            var crr_weight = $(this).parent().parent().parent().find('#crr_weight').text().split(" ")[0];
            console.log("crr_weight:" + crr_weight);
            var crr_price = $(this).parent().parent().parent().find('#crr_price').text().split(" ")[0];
            console.log("crr_price:" + crr_price);
            var crr_is_food = $(this).parent().parent().parent().find('#crr_is_food').text();
            console.log("crr_is_food:" + crr_is_food);

            $("#to_productID").val(id);
            $("#to_crr_name").val(crr_name);
            $("#to_crr_weight").val(crr_weight);
            $("#to_crr_price").val(crr_price);
            if(crr_is_food == "Food"){
                $("#isFoodCheckBox").attr("checked", "");
            }else{
                $("#isFoodCheckBox").removeAttr("checked");
            }



        });

        //Cancel PRODUCT Edit btn
        $("#cancelBtnProduct").click(function () {
            $("#editProductBlock").hide();
            $("#addProductBlock").show();
        });

        //Update SHOP btn
        $('#updateBtnShop').on("click", function () {
            var id = $("#to_shopID").val();
            var to_crr_shop_name = $("#to_crr_shop_name").val();
            var to_crr_url = $("#to_crr_url").val();
            var to_crr_address = $("#to_crr_address").val();
            var to_crr_open_hours = $("#to_crr_open_hours").val();
            var to_crr_number = $("#to_crr_number").val();

            console.log("this is the shop_id in ajax:" + id);
            console.log("to_crr_shop_name:" + to_crr_shop_name);
            console.log("to_crr_url:" + to_crr_url);
            console.log("to_crr_address:" + to_crr_address);
            console.log("to_crr_open_hours:" + to_crr_open_hours);
            console.log("to_crr_number:" + to_crr_number);

            $.ajax({
                type: "GET",
                url: '/updateShop',
                caller: id,
                data: {
                    id: id,
                    to_crr_shop_name: to_crr_shop_name,
                    to_crr_url: to_crr_url,
                    to_crr_address: to_crr_address,
                    to_crr_open_hours: to_crr_open_hours,
                    to_crr_number: to_crr_number
                },
                success: function (data, textStatus, jqXHR) {
                    console.log("back newName " + data.newName);
                    console.log("back newUrl " + data.newUrl);
                    console.log("back newAddress " + data.newAddress);
                    console.log("back newHours " + data.newHours);
                    console.log("back newPhone " + data.newPhone);

                    console.log("got back forID" + this.caller);
                    console.log(  $('#shop_row_' + this.caller));
                    $('#shop_row_' + this.caller).find('#crr_shop_name').text(data.newName || "");
                    $('#shop_row_' + this.caller).find('#crr_url').html('<a href='+(data.newUrl || "")+' target="_blank">'+(data.newUrl || "")+'<a/>');
                    $('#shop_row_' + this.caller).find('#crr_address').text(data.newAddress || "");
                    $('#shop_row_' + this.caller).find('#crr_open_hours').text(data.newHours || "");
                    $('#shop_row_' + this.caller).find('#crr_number').text(data.newPhone || "");
                    scrollToAnchor('shop_row_' + this.caller);

                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + textStatus);
                }
            })
            $("#editShopBlock").hide();
            $("#addShopBlock").show();
        });



        //Update PRODUCT btn
        $('#updateBtnProduct').on("click", function () {
            var id = $("#to_productID").val();
            var to_crr_name = $("#to_crr_name").val();
            var to_crr_weight = $("#to_crr_weight").val();
            var to_crr_price = $("#to_crr_price").val();
            var isFood = 0;
            if ($("#isFoodCheckBox").prop('checked')){
                isFood = 1;
            }

//            var myFile = $("#picture_input_edit").prop("files")[0];
//            fr = new FileReader();
//            fr.readAsDataURL(myFile);
//            console.log("myFile" + JSON.stringify(myFile));
//            var pic = btoa($("#picture_input_edit").prop("files")[0]); //sends a name of the pic and not the pic itself!

   
            console.log("this is the shop_id in ajax: " + id);
            console.log("to_crr_name: " + to_crr_name);
            console.log("to_crr_weight: " + to_crr_weight);
            console.log("to_crr_price: " + to_crr_price);
            console.log("isFood: " + isFood);

            $.ajax({
                type: "GET",
                url: '/updateProduct',
                caller: id,
                data: {
                    id: id,
                    to_crr_name: to_crr_name,
                    to_crr_weight: to_crr_weight,
                    to_crr_price: to_crr_price,
                    isFood: isFood
//                    pic: pic
                },
                success: function (data, textStatus, jqXHR) {
                    console.log("back newName " + data.newName);
                    console.log("back newWeight " + data.newWeight);
                    console.log("back newPrice " + data.newPrice);
                    console.log("back newIsFood " + data.newIsFood);


                    console.log("got back forID" + this.caller);
                    console.log(  $('#product_row_' + this.caller));
                    $('#product_row_' + this.caller).find('#crr_name').text(data.newName);
                    $('#product_row_' + this.caller).find('#crr_weight').text(data.newWeight).append(" Kg");
                    $('#product_row_' + this.caller).find('#crr_price').text(data.newPrice).append(" USD");
                    if(data.newIsFood == true){
                        $('#product_row_' + this.caller).find('#crr_is_food').text("Food");
                    }else{
                        $('#product_row_' + this.caller).find('#crr_is_food').text("");
                    }

//                    $('#shop_row_' + this.caller).find('#crr_number').text(data.newPhone);
                    scrollToAnchor('product_row_' + this.caller);

                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + textStatus);
                }
            })
            $("#editProductBlock").hide();
            $("#addProductBlock").show();
        });





        //Anchor
        function scrollToAnchor(aid){
            var aTag = $('#'+ aid);
            $('html,body').animate({scrollTop: aTag.offset().top -60},'slow');
        }


        $(document).ready(function () {
            image_popout();
        })

        function image_popout() {
// Get the modal
            var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = $('.myImg');
            var modalImg = $("#img01");
            var captionText = document.getElementById("caption");
            $('.myImg').click(function () {
                modal.style.display = "block";
                var newSrc = this.src;
                modalImg.attr('src', newSrc);
                captionText.innerHTML = this.alt;
            });

// Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
