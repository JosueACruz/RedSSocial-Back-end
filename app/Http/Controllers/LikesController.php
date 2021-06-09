<?php

//Este controlador sirve para agregar y quitar un like de una publicacion
namespace App\Http\Controllers;
use App\Publication;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //el request debe contener el token, 
        //y el id de la publicacion a la que se le da like
        //Extraemos los datos del usuario que ha dado like
        $token = $request->get('token');
        $usuarios = Usuarios::where('token', $token )
                    ->get(['_id', 'username','ImageProfile']);
        $idUsuario = Arr::get($usuarios[0], '_id');
        $username = Arr::get($usuarios[0], 'username');
        //Insertamos el nuevo like
        $like = array (
            "username" => $username
        );
        $idPublicacion = $request -> get('idPublicacion');
        $publicacion = Publication::where('_id', $idPublicacion)
                        ->push('likes', $like);
        return response() -> json(['message' => 'Like agregado', $publicacion]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
