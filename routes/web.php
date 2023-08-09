<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Models\Car;
use App\Models\Reservation;
use App\Http\Controllers\ResController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $cars = Car::all();
    return view('welcome',['cars' => $cars]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/service', function(){
    return view('service');
});

Route::get('/vehicule', function(){
    $cars = Car::all();
    return view('vehicule',['cars' => $cars]);
});

Route::get('/contact', function(){
    return view('contact');
});

Route::post('/carupdate/{id}', [DataController::class, 'update'])->name('car.update');
Route::post('/carquantite/{id}', [DataController::class, 'updatequantite'])->name('car.updatequantite');
Route::delete('/cardelete/{id}', [DataController::class, 'delete'])->name('car.delete');

Route::post('/markdone/{id}', [ResController::class, 'markedone'])->name('car.markedone');



Route::get('/reserve/{id}', [DataController::class, 'reserve'])->name('car.reserve');

Route::post('/reserving', [ResController::class, 'store'])->name('car.reserve.store');


Route::post('/cars', [DataController::class, 'store']);
Route::get('/adminpage', function(){
    $cars = Car::all();
    $res = Reservation::all();
    return view('admin',['cars' => $cars,'res' => $res]);
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
