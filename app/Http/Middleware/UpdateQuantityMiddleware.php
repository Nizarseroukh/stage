<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Car;

class UpdateQuantityMiddleware
{
    public function handle($request, Closure $next )
    {

        $id = $request->route('carId');
        $car = Car::find($id);
        if(!$car) {
            return redirect('/')->with('error', 'Car not found!');
        }
        $car->quantite = $car->quantite - 1;
        $car->save();

        return $next($request);
    }
}

