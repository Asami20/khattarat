<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    // Définir le nom de la clé primaire
    protected $primaryKey = 'id_gallerie';

    // Si la clé primaire n'est pas auto-incrémentée, définissez `public $incrementing` à false
    public $incrementing = true;

    // Si la clé primaire n'est pas de type integer, définissez `$keyType`
    protected $keyType = 'int';

    protected $fillable = [
        'titre', 'description', 'ImageUrl',
    ];
}
