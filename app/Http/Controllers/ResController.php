<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservation; // Don't forget to import the Reservation model

class ResController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required', // Changed from 'client name'
            'cne' => 'required',
            'phone_number' => 'required', // Changed from 'phone number'
            'car_type' => 'required',
            'car_module' => 'required',
            'e_date' => 'required',
            's_date' => 'required',
        ]);

        $reservation = new Reservation();
        $reservation->client_name = $validatedData['client_name'];
        $reservation->cne = $validatedData['cne'];
        $reservation->phone_number = $validatedData['phone_number'];
        $reservation->car_type = $validatedData['car_type'];
        $reservation->car_module = $validatedData['car_module'];
        $reservation->e_date = $validatedData['e_date'];
        $reservation->s_date = $validatedData['s_date'];
        
        // Additional fields and logic can be added here
        
        $reservation->save();

        return redirect('/')->with('success', 'Reservation added successfully!');
    }
}
