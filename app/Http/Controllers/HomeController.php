<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pais;
use App\Unidad;
use App\Ubicado;
use App\Promocion;
use App\Destacado;
use App\Membresia;

class HomeController extends Controller
{
    /**
     * Display a listing of Membresias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membresias =[];
        $membresiasInmueble =[];
        $destacados =[];
        $paises =[];
        try {
            // Get all membresias
            $responseMembresias = Membresia::getMembresias(getClient());
            // Get membresias related to tipoInmueble = CABANA
            $responseInmueble = Membresia::getTipoInmueble(getClient(), ('CABANA'));
            // Get destacados
            $responseDestacados = Destacado::getAll(getClient());
            // Get all paises
            $responsePaises = Pais::allPaises(getClient());

            $responsePromocionLimit = Promocion::getAllLimit(getClient(), 1);
            
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to home page
            return view('home.index');
        }
        
        // Get the response body from HTTP Request and parse to Object
        $membresias = json_decode($responseMembresias->getBody()->getContents());
        // Get the response body from HTTP Request and parse to Object
        $membresiasInmueble = json_decode($responseInmueble->getBody()->getContents());
        // Get the response body from HTTP Request and parse to Object
        $destacados = json_decode($responseDestacados->getBody()->getContents());
        // Get the response body from HTTP Request and parse to Object
        $paises = json_decode($responsePaises->getBody()->getContents());
        // Get the response body from HTTP Request and parse to Object
        $promocionDestacada = json_decode($responsePromocionLimit->getBody()->getContents());
        // return var_dump($promocionDestacada);
        
        // Return to home view with the Object: $membresias
        return view('home.index', compact(['membresias', 'membresiasInmueble', 'destacados', 'paises', 'promocionDestacada']));
    }

    public function search(Request $request)
    {

        try {

            // Get all paises
            $responsePaises = Pais::allPaises(getClient());

            // Al ubicado
            $responseUbicado = Ubicado::getAll(getClient());
            
            // Al tipo de inmueble
            $responseUnidades = Unidad::getAll(getClient());
            
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to home page
            return view('home.index');
        }
 
        
        $search = [];
        $search['pais'] = $request->paisbusqueda;
        $search['rentaventa'] = $request->rentaventa;
        $search['huespedes'] = $request->huespedes;
        
        $paises = json_decode($responsePaises->getBody()->getContents());
        $paises = makeAsocArray($paises, 'id', 'nombre');

        $ubicaciones = json_decode($responseUbicado->getBody()->getContents());
        $unidades = json_decode($responseUnidades->getBody()->getContents());
        // return var_dump($search);
        return view('busqueda2', compact(['search', 'paises', 'ubicaciones', 'unidades']));

    }

}
