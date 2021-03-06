<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destacado extends Model
{
    /**
     * Store a Destacado by HTTP Request 
     * Method: POST
     * URI: http://0.0.0.0:3000/api/destacados
     */
    public static function create($client, $request)
    {
        return $client->request('POST', 'destacados', [
           'form_params' => [
               "entrada" => $request->entrada,
               "salida" => $request->salida,
               "idMembresia" => $request->membresiaId,
           ],
           'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
    }
    /**
     * Get all Destacados by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/Destacados
     */
     public static function getAll($client)
     {
        return $client->request('GET', 'Destacados?filter[include][membresia]=imagenes', [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
     }
    /**
     * Get Count for Destacados by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/Destacados
     */
     public static function count($client)
     {
        return $client->request('GET', 'Destacados/count', [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
     }
    /**
     * Get all Destacados with filter by HTTP Request
     * Method: GET 
     * URI: http://0.0.0.0:3000/api/People/{id}/correos
     */
     // $filter variable example: [where][localidadNombre]=value
     public static function getByFilter($client, $filter)
     {
        return $client->request('GET', 'Destacados/?filter'.$filter, [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }

}
