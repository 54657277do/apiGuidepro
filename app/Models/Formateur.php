<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

class Formateur extends Model
{
    use HasFactory, HasApiTokens;
    protected $table='Formateurs';
    protected $fillable= ['idformateur', 'nom', 'email', 'passsword'];
    protected $primaryKey = 'idformateur';


    public function personalAccessTokens()  
    {  
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');  
    }

     // Relation avec la table "modules"  
     public function modules()  
     {  
         return $this->hasMany(Module::class);  
     }  
 
     // Relation avec la table "chapitres"  
     public function chapitres()  
     {  
         return $this->hasMany(Chapter::class);  
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
