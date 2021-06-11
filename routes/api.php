<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('usuarios', "UsuariosController"); //CreateAcount, Todos los Usuarios, (ver usuarios por username)
Route::resource('login', "LoginController");       //login
Route::resource('/token', "usuariosporTokenController"); //Ver el usuario logueado
Route::resource('/UserImage', "ImagenUsuarioController"); //Ingresar la imagen del usuario
Route::resource('/Publication', "PublicationController"); //ver y crear publicaciones, ver las del usuario logueado
Route::resource('/otrapublication', "OtraPublicacionController"); //listar las publicaciones en el perfil de otro usuario
Route::resource('/likes', "LikesController"); //agregar y quitar likes
Route::resource('/seguidores', "SeguidoresController"); //agregar y quitar seguidores
Route::resource('/seguidos', "SeguidosController"); //agregar y quitar seguidores





//Route::put('')