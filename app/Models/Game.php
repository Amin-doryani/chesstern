<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $nullable = [
        'pgn',
        'res',
        
    ];



    public function Tournament(){
        return $this ->belongsTo(Tournament::class);
    }
    public function Player1(){
        return $this ->belongsTo(Player::class,'idp1');
    }
    public function Player2(){
        return $this ->belongsTo(Player::class,'idp2');
    }
}
