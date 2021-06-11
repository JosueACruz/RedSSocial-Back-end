<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use Jenssegers\Mongodb\Auth\Usarios as Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Usuarios extends Eloquent
{
    //el nombre de la colleccionq que queremos usar
    protected $connection = 'mongodb';
    protected $collection = 'usuarios';
    
    //Estos son los campos que estaran dentrod de la coleccion
    protected $fillable = [
        'nombre', 'username','pass','email','webSite','desc', 'token', 'ImageProfile', 'Publication', 'seguidos','seguidores' 
    ];
}
