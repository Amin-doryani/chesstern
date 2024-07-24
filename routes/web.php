<?php

use Illuminate\Support\Facades\Route;

use App\http\Controllers\UtilisateurController;
use App\http\Controllers\TournamentController;
use App\http\Controllers\PlayerController;
use App\http\Controllers\GameController;

use App\http\Controllers\RequsetController;




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
Route::get('players/{idter}',[PlayerController::class,'showplayers'])->name('playersintourna')->middleware('auth');


Route::resource('requests', RequsetController::class);
Route::get('requests/addtoplayers/{id}/{idter}',[RequsetController::class,'addtotour'])->name('addplayerfromreq')->middleware('auth');


// Route::get('/rounds', function(){
//     return view('utili.tourn.rounds.rounds');
// })->middleware('auth');


Route::get('/rounds/{id}',[TournamentController::class, 'getrounds'])->middleware('auth')->name('roundsid');
Route::get('/startnewround/{idter}',[TournamentController::class, 'startround'])->middleware('auth')->name('newround');
Route::get('/getmaxpo/{idter}',[TournamentController::class, 'getmaxpo']);
Route::get('/array',[TournamentController::class, 'arrays']);


Route::get('/start/{id}',[TournamentController::class, 'starttour'])->middleware('auth');



Route::get('/setgameres',function(){
    return view("utili.tourn.rounds.gameres");
});
Route::get('/setgameres/{id}/{idter}',[GameController::class,'edit'])->middleware("auth")->name('setgameres');
Route::post('/update-gameres/{id}',[GameController::class,'update'])->name('updategameres')->middleware('auth');
Route::get('/tiebreack/{idter}',[GameController::class,'tiebreack'])->name('tiebreack')->middleware('auth');
Route::post("/getgames/idter/value",[GameController::class,'getround'])->name("getroundgames");
Route::get("/public",[TournamentController::class,'allpublictourn'])->name('allpublictourn');