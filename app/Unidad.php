<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    /**
     * Get all Unidades by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/Unidades
     */
     public static function getAll($client)
     {
         return $client->request('GET', 'Unidades', [
             'headers' => [
                 'Accept' => 'application/json'
             ]
         ]);
     }
}
