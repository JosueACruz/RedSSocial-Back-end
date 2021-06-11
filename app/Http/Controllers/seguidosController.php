<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\publucation;
use App\Usuarios;
use Illuminate\Support\Arr;

class seguidosController extends Controller
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
        //
        //ver mis seguidores
        $username = $request -> get('username');
        $usuarios = Usuarios::where('username', $username )
                    ->get(['_id', 'nombre', 'ImageProfile']);
        $idUsuario = Arr::get($usuarios[0], '_id'); //id
        $nombre = Arr::get($usuarios[0], 'nombre'); //nombre
        $ImageProfile = Arr::get($usuarios[0], 'ImageProfile');  //imagen

        $peticion = $request->input('peticion');
        if($peticion == 'cantSeguidos')
        {
            //Llamar la cantidad de seguidos
            $res = $this->cantSeguidos($idUsuario);
        }
        else if($peticion == 'cantSeguidores')
        {
            //llamar la cantidad de seguidores
            $res = $this->cantSeguidores($idUsuario);
        }
        else if($peticion == 'seguidos')
        {
            //llamar lista de seguidos
            $res = $this->seguidos1($idUsuario);
        }
        else if($peticion == 'seguidores')
        {
            //llamar lista de seguidores
            $res = $this->seguidores1($idUsuario);
        }
        return response()->json($res);
    }

    //Listar los seguidores
    function seguidos1($idUsuario)
    {
        $valSegui = Usuarios::where('_id', $idUsuario) //buscamos en mi usuario
                ->get(['seguidos.user']);
        
        $sg = Arr::get($valSegui[0], 'seguidos'); //este para ver los seguidores
        $cant = count($sg);                      //este para contarlos
        return $sg;
    }

    //Listar los seguidos
    function seguidores1($idUsuario)
    {
        $valSegui = Usuarios::where('_id', $idUsuario) //buscamos en mi usuario
                            ->get(['seguidores.user']);

        $sg = Arr::get($valSegui[0], 'seguidores'); //este para ver los seguidores
        $cant = count($sg);                      //este para contarlos
        return $sg;
    }

    //cantidad de seguidores
    function cantSeguidores($idUsuario)
    {
        $valSegui = Usuarios::where('_id', $idUsuario) //buscamos en mi usuario
                ->get(['seguidores.user']);
        
        $sg = Arr::get($valSegui[0], 'seguidores'); //este para ver los seguidores
        $cant = count($sg);                      //este para contarlos
        return $cant;
    }

    //cantidad de seguidos
    function cantSeguidos($idUsuario)
    {
        $valSegui = Usuarios::where('_id', $idUsuario) //buscamos en mi usuario
                ->get(['seguidos.user']);
        
        $sg = Arr::get($valSegui[0], 'seguidos'); //este para ver los seguidores
        $cant = count($sg);                      //este para contarlos
        return $cant;
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
