<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
class Todo extends Model
{
    protected $fillable = ['todos_id','title','id_categoria'];
    use HasFactory;



}
