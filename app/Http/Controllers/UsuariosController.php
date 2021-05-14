<?php

namespace App\Http\Controllers;

use App\Usuarios;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

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
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        //Aqui hacemos un get de un usuario especifico por medio del token en la url
        $usuarios = Usuarios::where('username', $username )
                            ->get();
        return response()->json($usuarios);
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
        $imagen = $request -> File('Image')->store('public/userImages');
        $url = Storage::url($imagen); //Con esto cambiamos la direccion que se enviara a la BD de (/public) a (/Storage) para verla despues

        //buscamos los datos de la bd primero
        $usuariosBD = Usuarios::where('token', $token )
                        ->get();
        $userID = Arr::get($usuariosBD[0], '_id');
        //inicializamos las variables
        $nombre = "";
        $username = "";
        $pass = "";
        $email = "";
        $webSite = "";
        $desc = "";
        $imagenurl = "";
        //validacion de los campos
        if($request->input('nombre') == "undefined"){
            $nombre = Arr::get($usuariosBD[0], 'nombre');
        }else{
            $nombre = $request->input('nombre');
        }
        if($request->input('username') == "undefined" ){
            $username = Arr::get($usuariosBD[0], 'username');
        }else{
            $username = $request->input('username');
        }
        if($request->input('pass') == "undefined" ){
            $pass = Arr::get($usuariosBD[0], 'pass');
        }else{
            $pass = $request->input('pass');
        }
        if($request->input('email') == "undefined"){
            $email = Arr::get($usuariosBD[0], 'email');
        }else{
            $email = $request->input('email');
        }
        if($request->input('webSite') == "undefined")
        {
            $webSite = Arr::get($usuariosBD[0], 'webSite');
        }else{
            $webSite = $request->input('webSite');
        }
        if($request->input('desc') == "undefined"){
            $desc = Arr::get($usuariosBD[0], 'desc');
        }else{
            $desc = $request->input('desc');
        }
        if($url == ""){
            $imagenurl = Arr::get($usuariosBD[0], 'ImageProfile');
        }else{
            $imagenurl = $url;
        }
        $ale = array(
            "nombre"=>$nombre,
            "username"=>$username,
            "pass"=>$pass,
            "email"=>$email,
            "webSite"=>$webSite,
            "desc"=>$desc,
            "ImageProfile" => $imagenurl 
        );
        $usuarios=Usuarios::where("token",$token)      
            ->update($ale);
        
        $publ = array(
            "username"=>$username,
            "ImageProfile"=>$imagenurl
        );
        $publicacion=Publication::where("userID",$userID)
            ->update($publ);
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
