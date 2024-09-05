<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class chapterscontroller extends Controller
{
////////////////////////////////// CREATE ////////////////////////////////////////////////
    public function creerchapter(Request $request)
    {
     //validation
     $request->validate([
        'nomchapitre' => 'required|min:3',
        'idmodule'=>'required',
     ]);
     //traitement data
     $chapter= new Chapter();
     $chapter->nomchapitre=$request->nomchapitre;
     $chapter->idformateur=Auth::user()->idformateur;
     $chapter->idmodule= $request->idmodule;
     $chapter->save();
     //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Chapitre créé avec success'
     ]);
    }
/////////////////////////////////// LISTER ////////////////////////////////////////////////
    public function listechapter($idmodule)
    {
     
        $formateurid=Auth::user()->idformateur;
        $chapters= Chapter::where(
            'idformateur', '=', $formateurid,
            'idmodule', '=', $idmodule
            )->get();
   
        //reponse
        return response()->json([
           'status'=>1,
           'message'=>'Chapitre de ce module',
           'data'=>$chapters
        ]);

    }
///////////////////////////////// UPDATE //////////////////////////////////////////////////
    public function updatechapter(Request $request, $id)
    {
     
        $formateurid=Auth::user()->idformateur;
        if(Chapter::where([
            'idchapitre'=>$id,
            'idformateur'=>$formateurid,
            ])->exists()){
                
             $chapter=Chapter::where([
            'idchapitre'=>$id,
            'idformateur'=>$formateurid,
                ])->first();

                $request->validate([
                    'nomchapitre' => 'required|min:3',
                 ]);

            $chapter->update([
                'nomchapitre'=>$request->nomchapitre
            ]);

            //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Chapitre mis à jour avec succes'
     ]);
            } else {
    
     return response()->json([
        'status'=>0,
        'message'=>'Chapitre non trouvé'
     ]);
    }      

    }
///////////////////////////// DELETE ////////////////////////////////////////////////////
    public function deletechapter($id)
    {
     
        $formateurid=Auth::user()->idformateur;
        if(Chapter::where([
            'idchapitre'=>$id,
            'idformateur'=>$formateurid,
            ])->exists()){
                
             $chapter=Chapter::where([
                
            'idchapitre'=>$id,
            'idformateur'=>$formateurid,
                ])->first();

            $chapter->delete();

            //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Chapitre supprimé avec succes'
     ]);
            } else {
    
     return response()->json([
        'status'=>0,
        'message'=>'Chapitre non trouvé'
     ]);
    }  

    }
}
