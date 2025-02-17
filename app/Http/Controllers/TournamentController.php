<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Player;
use App\Models\Round;
use App\Models\Game;
use App\Models\Bye;



use App\Models\Requset;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth::id();
        $tourn = Tournament::where('idUtili', $id)
                          ->with('players')
                          ->withCount('players')
                          ->get();
        foreach ($tourn as $item){
            $req = DB::table('requsets')
                ->where('idter', $item->id)
                ->count();
            $item->requests = $req; 
        }
        return view('dashboard',["tourn"=>$tourn]);

        

        
    }
    public function allpublictourn(){
        $tourn1 = Tournament::where('round',0)
        ->where("status",'public')
        ->with('players')
        ->withCount('players')
        ->get();
        // $tourn2 = Tournament::where('round' > 0)
        // ->where("status",'public')
        // ->get();
        return view("utili.tourn.publictourn",['tourn1'=>$tourn1]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Auth::id();
        return view('utili.tourn.addtourn',["authid"=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        $validatedData = $request->validate([
            
            'maxplayers' => 'required|integer',
            'rounds' => 'required|integer',
            'title' => 'required|string',
            'status' => 'required|string',
            'startin' => 'required|date',
            'reqendin' => 'required|date',
            'desc' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'min' => 'required|integer',
            'sec' => 'required|integer',
            
        ]);



    $tournament = new Tournament();
    
    $tournament->maxplayers = $validatedData['maxplayers'];
    $tournament->rounds = $validatedData['rounds'];
    $tournament->titel = $validatedData['title'];
    $tournament->status = $validatedData['status'];
    $tournament->startin = $validatedData['startin'];
    $tournament->reqendin = $validatedData['reqendin'];
    $tournament->desc = $validatedData['desc'];

    if ($request->hasFile('image')) {
        // $imagePath = $request->file('image')->store('assets', 'public');
        // $tournament->image = $imagePath;
        $userId = Auth::id();
        $timestamp = time();
        $originalFilename = $request->file('image')->getClientOriginalName();
        $imageName = "{$userId}_{$timestamp}_{$originalFilename}";
        
        
        $imagePath = $request->file('image')->storeAs("public/assets/images/tournimages", $imageName);
        $tournament->image = "storage/assets/images/tournimages/{$imageName}";
    } else {
        $tournament->image = "storage/assets/images/tournimages/pawn.webp";
    }

    $tournament->min = $validatedData['min'];
    $tournament->sec = $validatedData['sec'];
    $id = Auth::id();
    $tournament->idUtili = auth::id() ;

    $tournament->save();
    $lastid = Tournament::where('idUtili', $id)->orderBy('id','desc')->first();
    for ($i=1; $i <$validatedData['rounds'] + 1 ; $i++) { 
       $newround = New Round();
       $newround->round = $i;
       $newround->status = "Not Started";
       $newround->idter = (int)$lastid->id ;
       $newround->save();
      
    }

    return redirect()->route("dashboard");
   

    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournament $tournament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tournament $tournament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('games')->where('idter', $id)->delete();
        DB::table('players')->where('idter', $id)->delete();
        $thetern = Tournament::find($id);
        $imagePath = $thetern->image;
        DB::table('rounds')->where('idter', $id)->delete();
        DB::table('byes')->where('idter', $id)->delete();
        


        
        
        Storage::disk('local')->delete($imagePath);
        $thetern->delete();
        return  redirect()->route('dashboard');
        
        
        
        
        
    }
    public function getrounds($id){
        $thetern = Tournament::findOrFail($id);
        if ($thetern->round > 0) {
            $rounds = Round::where('idter',$id)->get();
            $players = Player::where("idter",$id)
            ->orderby('pointes','desc')
            ->orderby('tiebreack','desc')
            ->orderby('perefo','desc')
            ->orderby('elo','desc')
            ->get();
            $games = Game::where("idter",$id)
            ->where('round',$thetern->round)
            ->with(['Player1','Player2'])
            ->get();
            
            return view('utili.tourn.rounds.rounds',['tour'=>$thetern,'rounds'=>$rounds,'players'=>$players,'games'=>$games]);

        }else{
            return ("<a href='/start/$id'>create tournament</a>");
             
             
        }
    }
    public function starttour($id){
        $thetern = Tournament::findOrFail($id);
        $thetern->round= 1 ;
        $thetern->save();
        $players = Player::where("idter",$id)
            ->orderby('pointes','desc')
            ->orderby('tiebreack','desc')
            ->orderby('perefo','desc')
            ->orderby('elo','desc')
            ->get();
        $playersArray = [];
        $playersArray = $players->toArray();
        $half = ceil(count($playersArray) / 2); 
        $firstHalf = array_slice($playersArray, 0, $half); 
        $secondHalf = array_slice($playersArray, $half);
        for ($i=0; $i < $half  ; $i++) { 
            if (!isset($secondHalf[$i])) {
                $idplayern = $firstHalf[$i]['id'] ;
                $plyr = Player::findOrFail($idplayern);
                if ($plyr->pointes === null) {
                    $plyr->pointes = 0;
                }
                $plyr->pointes +=1;
                $thebye = New Bye();
                $thebye->idp = $plyr->id;
                $thebye->idter = $id;
                $thebye->idround = 1; 
                $thebye->save();
                $plyr->save();
                

                
            }else{
                $game = New Game();
                $game -> idp1 = $firstHalf[$i]['id'] ;
                $game -> idp2 = $secondHalf[$i]['id'];
                $game -> idter = $id;
                $game -> round = 1;
                $game->save();

                
            }
        }

        return  redirect()->route('roundsid',$id);
       
       
    }
    public function newround($idter){
        $thetern = Tournament::findOrFail($idter);
        if ($thetern->rounds>$thetern->round) {
            $games=Game::where('idter',$idter)
            ->where('round',$thetern->round)
            ->get();
            $done = TRUE;
            foreach ($games as $game) {
                if ($game->res === null) {
                    $done = FALSE;
                }
            }
            if ($done ==true) {
                $thetern->round+= 1 ;
                $thetern->save();
                $players = Player::where("idter",$idter)
                ->orderby('pointes','desc')
                ->orderby('tiebreack','desc')
                ->orderby('perefo','desc')
                ->orderby('elo','desc')
                ->get();
                $totalPlayers = $players->count();

                if ($totalPlayers % 2 !== 0) {
    
                    $lastPlayer = $players->pop(); 
                    $thebye = New Bye();
                    $thetern = Tournament::findOrFail($idter);
                    $thebye->idp = $lastPlayer->id;
                    $thebye->idter = $idter;
                    $thebye->idround = $thetern->round; 
                    $thebye->save();
                    $lastPlayer->pointes+=1;
                    $lastPlayer->save();

                    $half = $players->count() / 2;
                    $firstHalf = $players->slice(0, $half);
                    // $secondHalf = $players->slice($half);
                    $secondHalf = array_slice($players->toArray(),$half);
                } else {
    
                    $half = $totalPlayers / 2;
                    $firstHalf = $players->slice(0, $half);
                    // $secondHalf = $players->slice($half);
                    $secondHalf = array_slice($players->toArray(),$half);
                }
                
                
                for ($i=0; $i < $half  ; $i++){

                    $game = New Game();
                    $game -> idp1 = $firstHalf[$i]['id'] ;
                    $game -> idp2 = $secondHalf[$i]['id'];
                    $game -> idter = $idter;
                    $thetern = Tournament::findOrFail($idter);
                    $game -> round = $thetern->round;
                    $game->save();

                    
                    
                }
                return redirect()->route('roundsid',$idter);

            }else {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
    public function getmaxpo($idter){
        $maxpo = Player::where("idter",$idter)
                ->max('pointes');
        return($maxpo);
                
    }
    public function startround($idter){
        $thetern = Tournament::findOrFail($idter);
        if ($thetern->rounds>$thetern->round) {
            $games=Game::where('idter',$idter)
            ->where('round',$thetern->round)
            ->get();
            $done = TRUE;
            foreach ($games as $game) {
                if ($game->res === null) {
                    $done = FALSE;
                }
            }
            if ($done ==true) {
                $thetern->round+= 1 ;
                $thetern->save();
                $players = Player::where("idter",$idter)
                ->orderby('pointes','desc')
                ->orderby('tiebreack','desc')
                ->orderby('perefo','desc')
                ->orderby('elo','desc')
                ->get();
                $totalPlayers = $players->count();

                if ($totalPlayers % 2 !== 0) {
    
                    $lastPlayer = $players->pop(); 
                    $thebye = New Bye();
                    $thetern = Tournament::findOrFail($idter);
                    $thebye->idp = $lastPlayer->id;
                    $thebye->idter = $idter;
                    $thebye->idround = $thetern->round; 
                    $thebye->save();
                    $lastPlayer->pointes+=1;
                    $lastPlayer->save();

                    $maxpo = Player::where("idter",$idter)
                    ->max('pointes');
                    $playerslist=[];
                    for ($maxpo; $maxpo >-0.5; $maxpo-=0.5) { 
                        $playerwithpo=[];
                        foreach ($players as $player) {
                           if ($player->pointes==$maxpo) {
                            $playerwithpo[]=$player;
                            
                           }
                        }

                        if (isset($playerwithpo[0])) {
                            $halved = array_chunk($playerwithpo,ceil(count($playerwithpo)/2));
                        $half1count = count($halved[0]);
                        for ($i=0; $i <$half1count ; $i++) { 
                            $playerslist[]=$halved[0][$i];
                            if (isset($halved[1][$i])) {
                                $playerslist[]=$halved[1][$i];

                            }
                        }
                        }
                        
                    }
                    $playerlistcount = count($playerslist);
                    for ($i=0; $i <$playerlistcount ; $i+=2) { 
                        $thetern = Tournament::findOrFail($idter);
                        if ($thetern->round % 2 !== 0) {
                            $game = New Game();
                            $game -> idp1 = $playerslist[$i]['id'] ;
                            $game -> idp2 = $playerslist[$i+1]['id'];
                            $game -> idter = $idter;
                            
                            $game -> round = $thetern->round;
                            $game->save();
                        }else{
                            $game = New Game();
                            $game -> idp1 = $playerslist[$i+1]['id'] ;
                            $game -> idp2 = $playerslist[$i]['id'];
                            $game -> idter = $idter;
                            
                            $game -> round = $thetern->round;
                            $game->save();
                        }
                        
                    }


                   
                } else {
                    $maxpo = Player::where("idter",$idter)
                    ->max('pointes');
                    $playerslist=[];
                    for ($maxpo; $maxpo <-1; $maxpo--) { 
                        $playerwithpo=[];
                        foreach ($players as $player) {
                           if ($player->pointes==$maxpo) {
                            $playerwithpo[]=$player;
                            
                           }
                        }
                        if (isset($playerwithpo[0])) {
                            $halved = array_chunk($playerwithpo,ceil(count($playerwithpo)/2));
                        $half1count = count($halved[0]);
                        for ($i=0; $i <$half1count ; $i++) { 
                            $playerslist[]=$halved[0][$i];
                            if (isset($halved[$i])) {
                                $playerslist[]=$halved[1][$i];
                            }
                        }
                        }
                        
                        
                    }
                    $playerlistcount = count($playerslist);
                    for ($i=0; $i <$playerlistcount ; $i+=2) { 
                        $thetern = Tournament::findOrFail($idter);
                        if ($thetern->round % 2 !== 0) {
                            $game = New Game();
                            $game -> idp1 = $playerslist[$i]['id'] ;
                            $game -> idp2 = $playerslist[$i+1]['id'];
                            $game -> idter = $idter;
                            
                            $game -> round = $thetern->round;
                            $game->save();
                        }else{
                            $game = New Game();
                            $game -> idp1 = $playerslist[$i+1]['id'] ;
                            $game -> idp2 = $playerslist[$i]['id'];
                            $game -> idter = $idter;
                            
                            $game -> round = $thetern->round;
                            $game->save();
                        }
                    }
                   
                }
                
                
               
                return redirect()->route('roundsid',$idter);

            }else {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
    public function arrays(){
        $a = 0;
        if ($a % 2 ==0) {
            echo "yes";
        }else{
            echo "faredi";
        }
        


        


    }
    
}
