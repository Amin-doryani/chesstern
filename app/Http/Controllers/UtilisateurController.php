<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("utili.signup");
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'pass' => 'required',

        ]);
        $user = New Utilisateur();
        $name = $request ->input("name");
        $lastname = $request ->input("lastname");
        $email = $request ->input("email");
        $pass = $request ->input("pass");
        $user ->name = $name;
        $user ->lastname = $lastname;
        $user ->email = $email;
        $user ->password = Hash::make($pass) ;
        $user->save();
        return ("add to db");


    }
    public function logincreate()
    {
        return view("utili.login");
    }
    public function checklogin(Request $request)
    {
        $request->validate([
            
            'email' => 'required',
            'pass' => 'required',

        ]);
        $email = $request ->input("email");
        $pass = $request ->input("pass");
       
        
        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        else{
            return view('utili.login');
        }

    }
    public function logout(){
       Session::flush();
       Auth::logout();
       return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        //
    }

}
