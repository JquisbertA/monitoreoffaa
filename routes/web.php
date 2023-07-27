<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('theme.app');
}); */

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/guardarGrupServ', 'GrupoServiciosController@Guardar');

Route::post('/listarGrupServ', 'GrupoServiciosController@Listar');

Route::post('/datosGrupServ', 'GrupoServiciosController@Datos');

Route::post('/editarGrupServ', 'GrupoServiciosController@Editar');

Route::post('/estadoGrupServ', 'GrupoServiciosController@CambioEstado');


Route::post('/guardarEmpreServ', 'EmpresaServiciosController@Guardar');
Route::post('/listarEmpreServ', 'EmpresaServiciosController@Listar');
Route::post('/datosEmpreServ', 'EmpresaServiciosController@Datos');
Route::post('/editarEmpreServ', 'EmpresaServiciosController@Editar');
Route::post('/estadoEmpreServ', 'EmpresaServiciosController@CambioEstado');


Route::post('/guardarPagoServ', 'PagoServiciosController@Guardar');

Route::post('/listarPagoServ', 'PagoServiciosController@Listar');

Route::post('/datosPagoServ', 'PagoServiciosController@Datos');

Route::post('/editarPagoServ', 'PagoServiciosController@Editar');



Route::get('/{optional?}', function () {
    return view('theme.app');
})->name('basepath')
    ->where('optional','.*');


