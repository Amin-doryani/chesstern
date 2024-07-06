<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Player;
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
        return view('dashboard',["tourn"=>$tourn]);

        

        
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
        $tournament->image = null;
    }

    $tournament->min = $validatedData['min'];
    $tournament->sec = $validatedData['sec'];
    $id = Auth::id();
    $tournament->idUtili = auth::id() ;

    $tournament->save();
    return redirect()->route("dashboard");
    return("addtodb");

    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament)
    {
        //
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
        DB::table('players')->where('idter', 11)->delete();
        $thetern = Tournament::findOrFail($id);
        $imagePath = $thetern->image;
        
        
        Storage::disk('local')->delete($imagePath);
        $thetern->delete();
        return  redirect()->route('dashboard');
        
        
        
        
    }
}
