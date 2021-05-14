<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = Usuarios::all();
        return compact('usuarios');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('usuariocreate');
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = Str::random(80);
        //Instanceamos la clase Usuarios (de nuestro modelo)
        $usuarios = new Usuarios();
        $usuarios -> nombre = $request->input('nombre');
        $usuarios -> username = $request->input('username');
        $usuarios -> pass = $request->input('pass');
        $usuarios -> email = $request->input('email');
        $usuarios -> token = $token;
        $tok = [
            'token' => $token
        ];
        $usuarios -> save();
        return response()->json($token);
//        return('usuario')->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Usuarios::find($id);
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
        $usuarios = Usuarios::findOrFail($id);
        return compact('usuarios');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token)
    {
        //
        //$imagen = $request -> File('Image')->store('public/userImages');
        //$url = Storage::url($imagen); //Con esto cambiamos la direccion que se enviara a la BD de (/public) a (/Storage) para verla despues
        $ale = array(
            "nombre"=>$request->input('nombre'),
            "username"=>$request->input('username'),
            "pass"=>$request->input('pass'),
            "email"=>$request->input('email'),
            "webSite"=>$request->input('webSite'),
            "desc"=>$request->input('desc')
            //"ImageProfile" => $url 
        );
        $usuarios=Usuarios::where("token",$token)      
            ->update($ale);
        return response()->json(['message'=>'Usuario Actualizado',$ale]);

        

        /**$usuarios -> nombre = $request->get('nombre');
        $usuarios -> username = $request->get('username');
        $usuarios -> pass = $request->get('pass');
        $usuarios->save(); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Este ya funciona para eliminar un Usuario
    public function destroy($id)
    {
        //
        Usuarios::destroy($id);
        return ('Destroy Id');
    }
}
