<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khettarat extends Model
{
    use HasFactory;
    protected $table='khettarat';
    protected $fillable =[
       
      'titre',
      'bénévole',
      'guide',
        'description',
      'ImageUrl', 
    ];
      // Définir le nom de la clé primaire
      protected $primaryKey = 'id_khettarat';

      // Si la clé primaire n'est pas auto-incrémentée, définissez `public $incrementing` à false
      public $incrementing = true;
  
      // Si la clé primaire n'est pas de type integer, définissez `$keyType`
      protected $keyType = 'int';
   
}
