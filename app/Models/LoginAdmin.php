<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LoginAdmin extends Authenticatable
{
    use HasFactory;

    protected $table = 'login'; // specify the table name if different from the class name
    protected $primaryKey = 'id_login'; // specify the primary key if different from 'id'
    
    protected $fillable = [
        'email', 'password'
    ];

    protected $hidden = [
        'password',
    ];
}
