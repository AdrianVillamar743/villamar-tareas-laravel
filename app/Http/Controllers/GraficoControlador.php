<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Categoria;
class GraficoControlador extends Controller
{
 
    public function index(){
      return view('Chartjsgrafico.index');
    }

    public function fetch_data(){

      $record=DB::table('categorias')->addSelect(['nombre',DB::raw('count(*) as numero_tareas')])
      ->join('todos','categorias.id','=','todos.id_categoria')->orderBy('categorias.id','desc')->groupBy('categorias.id','categorias.nombre')->get();
      return response()->json($record);;
      }



     public function fetch_data_parameters(Request $request)
      {
       if($request->ajax())
       {
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_fin = $request->get('fecha_fin');
           
     

      $data=DB::table('categorias')->addSelect(['nombre',DB::raw('count(*) as numero_tareas')])
                      ->join('todos','categorias.id','=','todos.id_categoria')->whereBetween(DB::raw('DATE(categorias.created_at)'), [$fecha_inicio, $fecha_fin])->groupBy('categorias.id','categorias.nombre','categorias.created_at')->get();
                                                                                           

                                                                                                                                             

        return response()->json($data);;
       }
      }
    
      


     



}
