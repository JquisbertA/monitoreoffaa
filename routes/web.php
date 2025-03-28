<?php

use App\Http\Controllers\MapaCeoController;
use Illuminate\Support\Facades\Auth;
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
Route::post('/authenticate/ingreso','Auth\LoginController@login');
Route::get('/authenticate/salir','Auth\LoginController@logout')->name('logout');
//Route::get('/listarPermisos','Auth\LoginController@ListarPermisos');
//Route::get('/login','Auth\LoginController@VistaLogin')->name('login');


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
Route::post('/estadoPagoServ', 'PagoServiciosController@CambioEstado');


Route::post('/unidades/crearCeo', 'CeoController@Guardar');
Route::post('/unidades/listaCeo', 'CeoController@Listar');
Route::post('/unidades/datosCeo', 'CeoController@Datos');
Route::post('/unidades/editarCeo', 'CeoController@Editar');
Route::post('/unidades/estadoCeo', 'CeoController@CambioEstado');

/* GRANDES UNIDADES */
Route::post('/unidades/crearGranUni', 'GranUnidadController@Guardar');
Route::post('/unidades/listaGranUni', 'GranUnidadController@Listar');
Route::post('/unidades/datosGranUni', 'GranUnidadController@Datos');
Route::post('/unidades/editarGranUni', 'GranUnidadController@Editar');
Route::post('/unidades/estadoGranUni', 'GranUnidadController@CambioEstado');
Route::get('/unidades/selectbuscarGranUnidad', 'GranUnidadController@selectbuscarGranUnidad');

/* PEQUEÑAS UNIDADES */
Route::post('/unidades/crearPeqUni', 'PeqUnidadController@Guardar');
Route::post('/unidades/listaPeqUni', 'PeqUnidadController@Listar');
Route::post('/unidades/datosPeqUni', 'PeqUnidadController@Datos');
Route::post('/unidades/editarPeqUni', 'PeqUnidadController@Editar');
Route::post('/unidades/estadoPeqUni', 'PeqUnidadController@CambioEstado');

Route::get('/locations', 'MapaCeoController@index');
Route::post('/locations', 'MapaCeoController@store');
Route::delete('/locations/{id}', 'MapaCeoController@destroy')->name('locations.destroy');
Route::put('/locations/{id}', 'MapaCeoController@update');

// USUARIOS
Route::post('/usuario/CrearUsuario','UserController@CrearUsuario');
Route::post('/datosUsuarios','UserController@DatosUsuarios');
Route::put('/editarUsuarios','UserController@EditarUsuario');
Route::put('/desactivarUsuario', 'UserController@desactivarUsuario');

Route::get('/datosP','UserController@datosP');
Route::get('/datosUsuario','UserController@DatosUsuario');
Route::post('/listarUsuarios','UserController@ListarUsuarios');
Route::put('/activarUsuario', 'UserController@activarUsuario');
Route::post('/usuario/AgregarUsuario','UserController@AgregarUsuario');
Route::post('/usuario/registroUser','UserController@store');
Route::post('/editContrasena','UserController@EditContrasena');
Route::get('/listUsuarios','UserController@listUser');
Route::put('/activarUsuarioDesbloqueado','UserController@desbloqueo');

// MODULOS DEL SISTEMA
Route::post('/registrarModulo','ModulosController@registrarModulo');
Route::post('/ListarModulos','ModulosController@ListarModulos');
Route::put('/desactivarModulo', 'ModulosController@desactivarModulo');
Route::put('/activarModulo', 'ModulosController@activarModulo');
Route::put('/actualizarModulo', 'ModulosController@actualizarModulo');
Route::get('/selectModulos','ModulosController@selectModulos');

// PERMISOS
Route::post('/registrarPermiso','PermisosController@registrarPermiso');
Route::post('/ListarPermisos','PermisosController@ListarPermisos');
Route::put('/desactivarPermiso', 'PermisosController@desactivarPermiso');
Route::put('/activarPermiso', 'PermisosController@activarPermiso');
Route::put('/actualizarPermiso', 'PermisosController@actualizarPermiso');
Route::post('/listPermisos','PermisosController@ListPermisos');

// ROLES
Route::post('/guardarRol','RoleController@GuardarRol');
Route::post('/ListarRol','RoleController@ListarRol');
Route::get('/roles/selectRol','RoleController@selectRol');
Route::post('/listaRolPermiso','RoleController@ListaRolPermiso');
Route::post('/editarRol','RoleController@EditarRol');
Route::post('/desactivarRol', 'RoleController@desactivarRol');
Route::post('/activarRol', 'RoleController@activarRol');

Route::get('/listarRoles','RoleController@ListarRoles');

// PERSONAL
Route::post('/listarPersonal', 'PersonalController@ListarPersonal');
Route::post('/crearPersonal', 'PersonalController@CrearPersonal');
Route::post('/datosPersonal', 'PersonalController@DatosPersonal');


// FUERZA
Route::post('/listarFuerza', 'FuerzaController@ListarFuerza');
Route::get('/selectFuerza', 'FuerzaController@SelectFuerza');

// ESCALAFON
Route::post('/listarEscalafon', 'EscalafonController@ListarEscalafon');

// GRADO
Route::post('/listarGrado', 'GradoController@ListarGrado');

// ESPECIALIDAD
Route::post('/listarEspecialidad', 'EspecialidadController@ListarEspecialidad');

// ARMA
Route::post('/listarArma', 'ArmaController@ListarArma');

// REPORTE
Route::get('/reporte_personal', 'ReporteController@ReportePersonal');


















































Route::post('/listarIncidente', 'IncidenteController@Listar');
Route::post('/guardarIncidente', 'IncidenteController@Guardar');
Route::get('/{optional?}', function () {
    return view('theme.app');
})->name('basepath')
    ->where('optional','.*');



