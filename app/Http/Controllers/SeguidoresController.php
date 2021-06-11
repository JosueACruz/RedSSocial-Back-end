<?php
//Servira para agregar y quitar seguidores
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\publucation;
use App\Usuarios;
use Illuminate\Support\Arr;

class SeguidoresController extends Controller
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
        //
        $token = $request -> get('token');
        $usuarios = Usuarios::where('token', $token )
                    ->get(['_id', 'username','ImageProfile']);
        $idUsuario = Arr::get($usuarios[0], '_id'); //id mio
        $username = Arr::get($usuarios[0], 'username'); //username mio
        $usernameSeguido = $request->get('usernameSeg'); //username del que quiero seguir

        $follow = array(
            "user" => $usernameSeguido  //persona a quien vamos a seguir
        );
        $followed = array(
            "user" => $username     //nosotros
        );

        //Consultamos a la base de datos si ya seguimos a este usuario
        $valSegui = Usuarios::where('username', $username) //buscamos en mi usuario
                ->where('seguidos.user', $usernameSeguido) //si seguimos al otro usuario
                ->get(['seguidos.user']);
        //Si la consulta no trae datos, significa que no lo sigo aun
        if($valSegui ->isEmpty()){
            //insertamos la persona que seguimos a mi usuario
            $usrpost = Usuarios::where('_id', $idUsuario)
                            ->push('seguidos', $follow);
            //Insertamos mi usuario a la los seguidores de la otra persona

            $usrpost2 = Usuarios::where('username', $usernameSeguido)
                            ->push('seguidores', $followed);

            $res = ['message' => 'Siguiento'];
        }
        else if($valSegui -> isNotEmpty()){
            $usrpost = Usuarios::where('_id', $idUsuario)
                            ->pull('seguidos', $follow);
            //Insertamos mi usuario a la los seguidores de la otra persona

            $usrpost2 = Usuarios::where('username', $usernameSeguido)
                            ->pull('seguidores', $followed);
            
            $res = ['message' => 'Dejando de seguir'];
        }
        return response() -> json($res);
    }   

    /**
     * Display the specified resource.
     *@param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $username)
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
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
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
