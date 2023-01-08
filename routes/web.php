<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tServicioController;

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

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});


Route::view('/nuevoServicio', 'nuevoServicio')->name('nuevoServicio');
Route::view('/nuevoServicioEdit', 'nuevoServicioEdit')->name('nuevoServicioEdit');
Route::view('/redirectPdf', 'redirectPdf')->name('imprimir_pdf');

/* Route::get('/imprimirServicio', function () {
    return view('reporte');
}); */


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::resource('/clientes', 'App\Http\Controllers\ClienteController');

Auth::routes();
Route::get('/cliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente');

Auth::routes();
Route::resource('/vehiculos', 'App\Http\Controllers\VehiculoController');

Auth::routes();
Route::get('/vehiculo', [App\Http\Controllers\VehiculoController::class, 'index'])->name('vehiculo');

Auth::routes();
Route::resource('/imgVehiculos', 'App\Http\Controllers\imgController');

Auth::routes();
Route::get('/servicio', [App\Http\Controllers\ServicioController::class, 'index'])->name('servicio');

Auth::routes();
Route::resource('/servicios', 'App\Http\Controllers\ServicioController');

Auth::routes();
Route::get('/tomaServicio', [App\Http\Controllers\tServicioController::class, 'index'])->name('tomaServicio');

Auth::routes();
Route::resource('/tomaServicios', 'App\Http\Controllers\tServicioController');

Auth::routes();
Route::get('/ordenesCerradas', [App\Http\Controllers\tServicioController::class, 'cerradas'])->name('ordenesCerradas');


Route::post('/nuevaOrden',[tServicioController::class, 'newservor'])->name('nuevaOrden');
Route::post('/nuevaOrden/edit',[tServicioController::class, 'actualizarserv'])->name('nuevaOrdenUpdate');
Route::post('/dropzone/upload/{nServicio}',[tServicioController::class, 'dropzoneImg'])->name('dropzoneImg');
Route::post('/dropzone/uploadDoc/{nServicio}',[tServicioController::class, 'dropzoneDoc'])->name('dropzoneDoc');
Route::delete('/dropzone/eliminarImg/{id}',[tServicioController::class, 'eliminarImg'])->name('eliminarImg');
Route::get('/dropzone/eliminarDoc/{id}',[tServicioController::class, 'eliminarDoc'])->name('eliminarDoc');


// Auth::routes();
// Route::get('/tomaServicios', [App\Http\Controllers\tServicioController::class, 'dpdf'])->name('pdf');


//Route::get('/imprimirServicio', [App\Http\Controllers\tServicioController::class, 'pdf'])->name('tomaServicios.pdf') ;
