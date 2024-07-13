<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Requset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
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
    public function create($id)
    {
        return view('utili.tourn.addplayer',['idter'=>$id]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$idter)
    {
        $pl = New Player();
        $request->validate([
            
            'name' => 'required|string',
            'username' => 'required|string',
            'elo' => 'nullable|integer|min:100|max:3500',
            'date'=> 'nullable|date',
            'image' => 'nullable|image|max:10240',
        ]);
        $pl->IdUtili = auth::id();
        $pl-> idter = $idter;
        $pl->name = $request->input('name');
        $pl->username = $request->input('username');
        if ($request->input('elo')  == null) {
            $pl->elo = 1000;
        }else{
            $pl->elo = $request->input('elo');
        }
        
        
        if ($request->filled('date')) {
            $pl->date = $request->input('date');
        }else{
            $pl->date = Null;

        }
        if ($request->hasFile('image')) {
            
            
            $timestamp = time();
            $originalFilename = $request->file('image')->getClientOriginalName();
            $imageName = "{$idter}_{$timestamp}_{$originalFilename}";
            
            
            $imagePath = $request->file('image')->storeAs("public/assets/images/playerimage", $imageName);
            $pl->iamge = "storage/assets/images/playerimage/{$imageName}";
        } else {
            $pl->iamge = null;
        }

        $pl->save();
        return redirect()->route('dashboard');
        
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $theplayer = Player::find($id);
        $theplayer->delete();
         return redirect()->back();
    }
    public function showplayers($idter){
        $players = Player::where('idter',$idter)->get();
        return view('utili.tourn.playersintourna',['players'=>$players]);
    }
}
