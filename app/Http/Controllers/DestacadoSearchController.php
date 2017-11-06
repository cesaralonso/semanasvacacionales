<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Destacado;

class DestacadoSearchController extends Controller
{
    public function show($titulo, $init, $final)
    {   
        $filter = 'recomendados';
        if( $init <= 0) $init = 0;
        if( $init >= $final )
            return Redirect::to('/');
        // Get count of membresias, filtered by venta = true
        $pagination = $final - $init ; // Number of membresias displayed in each pagination
        try {
            $response = Destacado::count(getClient());
        }  catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ha ocurrido un error, por favor, intente de nuevo.');
            return Redirect::to('/');
        }
        $count = json_decode($response->getBody()->getContents())->count;
        if ($count == 1) {
            $init = 0;
            $final = 1;
        }
        $paginationNumber = $count / $pagination; // Number of pages
        
        try {
            $response = Destacado::getByFilter(getClient(), '[limit]='.$pagination.'&filter[skip]='.$init.'&filter[include][membresia]=imagenes');
        }  catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ha ocurrido un error, por favor, intente de nuevo.');
            return  Redirect::to('/');
        }

        $destacados = json_decode($response->getBody()->getContents());
        return view('recomendados.index', compact(['recomendados', 'destacados', 'paginationNumber', 'pagination', 'count', 'init', 'final', 'filter']));
    }
}
