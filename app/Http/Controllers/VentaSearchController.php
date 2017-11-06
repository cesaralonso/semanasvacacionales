<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Membresia;

class VentaSearchController extends Controller
{

    public function show($titulo, $init, $final)
    {   
        $filter = 'ventas';
        $title = 'venta';
        if( $init <= 0) $init = 0;
        if( $init >= $final )
            return Redirect::to('/');
        // Get count of membresias, filtered by venta = true
        $pagination = $final - $init ; // Number of membresias displayed in each pagination
        try {
            $response = Membresia::count(getClient(), 'where[venta]=true&where[renta]=false');
        }  catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ha ocurrido un error, por favor, intente de nuevo.');
            return view('home.index');
        }
        $count = json_decode($response->getBody()->getContents())->count;
        if ($count == 1) {
            $init = 0;
            $final = 1;
        }
        $paginationNumber = $count / $pagination; // Number of pages
        
        try {
            $response = Membresia::getByFilter(getClient(), '[limit]='.$pagination.'&filter[skip]='.$init.'&filter[where][venta]=true&filter[where][renta]=false');
        }  catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ha ocurrido un error, por favor, intente de nuevo.');
            return view('home.index');
        }

        $membresias = json_decode($response->getBody()->getContents());
        return view('busqueda-filtro', compact(['title','membresias', 'paginationNumber', 'pagination', 'count', 'init', 'final', 'filter']));
    }
}
