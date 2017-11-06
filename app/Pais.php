<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    /**
     * Finds all Paises by HTTP Request
     * Method: GET 
     * URI: http://0.0.0.0:3000/api/paises
     */
     public static function allPaises($client)
     {
        return $client->request('GET', 'paises', [
            'headers' => [
                'Accept'  => 'application/json'
            ]
        ]);
     }
    /**
     * Finds a specific Pais by HTTP Request
     * Method: GET 
     * URI: http://0.0.0.0:3000/api/paises/{id}
     */
     public static function findById($client, $paisId)
     {
        return $client->request('GET', 'paises/'.$paisId, [
            'headers' => [
                'Accept'  => 'application/json'
            ]
        ]);
     }
}
