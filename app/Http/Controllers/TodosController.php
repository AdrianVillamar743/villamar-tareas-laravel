<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Categoria;
use DB;
use Illuminate\Validation\Rule;
class TodosController extends Controller
{
    /*Index para mostrar los elementos
    Store para guardar
    update para actualizar
    destroy para eliminar
    edit para editar
    
    */



    public function store(Request $request){
      $request->validate([
          'title' => 'required|min:3|unique:todos,title',
          'id_categoria'=>'required'
      ]);
    $todo=new Todo;
       $todo->title=$request->title;
       $todo->id_categoria=$request->id_categoria;
       $todo->save();
      
       return redirect()->route('tareas')-> with('success','Tarea creada');
    }



   public function index(){

       $todos=DB::table('todos')->addSelect(['todos.id as id_tareas','title','todos.created_at','todos.updated_at','categorias.nombre','categorias.id','todos.id_categoria'])
              ->join('categorias','categorias.id','=','todos.id_categoria')->orderBy('todos.id','desc')->paginate(4);
       $categorias=Categoria::all();
    return view('tareas.index',['pasado'=>$todos,'categoriaenviadas'=>$categorias]);
     }

     public function rules()
     {
         return [
             'name'      =>  'required',
             Rule::unique('sucursals')->ignore($this->id)
         ];
     }

     public function actualizar(Request $request)
     {
        
        $todo=new Todo;
        $todos = Todo::find($request->id);
        $request->validate([
         'title' => 'required|min:3|unique:todos,title,'.$request->id.',id',
         'id_categoria'=>'required'
     ]);
        $todos->update($request->all());
        return redirect()->route('tareas')-> with('success','Tarea editada exitosamente');
     }
 

     public function borrar(Request $request)
     {
        
        $todo=new Todo;
        $todos = Todo::find($request->id);
 
        $todos->delete();
        return redirect()->route('tareas')-> with('success','Tarea eliminada exitosamente');
     }
   
 }
 
 


