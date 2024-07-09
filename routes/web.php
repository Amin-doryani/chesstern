<?php

use Illuminate\Support\Facades\Route;

use App\http\Controllers\UtilisateurController;
use App\http\Controllers\TournamentController;
use App\http\Controllers\PlayerController;



Route::get('/', function () {
    return view('welcome');
})->name("index");
Route::get('/dashboard', [TournamentController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('tournament', TournamentController::class);




Route::get('/signup', [UtilisateurController::class,"create"])->name("createuser");
Route::post('/storeinfos', [UtilisateurController::class,"store"])->name("storeuser");

Route::get('/login', [UtilisateurController::class,"logincreate"])->name("login");
Route::post('/checklogin', [UtilisateurController::class,"checklogin"])->name("checklogin");

Route::get('/logout', [UtilisateurController::class,"logout"])->name("logout");

Route::get('/add-Tournament',[TournamentController::class,'create'])->name('addtournament')->middleware("auth");

Route::resource('player', PlayerController::class);
Route::post('/store-player/{idter}',[PlayerController::class,'store'])->name('storePlayer')->middleware('auth');

Route::get('add-player/{id}', [PlayerController::class,'create'])->name('addplayer')->middleware('auth');
Route::get("/req", function(){
    return view('utili.tourn.requests');
});


