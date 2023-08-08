<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'client_name',
        'cne',
        'phone_number',
        'car_type',
        'car_module',
        'e_date',
        's_date',
    ];
}
