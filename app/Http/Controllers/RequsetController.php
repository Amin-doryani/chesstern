<?php

namespace App\Http\Controllers;

use App\Models\Requset;
use Illuminate\Http\Request;

use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class RequsetController extends Controller
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
    public function show($id)
    {
        $data = Requset::where('idter',$id)->get();
        return view("utili.tourn.requests",['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requset $requset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requset $requset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $req = Requset::findOrFail($id);
        $req->delete();
       return redirect()->back();
        
    }
    public function addtotour($id,$idter){
            $req = Requset::findOrFail($id);
            $pl = New Player();
            $idutili = auth::id();
            $pl->idUtili = $idutili;
            $pl->idter = $idter;
            $pl->name = $req->name;
            $pl->username = $req->username;
            
            $pl->elo = $req->elo;
            $pl->date = $req->date;
            $pl->iamge = $req->image;
            $pl->created_at = $req->created_at;
            $pl->updated_at = $req->updated_at;
            
            
            $pl->save();
            $req->delete();
           
            return redirect()->route('requests.show',$idter);

    }
}
