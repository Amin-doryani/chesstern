<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $nullable = [
        'image',
       
    ];
    public function Utilisateur(){
        return $this ->belongsTo(Utilisateur::class);
    }
    public function Tournament(){
        return $this ->belongsTo(Tournament::class);
    }
}
