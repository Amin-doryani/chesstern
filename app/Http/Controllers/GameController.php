<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$idter)
    {
        $thegame = Game::with(['Player1', 'Player2'])
        ->where('id', $id)
        ->where('idter', $idter)
        ->first();
        $theter = Tournament::find($idter);
        $idu = auth::id();
        if ($theter->idUtili == $idu) {
            if ($thegame == null) {
                return redirect()->back();
            }else{
            return view("utili.tourn.rounds.gameres",['game'=>$thegame]);
    
        }
        }else{
            return redirect()->back();
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pgn'=>'nullable|string',
            'select'=>'required',
        ]);
        
        


        // we got the game 
        $thegame= Game::findOrFail($id);


        //if it's a draw
        if ($request->input('select') ==0) {
            
            //if there is no res before
            if ($thegame->res === null ){
                $thegame->res = $request->input('select');
                //if the pgn is not null
                if ($request->input('pgn') != null) {
                            $thegame->pgn = $request->input('pgn');
                }
                $thegame->save();
                $theplayer1 = Player::FindOrFail($thegame->idp1);
                $theplayer2 = Player::FindOrFail($thegame->idp2);
                $theplayer1->numgames+=1;
                $theplayer1->sumelo  += $theplayer2->elo;
                $theplayer1->save();
                $theplayer1 = Player::FindOrFail($thegame->idp1);
                $theplayer2 = Player::FindOrFail($thegame->idp2);
                $theperfo = $theplayer1->sumelo / $theplayer1->numgames;
                $theplayer1->perefo = $theperfo;
                $theplayer1->pointes +=0.5;
                $theplayer1->save();
                $theplayer2->numgames+=1;
                $theplayer2->sumelo  += $theplayer1->elo;
                $theplayer2->save();
                $theplayer1 = Player::FindOrFail($thegame->idp1);
                $theplayer2 = Player::FindOrFail($thegame->idp2);
                $theperfo2 = $theplayer2->sumelo / $theplayer2->numgames;
                $theplayer2->perefo = $theperfo2;
                $theplayer2->pointes +=0.5;
                $theplayer2->save();
                return  redirect()->route('tiebreack',$thegame->idter);
                
                

            }else{
                //if the res is not null means the user want to change the res, so we don't let hem for now
                echo "<script>alert('U can't change the values')</script>";
                return redirect()->back();
            }
        }else{
            if ($thegame->res === null ) {
                // && $thegame->res1!=0
                //if it's not a draw
             $thegame->res = $request->input('select');
                //if the pgn is not null
            if ($request->input('pgn') != null) {
                            $thegame->pgn = $request->input('pgn');
            }
            $thegame->save();
            $playerWon = Player::FindOrFail($request->input('select'));
            if ($playerWon->id == $thegame->idp1 ) {
                $playerlost = Player::FindOrFail($thegame->idp2);
            }else{
                $playerlost = Player::FindOrFail($thegame->idp1);
            }
            $playerWon->pointes+=1;
            $playerWon->numgames+=1;
            $playerWon->sumelo += $playerlost->elo + 400;
            $playerWon->save();
            $playerWon = Player::FindOrFail($request->input('select'));
            if ($playerWon->id == $thegame->idp1 ) {
                $playerlost = Player::FindOrFail($thegame->idp2);
            }else{
                $playerlost = Player::FindOrFail($thegame->idp1);
            }
            $theperfo3 = $playerWon->sumelo/$playerWon->numgames;
            $playerWon->perefo = $theperfo3;
            $playerWon->save();
            $playerlost->numgames+=1;
            $playerlost->sumelo += $playerWon->elo - 400;
            $playerlost->save();
            $playerWon = Player::FindOrFail($request->input('select'));
            if ($playerWon->id == $thegame->idp1 ) {
                $playerlost = Player::FindOrFail($thegame->idp2);
            }else{
                $playerlost = Player::FindOrFail($thegame->idp1);
            }
            $theperfo4 = $playerlost->sumelo/$playerlost->numgames;
            $playerlost->perefo = $theperfo4;

           
            $playerlost->save();
            
            return  redirect()->route('tiebreack',$thegame->idter);
            }else{
                echo "<script>alert('U can't change the values')</script>";
                return redirect()->back();
            }
            
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
    public function tiebreack($idter){
        $players = Player::where('idter',$idter)->get();
        foreach ($players as $player ) {
            $player->tiebreack=0;
           $plid = $player->id;
           $plgames = Game::where('res',$plid)->get();
           foreach ($plgames as $plgame) {
            if ($plgame->idp1 == $plid) {
                $playerlost = Player::FindOrFail($plgame->idp2);
                $player->tiebreack +=$playerlost->pointes;
                $player->save();
                
                
           }else{
            $playerlost = Player::FindOrFail($plgame->idp1);
            $player->tiebreack +=$playerlost->pointes;
            $player->save();
            
           }
        
           }
       
           
        }
        return  redirect()->route('roundsid',$idter);
    }
}
