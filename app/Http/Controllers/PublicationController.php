<?php

namespace App\Http\Controllers;

use App\Usuarios;
use App\Publication;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //
    public function index()
    {
        $publications = Publication::all();
        return $publications;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Ingresar una nueva publicacion por el usuario
    public function store(Request $request)
    {
        $imagen = $request -> File('Image')->store('public/publicationsImages');
        $url = Storage::url($imagen);

        //Primero extraemos el login del usuario que ha iniciado sesion
        $tokenUser = $request->get('token');
        //Aqui hacemos un get de un usuario especifico por medio del token en la url
        $usuarios = Usuarios::where('token', $tokenUser )
                    ->get(['_id', 'username']);
        $idUsuario = Arr::get($usuarios[0], '_id');
        $username = Arr::get($usuarios[0], 'username');
        //Creamos un array con los datos de la publicacion
        $PublicArray = array(
            "title"=>$request->get('title'),
            "description"=>$request->get('description'),
            "image"=>$url,
            "userID"=>$idUsuario,
            "username"=>$username
        );
        $publicacion = Publication::create($PublicArray);
       // return ('Publicacion creada');
        return response()->json(['message'=>'Publicacion creada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {   
        //Este sirve para consultar las publicaciones del usuario que ha iniciado sesion
        //Aqui hacemos un get de un usuario especifico por medio del token en la url
        $usuarios = Usuarios::where('token', $token )
                    ->get()->pluck('_id')->toArray();
        $idUsuario = $usuarios[0];
        //lugo hacemos la peticion a la coleccion de las publicaciones
        $publicacion = Publication::where('userID', $idUsuario)
                    ->get();
        return $publicacion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
