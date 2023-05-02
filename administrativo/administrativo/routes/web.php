<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\adminController;
use App\Http\Middleware\Autenticado;

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
    return view('welcome');
});

/*Rutas LOGIN*/
Route::get('/', [adminController::class, 'index']);
Route::post('/login', [loginController::class, 'login']);
Route::get('/logout', [loginController::class, 'logout']);

Route::get('/indice_principal/{id}', [adminController::class, 'indice_principal']);

Route::post('/form_uno', [adminController::class, 'form_uno']);
Route::post('/form_uno/update/{id}', [adminController::class, 'form_uno_update']);
Route::post('/form_uno/eliminar/{id}', [adminController::class, 'form_uno_eliminar']);

Route::post('/form_dos/{id}', [adminController::class, 'form_dos']);

Route::get('/registro_subindice/{id}', [adminController::class, 'registro_subindice']);
Route::get('/subindice/editar/{id}', [adminController::class, 'editar_subindice']);
Route::post('/subindice/update/{id}', [adminController::class, 'update_subindice']);
Route::post('/subindice/eliminar/{id}', [adminController::class, 'eliminar_subindice']);
Route::get('/index_subindice/{id}', [adminController::class, 'index_subindice']);

Route::get('/index_subindice_tres/{id}', [adminController::class, 'index_subindice_tres']);
Route::get('/index_subindice_cuatro/{id}', [adminController::class, 'index_subindice_cuatro']);
Route::get('/index_subindice_cinco/{id}', [adminController::class, 'index_subindice_cinco']);


Route::get('/doc_subind_dos/{id}', [adminController::class, 'doc_subind_dos']);