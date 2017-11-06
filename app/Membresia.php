<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{

    /**
     * Store a new Membresia by HTTP Request 
     * Method: POST
     * URI: http://0.0.0.0:3000/api/Membresia 
     */
    public static function storeMembresia($client, $request, $idPerson, $ACCESS_TOKEN)
    {
        return $client->request('POST', 'Membresia', [
            'form_params' => [
                'titulo'                => $request->titulo,
                'title'                 => $request->title,
                'clubNombre'            => $request->clubNombre,
                'clubUrl'               => $request->clubUrl,
                'semanaTipo'            => $request->semanaTipo,
                'descripcion'           => $request->descripcion,
                'description'           => $request->description,
                'sala'                  => isset($request->sala),
                'dormitorios'           => $request->dormitorios,
                'lockOff'               => isset($request->lockOff),
                'tipoInmueble'          => $request->tipoInmueble,
                'banosCompletos'        => $request->banosCompletos,
                'banosMedios'           => $request->banosMedios,
                'tipoCocina'            => $request->tipoCocina,
                'maxOcupantes'          => $request->maxOcupantes,
                'maxPrivacidad'         => $request->maxPrivacidad,
                'frecSemanasPorAnio'    => $request->frecSemanasPorAnio,
                'frecCadaAnios'         => $request->frecCadaAnios,
                'compraFecha'           => $request->compraFecha,
                'ocultarFecha'          => isset($request->ocultarFecha),
                'compraCaduca'          => isset($request->compraCaduca),
                'compraCaducidad'       => $request->compraCaducidad,
                'mantenimiento'         => isset($request->mantenimiento),
                'mantenimientoImporte'  => $request->mantenimientoImporte,
                'mantenimientoMoneda'   => $request->mantenimientoMoneda,
                'venta'                 => isset($request->venta),
                'ventaPrecio'           => $request->ventaPrecio,
                'ventaMoneda'           => $request->ventaMoneda,
                'ventaNegociable'       => isset($request->ventaNegociable),
                'ventaOcultarImporte'   => isset($request->ventaOcultarImporte),
                'renta'                 => isset($request->renta),
                'rentaPrecio'           => $request->rentaPrecio,
                'rentaMoneda'           => $request->rentaMoneda,
                'rentaNegociable'       => isset($request->rentaNegociable),
                'status'                => $request->status,
                'telContacto'           => $request->telContacto,
                'cualSemanaFija'        => $request->cualSemanaFija,
                'cuantosPuntos'         => $request->cuantosPuntos,
                'cuantasNoches'         => $request->cuantasNoches,
                'cualTemporadaflotante' => $request->cualTemporadaflotante,
                'updated'               => $request->updated,
                'created'               => $request->created,
                'ubicadoEn'             => $request->ubicadoEn,
                'metodoPago'            => $request->metodoPago,
                'numCamas'              => $request->numCamas,
                'localidadNombre'       => $request->localidadNombre,
                'paisNombre'            => $request->paisNombre,
                'idPais'                => $request->idPais,
                'enlace_url'            => $request->enlace_url,
                'idPerson'              => $idPerson,
                
            ],
            'headers' => [
                'Authorization' => $ACCESS_TOKEN
            ]
        ]);
    }

     /**
     * Updates a specific Membresia by HTTP Request 
     * Method: PUT
     * URI: http://0.0.0.0:3000/api/Membresia/{id}
     */
    public static function edit($client, $request, $idPerson, $ACCESS_TOKEN)
    {
        return $client->request('PUT', 'Membresia/'.$request->membresiaId, [
            'form_params' => [
                'titulo'                => $request->titulo,
                'title'                 => $request->title,
                'clubNombre'            => $request->clubNombre,
                'clubUrl'               => $request->clubUrl,
                'semanaTipo'            => $request->semanaTipo,
                'descripcion'           => $request->descripcion,
                'description'           => $request->description,
                'sala'                  => isset($request->sala),
                'dormitorios'           => $request->dormitorios,
                'lockOff'               => isset($request->lockOff),
                'tipoInmueble'          => $request->tipoInmueble,
                'banosCompletos'        => $request->banosCompletos,
                'banosMedios'           => $request->banosMedios,
                'tipoCocina'            => $request->tipoCocina,
                'maxOcupantes'          => $request->maxOcupantes,
                'maxPrivacidad'         => $request->maxPrivacidad,
                'frecSemanasPorAnio'    => $request->frecSemanasPorAnio,
                'frecCadaAnios'         => $request->frecCadaAnios,
                'compraFecha'           => $request->compraFecha,
                'ocultarFecha'          => isset($request->ocultarFecha),
                'compraCaduca'          => isset($request->compraCaduca),
                'compraCaducidad'       => $request->compraCaducidad,
                'mantenimiento'         => isset($request->mantenimiento),
                'mantenimientoImporte'  => $request->mantenimientoImporte,
                'mantenimientoMoneda'   => $request->mantenimientoMoneda,
                'venta'                 => isset($request->venta),
                'ventaPrecio'           => $request->ventaPrecio,
                'ventaMoneda'           => $request->ventaMoneda,
                'ventaNegociable'       => isset($request->ventaNegociable),
                'ventaOcultarImporte'   => isset($request->ventaOcultarImporte),
                'renta'                 => isset($request->renta),
                'rentaPrecio'           => $request->rentaPrecio,
                'rentaMoneda'           => $request->rentaMoneda,
                'rentaNegociable'       => isset($request->rentaNegociable),
                'status'                => $request->status,
                'telContacto'           => $request->telContacto,
                'cualSemanaFija'        => $request->cualSemanaFija,
                'cuantosPuntos'         => $request->cuantosPuntos,
                'cuantasNoches'         => $request->cuantasNoches,
                'cualTemporadaflotante' => $request->cualTemporadaflotante,
                'updated'               => $request->updated,
                'created'               => $request->created,
                'ubicadoEn'             => $request->ubicadoEn,
                'metodoPago'            => $request->metodoPago,
                'numCamas'              => $request->numCamas,
                'localidadNombre'       => $request->localidadNombre,
                'paisNombre'            => $request->paisNombre,
                'idPais'                => $request->idPais,
                'enlace_url'            => $request->enlace_url,
                'idPerson'              => $idPerson,
                
            ],
            'headers' => [
                'Authorization' => $ACCESS_TOKEN
            ]
        ]);
    }
     /**
     * Updates a specific Membresia by HTTP Request 
     * Method: PUT
     * URI: http://0.0.0.0:3000/api/Membresia/{id}
     */
    public static function storePaisNombre($client, $membresiaId, $paisNombre, $ACCESS_TOKEN)
    {
        return $client->request('PATCH', 'Membresia/'.$membresiaId, [
            'form_params' => [
                'paisNombre' => $paisNombre
            ],
            'headers' => [
                'Authorization' => $ACCESS_TOKEN
            ]
        ]);
    }

     /**
     * Get all Membresias by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/Membresia 
     */
    public static function getMembresias($client)
    {
        return $client->request('GET', 'Membresia', [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Get a single Membresias by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/Membresia/{id} 
     */
    public static function findById($client, $membresiaId)
    {
        return $client->request('GET', 'Membresia/'. $membresiaId, [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
    }
    /**
     * Send the route of an Image related to a Membresia by HTTP Request 
     * Method: POST
     * URI: http://0.0.0.0:3000/api/Membresia/{id}/imagenes
     */
    public static function setImage($client, $request, $ACCESS_TOKEN, $filename, $tipo, $description)
    {
        return $client->request('POST', 'Membresia/'. $request->membresiaId. '/imagenes', [
            'form_params' => [
                'src'         => $filename,
                'descripcion' => $description,
                'tipo'        => $tipo,
                'orden'       => 0,
                'principal'   => true,
            ],
            'headers' => [
                'Authorization' => $ACCESS_TOKEN,
                'Accept' => 'application/json'
            ]
        ]);
    }


     /**
     * Get all Membresias related to a tipoInmueble by HTTP Request 
     * Method: GET
     * URI: http://0.0.0.0:3000/api/Membresia/tipoInmueble/{tipoInmueble}
     */
     public static function getTipoInmueble($client, $tipoInmueble)
     {
         return $client->request('GET', 'Membresia/?filter[where][tipoInmueble]='. $tipoInmueble, [
             'headers' => [
                 'Accept' => 'application/json'
             ]
         ]);
     }

    /**
     * Create a disponibilidad related to a membresia by HTTP Request
     * Method: POST 
     * URI: http://0.0.0.0:3000/api/Membresia/{id}/disponibilidades
     */
     public static function createDisponibilidad($client, $idMembresia, $entrada, $salida, $libre)
     {
        return $client->request('POST', 'Membresia/'. $idMembresia. '/disponibilidades', [
            'form_params' => [
                'entrada'  => $entrada,
                'salida'   => $salida,
                'libre'    => $libre
            ],
            'header' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
    /**
     * Get all disponibilidades related to a membresia by HTTP Request
     * Method: POST 
     * URI: http://0.0.0.0:3000/api/Membresia/{id}/disponibilidades
     */
     public static function allDisponibilidades($client, $idMembresia)
     {
        return $client->request('GET', 'Membresia/'. $idMembresia. '/disponibilidades', [
            'header' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
    /**
     * Get all amenidades by HTTP Request
     * Method: POST 
     * URI: http://0.0.0.0:3000/api/amenidades
     */
     public static function allAmenidades($client)
     {
        return $client->request('GET', 'amenidades', [
            'header' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
     ///Membresia/{id}/amenidades
    /**
     * Get all amenidades related to a membresia by HTTP Request
     * Method: POST 
     * URI: http://0.0.0.0:3000/api/Membresia/{id}/amenidades
     */
     public static function allAmenidadesByMembresia($client, $membresiaId)
     {
        return $client->request('GET', 'Membresia/'. $membresiaId.'/amenidades', [
            'header' => [
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * Get all correos related to a Membresia by HTTP Request
     * Method: GET 
     * URI: http://0.0.0.0:3000/api/People/{id}/correos
     */
     public static function getCorreos($client, $membresiaId)
     {
        return $client->request('GET', 'Membresia/'. $membresiaId .'/correos?filter[include]=remitente&filter[include][membresia]=imagenes', [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
    /**
     * Get all membresias related to a Membresia by some properties HTTP Request
     * Method: GET 
     * URI: http://0.0.0.0:3000/api/People/{id}/correos
     */
     // http://0.0.0.0:3000/api/Membresia?filter[where][paisNombre][like]=M%C3%A9xico&filter[where][renta]=true&filter[where][venta]=false&filter[where][ubicadoEn]=NIEVE
     public static function getMembresiasRelacionadas($client, $paisNombre, $renta, $venta, $ubicadoEn)
     {
        return $client->request('GET', 'Membresia/?filter[where][paisNombre][like]='. $paisNombre .'&filter[where][renta]='.$renta.'&filter[where][venta]='.$venta.'&filter[where][ubicadoEn]='.$ubicadoEn, [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
    }
    /**
     * Get all membresias related to a Membresia by some properties HTTP Request
     * Method: GET 
     */
     // $filter variable example: [where][localidadNombre]=value
     public static function getByFilter($client, $filter)
     {
        return $client->request('GET', 'Membresia/?filter'.$filter, [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
    /**
     * Count Membresia with filter by some properties HTTP Request
     * Method: GET 
     */
     // $filter variable example: where[renta]=true
     public static function count($client, $filter)
     {
        return $client->request('GET', 'Membresia/count?'.$filter, [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
    /**
     * Get count Images from a Membresia by HTTP Request
     * Method: GET 
     */
     public static function countImages($client, $membresiaId)
     {
        return $client->request('GET', 'Membresia/'.$membresiaId.'/imagenes/count', [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
     }
}
