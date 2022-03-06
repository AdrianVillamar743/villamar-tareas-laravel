<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Categoria;
class buscadorCategoriaController extends Controller
{
    public function index(){

        $data=DB::table('categorias')->addSelect(['categorias.id as id_categorias','nombre',DB::raw('count(*) as numero_tareas')])
                ->join('todos','categorias.id','=','todos.id_categoria')->orderBy('categorias.id','desc')->groupBy('categorias.id','categorias.nombre')->paginate(4);
       return view('graficos.graficacion', compact('data'));
        }
  
  
  
  
     
  
       
  
  
        function fetch_data(Request $request)
        {
         if($request->ajax())
         {
      
                $query = $request->get('envio');
                $query = str_replace(" ", "%", $query);
                $data=DB::table('categorias')->addSelect(['categorias.id as id_categorias','nombre',DB::raw('count(*) as numero_tareas')])
                ->join('todos','categorias.id','=','todos.id_categoria')->where('categorias.nombre', 'like', '%'.$query.'%')->orderBy('categorias.id','desc')->groupBy('categorias.id','categorias.nombre')->paginate(4);
         
          
          return view('graficos.graficosdato', compact('data'))->render();
         }
        }
  
}

