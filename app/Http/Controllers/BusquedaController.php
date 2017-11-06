<?php

namespace App\Http\Controllers;

use App\Pais;
use App\Unidad;
use App\Ubicado;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function index()
    {
        try {
            // Al paises
            $responsePaises = Pais::allPaises(getClient());
            
            // Al ubicado
            $responseUbicado = Ubicado::getAll(getClient());
            
            // Al tipo de inmueble
            $responseUnidades = Unidad::getAll(getClient());

        } catch (RequestException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error, por favor intente de nuevo');
            return Redirect::to('/');
        }

        $paises = json_decode($responsePaises->getBody()->getContents());
        $ubicaciones = json_decode($responseUbicado->getBody()->getContents());
        $unidades = json_decode($responseUnidades->getBody()->getContents());

        return view('busqueda2', compact(['paises', 'ubicaciones', 'unidades']));

    }
}
