<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEmployee extends Model
{
    /** @use HasFactory<\Database\Factories\NewEmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email'
    ];
}
