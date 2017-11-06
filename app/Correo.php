<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    /**
     * Store a Correo by HTTP Request 
     * Method: POST
     * URI: http://0.0.0.0:3000/api/Correos
     */
     public static function create($client, $request, $remitenteId, $destinatarioId, $membresiaId)
     {
         return $client->request('POST', 'correos', [
            'form_params' => [
                "nombreRemitente" => $request->nombre,
                "cuerpo" => $request->cuerpo,
                "remitenteId" => $remitenteId,
                "destinatarioId" => $destinatarioId,
                "membresiaId" => $membresiaId,
            ],
            'headers' => [
                 'Accept' => 'application/json'
             ]
         ]);
     }
}
