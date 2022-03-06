<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Categoria;
use App\Models\Todo;
class PaginationCategoriaController extends Controller
{
    function index()
    {
     $data = DB::table('categorias')->orderBy('id', 'desc')->paginate(5);
     return view('categoriasbuscadorpaginado.pagination', compact('data'));
    }

    public function actualizar(Request $request)
    {
       
       $categorias=new Categoria;
       $categorias = Categoria::find($request->id);
       $request->validate([
         'nombre' => 'required|min:3|unique:categorias,nombre,'.$request->id.',id',
      ]);
       $categorias->update($request->all());
       return redirect()->route('paginationcategoria')-> with('success','Categoria editada exitosamente');
    }



    public function delete(Request $request)
     {
        
      $trabajos = Todo::where('id_categoria', $request->id)->delete();    
          
        $categorias = Categoria::find($request->id);
 
        $categorias->delete();
        return redirect()->route('paginationcategoria')-> with('success','Categoria eliminada exitosamente');
     }


    public function store(Request $request){
      $request->validate([
         'nombre' => 'required|min:3|unique:categorias,nombre',
     ]);
      $categoria=new Categoria;
         $categoria->nombre=$request->nombre;
         $categoria->save();
        
         return redirect()->route('paginationcategoria')-> with('success','Categoria creada');
      }




    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
      $data = DB::table('categorias')
                    ->where('nombre', 'like', '%'.$query.'%')/*
                    ->orWhere('post_title', 'like', '%'.$query.'%')
                    ->orWhere('post_description', 'like', '%'.$query.'%')*/
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
      return view('categoriasbuscadorpaginado.pagination_data', compact('data'))->render();
     }
    }
}
?>