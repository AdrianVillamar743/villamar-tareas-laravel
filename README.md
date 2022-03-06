# villamar-tareas-laravel
 CRUD realizado con el gestor de bd MySQL utilizando Laravel como framework de PHP
Empezaremos creando una aplicacion php utilizando el framework Laravel.
Por lo que previamente a ello debemos contar con composer instalado.
Las herramientas a utilizarse son las siguientes. 
Xampp, Visual Studio code, npm.js y un navegador web de su preferencia.

1.- Descargar e instalar composer.
2.- Abrir la carpeta en la que alojaremos el proyecto y ejecutar el siguiente comando
    composer create-project laravel/laravel nombreproyecto
3.- Una vez que ha sido creado podemos ejecutarlo y comprobar si se encuentra funcionando correctamente a traves del siguiente
    comando. 
    php artisan serve
4.- Dentro de la carpeta views crearemos una nueva plantilla llamada app.blade.php, crearemos una estructura html normal y dentro un hola mundo.

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hola mundo
</body>
</html>

5.- Si ejecutamos el comando php artisan serve para visualizarlo no podremos, por lo que debemos modificar el archivo de inicio para poder verlo. Dicho archivo es web.php en el cual modificaremos la funcion de inicio.

Teniendo originalmente lo siguiente

Route::get('/', function () {
    return view('welcome');
});


Donde el return view es el nombre de la vista que devuelve en el caso de nosotros reemplazaremos welcome por app.
Quedando de la siguiente forma.

Route::get('/', function () {
    return view('app');
});

Por lo que ahora nos devolverá la ruta que hemos creado, sin embargo si observamos bien dentro de la funcion get notamos que existen dos parametros uno para la ruta y otro para function que retorna la vista. Por lo que dentro del primer parametro podremos retornar la ruta que deseemos con la vista asignada
Por ejemplo 

Route::get('/holagente',function(){
return view('app');
});

6.- Ahora modificaremos crearemos un nuevo archivo nav.blade.php para utilizar un menú de barras en la parte superior

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    
    <title>Tareas</title>
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">SISTEMA VILLAMAR</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/tareas">Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Categorias</a>
      </li>
  
    </ul>
  </div>
</nav>

@yield('content')


</body>
</html>
7.- Ahora añadiremos la anotación @yield('content') antes de finalizar el body de nuestro archivo nav.blade.php

8.- Dentro de la carpeta views crearemos otra carpeta llamada tareas, dentro de esta nueva carpeta crearemos un nuevo archivo llamado index.blade.php
Y referenciaremos el archivo app.blade.php con la anotación 
@extends('nav');
Luego referenciamos el contenido quedando nuestro archivo de la siguiente manera

@extends('nav');


@section('content')

hola mundo
@endsection

9.- Luego modificamos este archivo según deseemos

10.- En laravel como tal no interactuaremos la base de datos ya creada, sino que crearemos versiones a partir del codigo de php es decir migraciones.
Los modelos van en singular
Crearemos un nuevo modelo a partir del comando 

php artisan make:model Todo -m

Donde el parametro -m es para crear la migración al modelo también

11.- Luego de haber creado el modelo y la migracion pocederemos a modificarlo de acuerdo a las necesidades de la tabla que deseemos quedando la migracion en la funcion up de la siguiente manera

  public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
    }

12.- Ahora modificaremos el archivo .env para conectarnos a nuestra bd con el nombre de la db

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=villamar_sistema
DB_USERNAME=root
DB_PASSWORD=

13.- Una vez hecho ello procederemos a utilizar el comando php artisan migrate para subirlo a la base de datos.

14.- En caso de querer deshacer el último cambio utilizaremos el comando php artisan migrate:rollback

15.- Debemos unir el modelo con la migración a través de un controlador que crearemos a través del comando 

php artisan make:controller NombreControllador

Quedando de la siguiente forma en nuestro caso

php artisan make:controller TodosController

Colocamos la funcion store para guardar nuestros datos
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

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
          'title' => 'required|min:3',
      ]);
      echo "<script language='javascript'> ;</script>";
       $todo=new Todo;
       $todo->title=$request->title;
       $todo->save();
      
       return redirect()->route('tareas')-> with('success','Tarea creada');
    }
}

16.- Modificamos nuestro archivo index.blade y podremos guardar 
@extends('nav')
@section('content')


   <div class="container">
   <br>
   <h3 >Registro de tareas</h3>
   <br>
   <div class="abs-center">
       
   <form action="{{route('tareas')}}" method="POST">
  @csrf
   <div class="form-row">
    <div class="form-group md-15">
      <label for="title">Nombre</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Nombre">
    </div>
    <!-- Aquí puedes escribir tu comentario 
    <div class="form-group col-md-6">
    <label for="inputcategoria">Categoria</label>
      <select id="inputcategoria" class="form-control">
        <option selected>Seleccione una categoria</option>
        <option>...</option>
      </select>
    </div>
  

-->

<div class="container">
  <div class="row">
    <div class="col text-center">
    <button text-align="center" type="submit" class="btn btn-primary">Registrar</button>
    <button text-align="center" type="submit" class="btn btn-danger">Cancelar</button>
    </div>
  </div>
</div>


  </div>
</form>
</div>
   </div>



   <div class="container">
   <h3 >Listado de tareas</h3>
   <br>
   <div class="table-responsive-sm">
   <table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
</div>
   </div>
@endsection


Es absolutamente necesario la anotación @csrf para generar un token de autorizacion de funciones crud 


17.- Ahora utilizaremos la anotacion if para verificar el valor de la sesion de envio de parametros en caso de existir un correcto funcionamiento me envia el valor asignado a un retorno seguro y en caso de existir un error me muestra el error asignado a la variable $message presente en todas las vistas de manera tácita

@extends('nav')
@section('content')


   <div class="container">
   <br>
   <h3 >Registro de tareas</h3>
   <br>
   <div class="abs-center">
       
   <form action="{{route('tareas')}}" method="POST">
  @csrf
    @if (session('success'))
      <h6 class="alert alert-success">
         {{session('success')}}
      </h6> 
    @endif

    @error('title')
    <h6 class="alert alert-success">
         {{$message}}
      </h6> 
    @enderror
   
   <div class="form-row">
    <div class="form-group md-15">
      <label for="title">Nombre</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Nombre">
    </div>
    <!-- Aquí puedes escribir tu comentario 
    <div class="form-group col-md-6">
    <label for="inputcategoria">Categoria</label>
      <select id="inputcategoria" class="form-control">
        <option selected>Seleccione una categoria</option>
        <option>...</option>
      </select>
    </div>
  

-->

<div class="container">
  <div class="row">
    <div class="col text-center">
    <button text-align="center" type="submit" class="btn btn-primary">Registrar</button>
    <button text-align="center" type="submit" class="btn btn-danger">Cancelar</button>
    </div>
  </div>
</div>


  </div>
</form>
</div>
   </div>



   <div class="container">
   <h3 >Listado de tareas</h3>
   <br>
   <div class="table-responsive-sm">
   <table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
</div>
   </div>
@endsection

18.- Ahora cargaremos el listado de los registros usando la function index en el controlador TodosController
Quedando de la siguiente forma

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;


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
          'title' => 'required|min:3',
      ]);
    $todo=new Todo;
       $todo->title=$request->title;
       $todo->save();
      
       return redirect()->route('tareas')-> with('success','Tarea creada');
    }



   public function index(){
       $todos=Todo::orderBy('id','desc')->paginate(4);
       
    return view('tareas.index',['pasado'=>$todos]);
     }

}

19.- Y luego recorremos la variable con un for each mientras lo mostramos en la tabla

@extends('nav')
@section('content')


   <div class="container">
   <br>
   <h3 >Registro de tareas</h3>
   <br>
   <div class="abs-center">
       
   <form action="{{route('tareas')}}" method="POST">
  @csrf
    @if (session('success'))
      <h6 class="alert alert-success">
         {{session('success')}}
      </h6> 
    @endif

    @error('title')
    <h6 class="alert alert-success">
         {{$message}}
      </h6> 
    @enderror
   
   <div class="form-row">
    <div class="form-group md-15">
      <label for="title">Nombre</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Nombre">
    </div>
    <!-- Aquí puedes escribir tu comentario 
    <div class="form-group col-md-6">
    <label for="inputcategoria">Categoria</label>
      <select id="inputcategoria" class="form-control">
        <option selected>Seleccione una categoria</option>
        <option>...</option>
      </select>
    </div>
  

-->

<div class="container">
  <div class="row">
    <div class="col text-center">
    <button text-align="center" type="submit" class="btn btn-primary">Registrar</button>
    <button text-align="center" type="submit" class="btn btn-danger">Cancelar</button>
    </div>
  </div>
</div>


  </div>
</form>
</div>
   </div>



   <div class="container">
   <h3 >Listado de tareas</h3>
   <br>
     @foreach ($pasado as $todo )
       <h3></h3>
    

   <div class="table-responsive-sm">
   <table name="tareas" id="tareas" class="table table-sm">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TITULO</th>
      <th scope="col">CREADO</th>
      <th scope="col">ACTUALIZADO</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{$todo->id}}</th>
      <td>{{$todo->title}}</td>
      <td>{{$todo->created_at}}</td>
      <td>{{$todo->updated_at}}</td>
    </tr>
   
  </tbody>
  @endforeach

  
</table>
<div class="d-flex justify-content-center">
            {{ $pasado->links('vendor.pagination.bootstrap-4') }}
        </div>
</div>
   </div>
@endsection

20.- Realizaremos pasos similares para crear la categoria.
21.- Ahora necesitaremos relacionar el codigo de categoria relacionado en la tabla de  todos o tareas.
Con el siguiente comando


php artisan make:migration add_categoria_id_to_todos_table --table=todos

Donde especifica que estamos añadiendo el campo categoria id a la tabla todos en la bd a modo de migracion

22.- Dentro de la nueva migración modificaremos la función up, para poder añadir la clave foránea, quedando de la siguiente manera.
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
           $table->bigInteger('id_categoria')->unsigned();
            $table
                    ->foreign('id_categoria')
                    ->references('id')
                    ->on('categorias')
                    ->after('title');
        });
    }

Primero creamos la nueva columna luego la relacionamos con la tabla y el campo del cual sacamos la llave foránea.

23.- Para subir el cambio debemos ejecutar el comando 

php artisan migrate

24.- En caso de error podemos realizar rollback hasta que ejecute

php artisane migrate:rollback

25.- Una vez hecho ello dentro de nuestro modelo de Categoria debemos crear un método que retorne las tareas relacionadas con ella, es decir una categoria puede tener muchos tareas asignadas

  public function todos(){
        return $this->hasMany(Todo::class);
    }

No debemos olvidar importar a las tareas 

use App\Models\Todo;

26.- En la aplicación hemos integrado el paginado así como tambien gráficos dinámicos los cuales quedan a investigarse por parte del interesado.

27.- Procederemos a realizar la exportación de una vista a pdf.

Debemos abrir una terminal y colocarnos en nuestro proyecto para importar el componente dompdf con el siguiente comando

composer require barryvdh/laravel-dompdf

28.-Abre el archivo app.php que se encuentra en la ruta config/app.php, tienes que agregar dos líneas de código, busca el array llamado ‘providers’ y agrega lo siguiente:

Barryvdh\DomPDF\ServiceProvider::class,

Ahora, un poco más abajo busca un array llamado ‘aliases’ y agrega al final del array:

'PDF' => Barryvdh\DomPDF\Facade::class,

29.- Ahora crearemos un login usando la generación automática
En la terminal escribimos 

composer require laravel/ui

Luego traemos la autenticación sin librerias como react, vue o bootstrap:
php artisan ui:auth

30.- Necesitamos agregar un atributo al modelo y la migración User para poder validar el tipo de usuario con un valor booleano. Es decir si admininistrador tendrá un valor de 1 o true y si es suscriptor se le asignará false o 0. Bajo ésta lógica implementemos lo siguiente:

Models/User.php

protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario'
    ];
En la migración correspondiente a User tambien debemos declarar el atributo.

public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('tipo_usuario')->default(0); // 0 = suscriptor && 1 = administrador
            $table->rememberToken();
            $table->timestamps();
        });
    }
