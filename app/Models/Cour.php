<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Cour extends Model
{
    use HasFactory, HasApiTokens;
    protected $table='Cours';
    protected $fillable=['idcours','imgcours','contenu','idchapitre'];

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
