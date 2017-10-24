<form method="POST" action="/foodboxes">
    {!! csrf_field() !!}

    Email:
    <input type="text" name="user_email">
    <br>
    Food id:
    <input type="text" name="food_id">
    <br>
    Foodbox id:
    <input type="text" name="foodbox_id">
    <br>
    Foodbox name:
    <input type="text" name="foodbox_name">

    <br><input type="submit" value="submit">

</form>