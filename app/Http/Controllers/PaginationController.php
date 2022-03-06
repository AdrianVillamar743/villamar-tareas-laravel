<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Todo;
use App\Models\Categoria;
class PaginationController extends Controller
{
    function index()
    {
      $data=DB::table('todos')->addSelect(['todos.id as id_tareas','title','todos.created_at','todos.updated_at','categorias.nombre','categorias.id','todos.id_categoria'])
      ->join('categorias','categorias.id','=','todos.id_categoria')->orderBy('todos.id','desc')->paginate(4);
$categorias=Categoria::all();
 return view('tareasbuscadorpaginado.pagination', compact('data','categorias'));
    }

    public function actualizar(Request $request)
    {
       
       $todos=new Todo;
       $todos = Todo::find($request->id);
       $request->validate([
         'title' => 'required|min:3|unique:todos,title,'.$request->id.',id',
         'id_categoria'=>'required'
     ]);
       $todos->update($request->all());
       return redirect()->route('pagination')-> with('success','Tarea editada exitosamente');
    }



    public function delete(Request $request)
     {
        
        $todo=new Todo;
        $todos = Todo::find($request->id);
 
        $todos->delete();
        return redirect()->route('pagination')-> with('success','Tarea eliminada exitosamente');
     }


    public function store(Request $request){
      $request->validate([
         'title' => 'required|min:3|unique:todos,title',
     ]);
      $todo=new Todo;
         $todo->title=$request->title;
         $todo->id_categoria=$request->id_categoria;
         $todo->save();
        
         return redirect()->route('pagination')-> with('success','Tarea creada');
      }




    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
      $data = DB::table('todos')
                    ->where('title', 'like', '%'.$query.'%')/*
                    ->orWhere('post_title', 'like', '%'.$query.'%')
                    ->orWhere('post_description', 'like', '%'.$query.'%')*/
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
      return view('tareasbuscadorpaginado.pagination_data', compact('data'))->render();
     }
    }
}
?>