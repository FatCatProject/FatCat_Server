<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link href="css/bootstrap-iso.css" rel='stylesheet' type='text/css' />
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link href="css/font-awesome.min.css" rel='stylesheet' type='text/css' />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form {
        font-family: Arial, Helvetica, sans-serif;
        color: black;
        width: 200px;
    }

    .bootstrap-iso form button, .bootstrap-iso form button:hover {
        color: white !important;
    }
</style>
<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
    <label for="focusedinput" class="col-sm-2 control-label">Birthday:</label>

        <div class="input-group" style="margin: 0px 0px 0px 15px">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text" style="width: 120px;"/>
        </div>
<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<link href="css/bootstrap-datepicker3.css" rel='stylesheet' type='text/css' />

<script>
    $(document).ready(function () {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>


