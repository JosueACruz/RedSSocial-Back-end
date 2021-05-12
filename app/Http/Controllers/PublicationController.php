<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

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
        //
        //$usuario = Usuarios::get('Publication')->toArray();
        //return $usuario;
        //$usuarios = Usuarios::where('usuarios.publication', true)
        //            ->get('publication');
        //return $usuarios;
        $usuarios = Usuarios::where('publication','exists', true)
                    ->get();
        
    return $usuarios;
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
        //Primero extraemos el login del usuario que ha iniciado sesion
        $tokenUser = $request->get('token');
        //Creamos un array con los datos de la publicacion
        $Publication = array(
            "name"=>$request->get('title'),
            "description"=>$request->get('description'),
        );
        //Insertamos la publicacion dentro de la base de datos
        $usuario = Usuarios::where('token', $tokenUser)
                    ->push('publication', $Publication);
        return ('Publicacion creada');
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        //
        $usuario = Usuarios::where('token', $token)
                    ->get('publication')->toArray();
        return response()->json_encode($usuario);
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
