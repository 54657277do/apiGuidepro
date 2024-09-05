<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class formateurscontroler extends Controller
{
    public function register(Request $request)
    {
     //validation
     $request->validate([
        'username' => 'required|min:4',
        'email' => 'required|email|unique:formateurs',
        'password' =>'required|min:6|confirmed'
     ]);
     //traitement data
     $formateur= new Formateur();
     $formateur->username=$request->username;
     $formateur->email= $request->email;
     $formateur->password= Hash::make($request->password);
     $formateur->save();
     //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Etudiant créé avec success'
     ]);
    }



    public function login(Request $request)
    {
     //validation
     $request->validate([
        'email' => 'required|email|',
        'password' =>'required|min:6|'
     ]);
     //verifier l'existence du formateur
     $formateur= Formateur::where('email','=',$request->email)->first();

     if($formateur)
     {
      if(Hash::check($request->password, $formateur->password)){
        //Si le mot de passe existe
        $tokens=$formateur->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=>1,
            'message'=>'Connexion reussi',
            'accessToken'=> $tokens
          ]);
      } else {
        return response()->json([
            'status'=>0,
            'message'=>'Mot de passe incorrect'
          ]);
      }
     } else{
      return response()->json([
        'status'=>0,
        'message'=>'Formateur non trouvé'
      ], 404);
    }
     //reponse
    }



    public function profile(Request $request)
    {
        return response()->json([
            'status'=>1,
            'message'=>'Information de profile',
            'data'=>Auth::user()
          ]);
    }

    public function updateprofile(Request $request,$id)
    {
      $formateur=Formateur::where([
        'idformateur'=>$id,
            ])->first();
            
            $request->validate([
              'username' => 'required|min:4',
              'email' => 'required|email|unique:formateurs',
              'password' =>'required|min:6|confirmed'
           ]);
           
        $formateur->update([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password
        ]);

    }


    
    public function logout(Request $request)
    {
     Auth::user()->tokens()->delete();
     return response()->json([
        'status'=>1,
        'message'=>'Deconnexion reuissi'
      ], 404);
    }
}
