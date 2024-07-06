<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requset extends Model
{
    use HasFactory;
    protected $nullable = [
        'image',
        'date',
       
    ];
}
