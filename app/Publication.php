<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Publication extends Eloquent
{
    //
    //el nombre de la colleccionq que queremos usar
    protected $connection = 'mongodb';
    protected $collection = 'publications';
    
    //Estos son los campos que estaran dentrod de la coleccion
    protected $fillable = [
        'title', 'description', 'image', 'likes','userID', 'username','ImageProfile', 'likes'
    ];
}
