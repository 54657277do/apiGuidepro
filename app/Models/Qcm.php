<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Qcm extends Model
{
    use HasFactory, HasApiTokens;
    protected $table='Qcm';
    protected $fillable= ['imgqcm','libelle','option1','option2','option3','reponse','idchapitre'];

    // Relation avec la table "formateurs"  
    public function formateur()  
    {  
        return $this->belongsTo(Formateur::class);
    }   

    // Relation avec la table "modules"  
    public function module()  
    {  
        return $this->belongsTo(Module::class);  
    }  

    // Relation avec la table "chapitres"  
    public function chapitre()  
    {  
        return $this->belongsTo(Chapter::class);  
    }  
}
