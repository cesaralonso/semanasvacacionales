<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    /**
     * Get all Promociones by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/promociones
     */
     public static function getAll($client)
     {
        return $client->request('GET', 'promociones', [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
     }
    /**
     * Get all Promociones with filter limit by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/promociones
     */
     public static function getAllLimit($client, $limit)
     {
        return $client->request('GET', 'promociones?filter[limit]='. $limit, [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
     }

     /**
     * Get a single Promocion by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/promociones/{id}
     */
     public static function findById($client, $idPromocion)
     {
         return $client->request('GET', 'promociones/'. $idPromocion, [
             'headers' => [
                 'Accept' => 'application/json'
             ]
         ]);
     }
     /**
     * Store a Promocion by HTTP Request 
     * Method: POST
     * URI: http://0.0.0.0:3000/api/promociones
     */
     public static function create($client, $request)
     {
         return $client->request('POST', 'promociones', [
            'form_params' => [
                "titulo" => $request->titulo,
                "title" => $request->title,
                "descripcion" => $request->descripcion,
                "description" => $request->description,
            ],
            'headers' => [
                 'Accept' => 'application/json'
             ]
         ]);
     }
     /**
     * Edit a Promocion by HTTP Request 
     * Method: PUT
     * URI: http://0.0.0.0:3000/api/promociones
     */
     public static function edit($client, $request, $ACCESS_TOKEN)
     {
        return $client->request('PUT', 'promociones/'.$request->promocionId, [
            'form_params' => [
                'titulo'                => $request->titulo,
                'title'                 => $request->title,
                'descripcion'           => $request->descripcion,
                'description'           => $request->description,
            ],
            'headers' => [
                'Authorization' => $ACCESS_TOKEN
            ]
        ]);
     }

    /**
     * Send the route of an Image related to a Promocion by HTTP Request 
     * Method: POST
     * URI: http://0.0.0.0:3000/api/promociones/{id}/imagenes
     */
    public static function setImage($client, $request, $ACCESS_TOKEN, $filename, $tipo)
    {
        return $client->request('POST', 'promociones/'. $request->promocionId. '/imagenes', [
            'form_params' => [
                'src'         => $filename,
                'tipo'        => $tipo,
                'orden'       => 0,
                'principal'   => true,
                'descripcion' => 'No descrption'
            ],
            'headers' => [
                'Authorization' => $ACCESS_TOKEN,
                'Accept' => 'application/json'
            ]
        ]);
    }

}
