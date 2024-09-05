<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class courscontroller extends Controller
{
    public function creercours(Request $request)
    {
     //validation
     $request->validate([
        'imgcours' => 'required',
        'contenu' => 'required|min:100',
        'idchapitre'=>'required'
     ]);
     //traitement data
     $cours= new Cour();
     $cours->imgcours=$request->imgcours;
     $cours->contenu=$request->contenu;
     $cours->idchapitre= $request->idchapitre;
     $cours->save();
     //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Cours créé avec success'
     ]);
    }

    public function listecours($idchapter)
    {
        $formateurid=Auth::user()->idformateur;
        $cours= Cour::where(
            'idformateur', '=', $formateurid,
            'idchapitre', '=', $idchapter
            )->get();
   
        //reponse
        return response()->json([
           'status'=>1,
           'message'=>'Cours de ce chapitre',
           'data'=>$cours
        ]);
    }

    public function updatecours(Request $request, $id)
    {
     
        $formateurid=Auth::user()->idformateur;
        if(Cour::where([
            'idcours'=>$id,
            'idformateur'=>$formateurid,
            ])->exists()){
                
             $chapter=Cour::where([
            'idcours'=>$id,
            'idformateur'=>$formateurid,
                ])->first();

                $request->validate([
                    'imgcours' => 'required',
                    'contenu' => 'required|min:100',
                 ]);

            $chapter->update([
                'imgcours'=>$request->imgcours,
                'contenu'=> $request->contennu
            ]);

            //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Cours mis à jour avec succes'
     ]);
            } else {
    
     return response()->json([
        'status'=>0,
        'message'=>'Cours non trouvé'
     ]);
    }      

    }

    public function deletecours($id)
    {
     
        $formateurid=Auth::user()->idformateur;
        if(Cour::where([
            'idcours'=>$id,
            'idformateur'=>$formateurid,
            ])->exists()){
                
             $chapter=Cour::where([
            'idcours'=>$id,
            'idformateur'=>$formateurid,
                ])->first();

            $chapter->delete;

            //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Cours supprimé avec succes'
     ]);
            } else {
    
     return response()->json([
        'status'=>0,
        'message'=>'Cours non trouvé'
     ]);
    }  

    }
}
