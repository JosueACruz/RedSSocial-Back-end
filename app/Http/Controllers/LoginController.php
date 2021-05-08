<?php

namespace App\Http\Controllers;

use App\Usuarios;               //Que use el modelo Usuarios
use Illuminate\Http\Request;
use Illuminate\Support\Str;     //Esto es para generar un string aleatorio como token

class LoginController extends Controller
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
        $response = "";
        //Extraemos los datos de la peticion (Enviados por el front)
        $username = $request->input('username');
        $pass = $request->input('pass');
        //Buscamos el Usuario en la Base de datos
        $usuario = Usuarios::where('username', $username)
                        ->where('pass', $pass)
                        ->get();
        if($usuario->isEmpty()){
            $res = 'NO existe el usuario';
        }
        else if($usuario->isNotEmpty()){
            //Si el usuario existe creamos el token y lo pasamos a un array
            $token = Str::random(80);
            $tok = [
                'token' => $token
            ];
            //Ingresamos el token en la base de datos
            $user = Usuarios::where('username', $username)
                    ->where('pass', $pass)
                    ->update($tok,['upsert' => true]);
            //Devolvemos el token al front
            $res = $tok;
        }
        return response()->json($res);
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
