<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicado extends Model
{
    /**
     * Get all Ubicados by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/Ubicados
     */
     public static function getAll($client)
     {
         return $client->request('GET', 'Ubicados', [
             'headers' => [
                 'Accept' => 'application/json'
             ]
         ]);
     }
}
