<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',function(){
return view('inicio');
});



/*Rutas normales*/
/*Tareas */
Route::get('/tareas',[TodosController::class,'index'])->name('tareas');
Route::post('/tareas',[TodosController::class,'store'])->name('tareas');
Route::post('/borrar',[TodosController::class,'borrar'])->name('borrar');
Route::post('/actualizar',[TodosController::class,'actualizar'])->name('actualizar');
/*Categorias */
Route::get('/categorias','App\Http\Controllers\CategoriaController@index')->name('categorias');
Route::post('/categorias','App\Http\Controllers\CategoriaController@store')->name('categorias');
Route::post('/eliminar','App\Http\Controllers\CategoriaController@borrar')->name('eliminar');
Route::post('/modifica','App\Http\Controllers\CategoriaController@actualizar')->name('modifica');
Route::get('/categorias/pdf', 'App\Http\Controllers\CategoriaController@createPDF')->name('categoria.pdf');

/*Rutas con buscador en tiempo real y paginado */
/*Tareas*/
Route::get('/pagination', 'App\Http\Controllers\PaginationController@index');
Route::get('/pagination/fetch_data', 'App\Http\Controllers\PaginationController@fetch_data');
Route::post('/pagination','App\Http\Controllers\PaginationController@store')->name('pagination');
Route::post('/update','App\Http\Controllers\PaginationController@actualizar')->name('update');
Route::post('/delete','App\Http\Controllers\PaginationController@delete')->name('delete');

/*Categorias */
Route::get('/paginationcategoria', 'App\Http\Controllers\PaginationCategoriaController@index')->name('paginationcategoria');
Route::get('/paginationcategoria/fetch_data', 'App\Http\Controllers\PaginationCategoriaController@fetch_data');
Route::post('/paginationcategoria','App\Http\Controllers\PaginationCategoriaController@store')->name('paginationcategoria');
Route::post('/updatecategoria','App\Http\Controllers\PaginationCategoriaController@actualizar')->name('updatecategoria');
Route::post('/deletecategoria','App\Http\Controllers\PaginationCategoriaController@delete')->name('deletecategoria');

/*Buscador categorias AJAX */
Route::get('/reporte','App\Http\Controllers\buscadorCategoriaController@index')->name('reporte');
Route::get('/reporte/fetch_data','App\Http\Controllers\buscadorCategoriaController@fetch_data');


/*Grafico */
Route::get('/chartjs','App\Http\Controllers\GraficoControlador@index')->name('chartjs');
Route::get('/chartjs/fetch_data','App\Http\Controllers\GraficoControlador@fetch_data')->name('/chartjs/fetch_data');
Route::get('/chartjs/fetch_data_parameters','App\Http\Controllers\GraficoControlador@fetch_data_parameters');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
