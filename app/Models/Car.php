<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use CrudTrait;
    protected $fillable = [
        'name',
        'image',
        'price',
        'quantite'
    ];

    
    use HasFactory;
}
