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
        //numero de likes
        $publ = Publication::where('_id', '60c042f8b20b000062005033')
                ->get(["likes"]);
        $lk = Arr::get($publ[0], 'likes');
        $cant = count($lk);
        return response() -> json($cant);
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
        $idPublicacion = $request -> get('idPublicacion');
        //$let = 'likes.'+$username;
        $publ = Publication::where('_id', $idPublicacion)
                ->where("likes.username", $username)
                ->get(["likes.username"]);
        //Validamos si es un like o dislike
        if($publ->isEmpty())
        {
            //Si aparece vacio significa que el usuario no ha dado un like a esa publlicacion
            //Insertamos el nuevo like
            $like = array (
                "username" => $username
            );

            $publicacion = Publication::where('_id', $idPublicacion)
                        ->push('likes', $like, true);
            $res = ['message' => 'Like agregado', $publicacion];
    //        return response() -> json(['message' => 'Like agregado', $publicacion]);
        }
        else if($publ->isNotEmpty())
        {
            //Si tiene datos significa que el usuario ya ha dado like a esa publicacion y quiere dar un dislike
            $like = array (
                "username" => $username
            );

            $publicacion = Publication::where('_id', $idPublicacion)
                        ->pull('likes', $like, true);
            $res = ['message' => 'Like eliminado', $publicacion];
        }
        return response() -> json($res);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy($request)
    {
        //
    }
}
