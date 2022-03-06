<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Todo;
use PDF;
class CategoriaController extends Controller
{
    
    public function store(Request $request){
 
      $request->validate([
            'nombre' => 'required|min:3|unique:categorias,nombre',
        ]);
      $categoria=new Categoria;
         $categoria->nombre=$request->nombre;
         $categoria->save();
        
         return redirect()->route('categorias')-> with('success','Categoria creada');
      }
  
  
  
     public function index(){
         $categorias=Categoria::orderBy('id','desc')->paginate(4);
      return view('categorias.index',['pasado'=>$categorias]);
       }
  
       public function createPDF(){
        
        $pdf = PDF::loadView('categorias.pdfgenera', [
          'title' => 'CodeAndDeploy.com Laravel Pdf Tutorial',
          'description' => Categoria::all(),
          'footer' => 'by <a href="https://codeanddeploy.com">codeanddeploy.com</a>'
        ]);
      
          return $pdf->download('sample.pdf');
     }


       public function actualizar(Request $request)
       {
          
          $categoria=new Categoria;
          $categorias = Categoria::find($request->id);
          $request->validate([
            'nombre' => 'required|min:3|unique:categorias,nombre,'.$request->id.',id',
         ]);
          $categorias->update($request->all());
          return redirect()->route('categorias')-> with('success','Categoria editada exitosamente');
       }
   
    
       public function borrar(Request $request)
       {
         $trabajos = Todo::where('id_categoria', $request->id)->delete();    
          
          $categorias = Categoria::find($request->id);
      

          
          $categorias->delete();
          return redirect()->route('categorias')-> with('success','Categoria eliminada exitosamente');
       }
     
}
