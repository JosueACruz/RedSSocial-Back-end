<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImagenUsuarioController extends Controller
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
        //Aqui intentare enviar la imagen a un usuario ya creado
        //Aqui paso de la carpeta temporal donde se guardan las imagenes a la carpeta /storage/app
        //$imagen = $request -> file('ImageProfile')->store('public/userImages');
        //$url = Storage::url($imagen); //Con esto cambiamos la direccion que se enviara a la BD de (/public) a (/Storage) para verla despues
        //return $url;
        //$usuarios = Usuarios::find($id);
        //$usuarios->update($request->all());
        //return ('Usuario actualizado');
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
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token)
    {
//        dd($request->file('image'));
        //
        //Aqui intentare enviar la imagen a un usuario ya creado
        //Aqui paso de la carpeta temporal donde se guardan las imagenes a la carpeta /storage/app
        $imagen = $request -> File('Image')->store('public/userImages');
        $url = Storage::url($imagen); //Con esto cambiamos la direccion que se enviara a la BD de (/public) a (/Storage) para verla despues
        $ale = array(
            "ImageProfile" => $url 
        );
        $usuarios=Usuarios::where("token",$token)
            ->update($ale);
        return response()->json(['message'=>$url]);
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
