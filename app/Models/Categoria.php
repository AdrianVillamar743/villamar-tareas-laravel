<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;
class Categoria extends Model
{
    protected $fillable = ['id_categoria','nombre'];
    use HasFactory;


}
