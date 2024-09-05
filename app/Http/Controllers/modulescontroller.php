<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class modulescontroller extends Controller
{
//////////////////////////////////// FOR CREATE ///////////////////////////////////
    public function creermodule(Request $request)
    {
     //validation
     $request->validate([
        'nommodule' => 'required|min:3',
        'description' =>'required|min:6'
     ]);
     //traitement data
     $module= new Module();
     $module->nommodule=$request->nommodule;
     $module->idformateur=Auth::user()->idformateur;
     $module->prerequis=$request->prerequis;
     $module->description=$request->description;
     $module->save();
     //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Module créé avec success'
     ]);
    }

///////////////////////////////// FOR LIST ///////////////////////////////////////////////////

    public function listemodule()
    {
     $formateurid=Auth::user()->idformateur;
     $modules= Module::where('idformateur', '=', $formateurid)->get();

     //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Modules de ce formateur',
        'data'=>$modules
     ]);
    }

////////////////////////////////// FOR UPDATE //////////////////////////////////////////////////

    public function updatemodule(Request $request, $id)
    {
     $formateurid=Auth::user()->idformateur;
        if(Module::where([
            'idmodule'=>$id,
            'idformateur'=>$formateurid
            ])->exists()){
                
             $module=Module::where([
            'idmodule'=>$id,
            'idformateur'=>$formateurid
                ])->first();

                 //validation
     $request->validate([
        'nommodule' => 'required|min:3',
        'description' =>'required|min:6'
     ]);

            $module->update([
                'nommodule'=>$request->nommodule,
                'prerequis'=>$request->prerequis,
                'description'=>$request->description
            ]);

            //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Module supprimé'
     ]);
            } else {
    
     return response()->json([
        'status'=>0,
        'message'=>'Module non trouvé'
     ]);

            }
    }


//////////////////////////////////// FOR DELETE /////////////////////////////////////////////

    public function deletemodule($id)
    {
        $formateurid=Auth::user()->idformateur;
        if(Module::where([
            'idmodule'=>$id,
            'idformateur'=>$formateurid
            ])->exists()){
                
             $module=Module::where([
            'idmodule'=>$id,
            'idformateur'=>$formateurid
                ])->first();
            $module->delete();

            //reponse
     return response()->json([
        'status'=>1,
        'message'=>'Module supprimé'
     ]);
            } else {
    
     return response()->json([
        'status'=>0,
        'message'=>'Module non trouvé'
     ]);

            }
    }
}
