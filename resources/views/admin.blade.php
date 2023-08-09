<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Laravel</title>

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('styling/all.css') }}">

	</head>
    <body>
        <div class="modals">
            <div class="modal_bg" id="mbg"></div>
            <div class="add_car">
                <form method="POST" action="/cars" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" placeholder="Car Name">
                    <input type="file" name="image">
                    <input type="number" name="quantite" placeholder="Quantity">
                    <input type="number" name="price" placeholder="Price">
                    <button type="submit">Add Car</button>
                </form>
            </div>

        </div>
        <div class="container">
            <div class="btns">
                <button class="btn" id="car">Cars</button>
                <button class="btn" id="res">Reservations</button>
            </div>
            <div class="tabels">
                <div class="cars">
                    <button class="btn" id="add_c">Add Car</button>
                    <table class="table">
                        <tr>
                            <th>Car ID</th>
                            <th>Car Name</th>
                            <th>Car Type</th>
                            <th>Car Price</th>
                            <th>Car Image</th>
                        </tr>
                        @foreach($cars as $car)
                        <tr>
                            <td>{{$car->id}}</td>
                            <td>{{$car->name}}</td>
                            <td>
                                <img src="{{asset('storage/' . $car->image)}}" alt="car image"
                            </td>
                            <td>{{$car->price}}</td>
                            <td>{{$car->quantite}}</td>
                            <td>
                                <form action="/cars/{{$car->id}}" method="POST" enctype="multipart/form-data">
                                    <input type="submit" value="delete">
                                </form>
                            </td>
                            <td>
                                <button class="update">Update</button>
                                <div class="car_update">
                                    <form action="/carupdate/{{$car->id}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="name" placeholder="Car Name">
                                        <input type="file" name="image">
                                        <input type="number" name="quantite" placeholder="Quantity">
                                        <input type="number" name="price" placeholder="Price">
                                        <button type="submit">Update Car</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="reserve">
                    <table class="table">
                        <tr>
                            <th>Reservation ID</th>
                            <th>Client Name</th>
                            <th>Client CNE</th>
                            <th>Client Phone Number</th>
                            <th>Car Type</th>
                            <th>Car Module</th>
                            <th>Done</th>
                            <th>End Date</th>
                            <th>Start Date</th>
                            <th>Mark as Done</th>
                        </tr>
                        @foreach($res as $re)
                        @if($re->done == 'no'){
                        <tr>
                            <td>{{$re->id}}</td>
                            <td>{{$re->client_name}}</td>
                            <td>{{$re->cne}}</td>
                            <td>{{$re->phone_number}}</td>
                            <td>{{$re->car_type}}</td>
                            <td>{{$re->car_module}}</td>
                            <td>{{$re->done}}</td>
                            <td>{{$re->e_date}}</td>
                            <td>{{$re->s_date}}</td>
                            <td>
                                <form action="/markdone/{{$re->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="submit" value="done">
                                </form>
                            </td>
                        </tr>
                        }
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>
        document.getElementById('car').addEventListener('click', function(){
            document.querySelector('.cars').style.display = 'block';
            document.querySelector('.reserve').style.display = 'none';
        });
        document.getElementById('res').addEventListener('click', function(){
            document.querySelector('.cars').style.display = 'none';
            document.querySelector('.reserve').style.display = 'block';
        });
        document.getElementById('add_c').addEventListener('click', function(){
            document.querySelector('.add_car').style.display = 'block';
            document.querySelector('.modal_bg').style.display = 'block';
        });
        document.querySelector('.update').addEventListener('click', function(){
            document.querySelector('.car_update').style.display = 'block';
            document.querySelector('.modal_bg').style.display = 'block';
        });
        document.getElementById('mbg').addEventListener('click', function(){
            document.querySelector('.add_car').style.display = 'none';
            document.querySelector('.car_update').style.display = 'none';
            document.querySelector('.modal_bg').style.display = 'none';
        });

    </script>

</html>
