<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/AuthController.php  
class AuthController extends Controller  
{  
    // Inscription d'un formateur  
    public function register(CreateFormaterRequest $request)  
    {  
        // Valider les données du formulaire d'inscription  
        $validatedData = $request->validated();  

        // Créer un nouveau formateur  
        $formateur = Formateur::create($validatedData);  

        // Retourner une réponse avec le nouveau formateur créé  
        return response()->json($formateur, 201);  
    }  

    // Connexion d'un formateur  
    public function login(Request $request)  
    {  
        // Valider les données de connexion  
        $credentials = $request->only('username', 'password');  

        // Vérifier les identifiants  
        if (Auth::attempt($credentials)) {  
            // Générer un jeton d'authentification  
            $token = $formateur->createToken('auth_token')->plainTextToken;  

            // Retourner la réponse avec le jeton  
            return response()->json([  
                'access_token' => $token,  
                'token_type' => 'Bearer',  
            ]);  
        }  

        // Retourner une erreur de connexion  
        return response()->json(['error' => 'Identifiants invalides'], 401);  
    }  
}
