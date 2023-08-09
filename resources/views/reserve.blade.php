<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>{{$car->name}}</h1>
    <form method="POST" action="{{ route('car.reserve.store') }}">
    @csrf <!-- Add CSRF token -->

    <label for="client_name">Name:</label>
    <input type="text" name="client_name" id="client_name">

    <label for="cne">CNE:</label>
    <input type="text" name="cne" id="cne">

    <label for="phone_number">Phone number:</label>
    <input type="text" name="phone_number" id="phone_number">

    <label for="car_type">Car Type:</label>
    <input type="text" name="car_type" id="car_type">

    <label for="car_module">Car Module:</label>
    <input type="text" name="car_module" id="car_module">

    <label for="e_date">E_date:</label>
    <input type="date" name="e_date" id="e_date">

    <label for="s_date">S_date:</label>
    <input type="date" name="s_date" id="s_date">

    <input type="hidden" name="car_id" value="{{$car->id}}">

    <input type="submit" value="Submit">
</form>

</body>
</html>
