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

    public function delete($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect('/adminpage')->with('success', 'Car deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'quantite' => 'required|integer',
            'price' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10000', // Validate image upload
        ]);

        if ($request->hasFile('image')) {
            // Upload and store the new image
            $imagePath = $request->file('image')->store('car_images', 'public');

            // Delete the old image
            $car = Car::find($id);
            $oldImagePath = $car->image;
            unlink(storage_path('app/public/' . $oldImagePath));

            // Update the data in the database
            $car->image = $imagePath;
            $car->save();
        }
        // Retrieve the validated input data...
        $car = Car::find($id);
        $car->name = $validatedData['name'];
        $car->quantite = $validatedData['quantite'];
        $car->price = $validatedData['price'];
        $car->save();

        return redirect('/adminpage')->with('success', 'Car updated successfully!');
    }

    public function update_quantity($id)
{
    $car = Car::find($id);
    $car->quantite = $car->quantite - 1;
    $car->save();
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
