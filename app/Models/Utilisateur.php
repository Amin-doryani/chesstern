<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;
    
    public function Tournament(){
        return $this ->hasMany(Tournament::class);
    }
    public function Player(){
        return $this ->hasMany(Player::class);
    }
    
}
