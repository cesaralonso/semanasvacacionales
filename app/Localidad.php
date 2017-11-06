<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    /**
     * Finds all Localidades by HTTP Request
     * Method: GET 
     * URI: http://0.0.0.0:3000/api/localidades
     */
     public static function allLocalidades($client)
     {
        return $client->request('GET', 'localidades', [
            'headers' => [
                'Accept'  => 'application/json'
            ]
        ]);
     }
    /**
     * Finds all Localidades related to a Pais by HTTP Request
     * Method: GET 
     * URI: http://0.0.0.0:3000/api/localidades
     */
     public static function findByPais($client, $paisId)
     {
        return $client->request('GET', 'localidades/findLocalidades/'. $paisId, [
            'headers' => [
                'Accept'  => 'application/json'
            ]
        ]);
     }
}
