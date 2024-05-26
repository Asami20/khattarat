<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
  
    protected $fillable = [
  'titre',
   'description',
   'ImageUrl',
    'pdf_uploaded'];
}
