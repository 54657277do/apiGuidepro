<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Module extends Model
{
    use HasFactory, HasApiTokens;
    protected $table='Modules';
    protected $fillable=['nommodule','idformateur','prerequis','description'];

     // Relation avec la table "formateurs"  
     public function formateur()  
     {  
         return $this->belongsTo(Formateur::class);  
     }  
 
     // Relation avec la table "chapitres"  
     public function chapitres()  
     {  
         return $this->hasMany(Chapter::class);  
     }  
} 
