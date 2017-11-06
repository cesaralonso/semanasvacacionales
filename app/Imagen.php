<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    /**
     * Saves the images by HTTP Request
     * Method: POST 
     * URI: http://aidihosting.com/proyectos/tiempocompartido_api/api/v1/uploadImagen/:membresiaId
     */
     public static function setImages($client, $images, $membresiaId)
     {
        return $client->request('POST', 'http://aidihosting.com/proyectos/tiempocompartido_api/api/v1/uploadImagen/'.$membresiaId, [
            // 'headers' => [
            //     'Content-Type'  => 'multipart/form-data'
            // ],
            'multipart' => [
                [
                    'name'     => 'images',
                    // 'contents' => $images[0],
                    'contents' => fopen($images[0], 'r')
                ]
            ]
        ]);
     }
}
