<?php

namespace App\Http\Controllers;

use Redirect;
use App\Membresia;
use Illuminate\Http\Request;

class RentaSearchController extends Controller
{
    public function show($titulo, $init, $final)
    {   
        $filter = 'rentas';
        $title = 'renta';
        if( $init <= 0) $init = 0;
        if( $init >= $final )
            return Redirect::to('/');
        // Get count of membresias, filtered by venta = true
        $pagination = $final - $init ; // Number of membresias displayed in each pagination
        try {
            $response = Membresia::count(getClient(), 'where[renta]=true&where[venta]=false');
        }  catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ha ocurrido un error, por favor, intente de nuevo.');
            return Redirect::to('/');
        }
        $count = json_decode($response->getBody()->getContents())->count;
        $paginationNumber = $count / $pagination; // Number of pages
        
        try {
            $response = Membresia::getByFilter(getClient(), '[limit]='.$pagination.'&filter[skip]='.$init.'&filter[where][renta]=true&filter[where][venta]=false');
        }  catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ha ocurrido un error, por favor, intente de nuevo.');
            return  Redirect::to('/');
        }

        $membresias = json_decode($response->getBody()->getContents());
        return view('busqueda-filtro', compact(['title','membresias', 'paginationNumber', 'pagination', 'count', 'init', 'final', 'filter']));
    }
}
