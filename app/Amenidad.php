<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenidad extends Model
{
    /**
     * Get all amenidades by HTTP Request
     * Method: POST 
     * URI: http://0.0.0.0:3000/api/amenidades
     */
     public static function all($client)
     {
        return $client->request('GET', 'amenidades', [
            'header' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
}
