<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Chapter extends Model
{
    use HasFactory, HasApiTokens;
    protected $table='Chapters';
    protected $fillable=['nomchapitre','idmodule'];

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

    // Relation avec la table "cours"  
    public function cours()  
    {  
        return $this->hasMany(Cour::class);  
    }  

    // Relation avec la table "QCM"  
    public function qcm()  
    {  
        return $this->hasMany(Qcm::class);  
    }  
} 
