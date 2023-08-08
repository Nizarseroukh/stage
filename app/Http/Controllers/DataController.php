<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car; // Import the Car model

class DataController extends Controller
{
    public function getData()
    {
        $cars = Car::all();

        return view('cars', ['cars' => $cars]);
    }

    public function getadmin()
    {
        $cars = Car::all();

        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', // Validate image upload
            'quantite' => 'required|integer',
            'price' => 'required|integer',
        ]);

        // Upload and store the image
        $imagePath = $request->file('image')->store('car_images', 'public');

        // Insert the data into the database
        $car = new Car();
        $car->name = $validatedData['name'];
        $car->image = $imagePath;
        $car->quantite = $validatedData['quantite'];
        $car->price = $validatedData['price'];
        $car->save();

        return redirect('/adminpage')->with('success', 'Car added successfully!');
    }

    public function reserve($id)
    {
        // Retrieve the specific car based on the provided ID
        $car = Car::find($id);

        if (!$car) {
            abort(404); // Car not found
        }

        // Pass the car data to a view
        return view('reserve', ['car' => $car]);

    }
}
