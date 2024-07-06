<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    protected $nullable = [
        'image',
        
        
    ];
    public function Utilisateur(){
        return $this ->belongsTo(Utilisateur::class);
    }
    public function Players(){
        return $this ->hasMany(Player::class,'idter', 'id');
    }
}
