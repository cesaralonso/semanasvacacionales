<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use URL;
use App\Pais;
use App\User;
use Exception;
use App\Membresia;
use App\Localidad;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class UserController extends Controller
{
    /**
     * Show the view to edit User information
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
        
        // Get the instance to make HTTP Requests        
        $client = getClient();

        try {
            
            $response = User::getUserInformation($client, Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));
            $responsePaises = Pais::allPaises($client);
            // $responseLocalidades = Localidad::findByPais(getClient(), $membresia->pais);
        } catch (RequestException $e) {
            // In something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return view('user.edit'); 
        }


        
        // Get the response body from HTTP Request and parse to Object        
        $user = json_decode($response->getBody()->getContents());
        $paises = json_decode($responsePaises->getBody()->getContents());
        
        // Make an associative array of paises and localidades to put them into select tag paises and localidades
        $paises = makeAsocArray($paises, 'id', 'nombre');
        
        if (isset($user->pais)) {
            try {
                $responseLocalidades = Localidad::findByPais(getClient(), $user->pais);
            } catch (RequestException $e) {

            }

            $localidades = json_decode($responseLocalidades->getBody()->getContents());

            $localidades = makeAsocArray($localidades, 'nombre', 'nombre');
        }
            

        return view('user.edit', compact(['user', 'paises', 'localidades']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');

        // Get the instance to make HTTP Requests        
        $client = getClient();

        try {
            $response = User::edit($client, $request, Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));
        } catch (RequestException $e) {
            // If something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return view('user.edit'); 
        }

         // Get the response body from HTTP Request and parse to Object        
        return Redirect::back()->with('message','Cambios guardados correctamente!');

    }

    public function editPassword()
    {   
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
        return view('user.edit-password');
    }

    public function updatePassword(Request $request)
    {

        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');

        try {
            $response = User::changePassword(getClient(), $request, Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));
        } catch (RequestException $e) {
            
            $statusCode =  $e->getResponse()->getStatusCode();

            if($statusCode == 400) {
                // In something went wrong it will redirect to home page
                session()->flash('error', 'Por favor, verifique que su contraseña actual es la correcta');
                return Redirect::to('/cambiar-contrasena' . "#inicia");
            } else {
                echo Psr7\str($e->getResponse());
            }
            
        }

        session()->flash('message', 'Su contraseña ha sido cambiada');
        // return redirect()->home();
        return Redirect::back();
        

    }

    public function showMembresias()
    {
        // Verify route
        if ( (!Session::has('ACCESS_TOKEN')) )
            return Redirect::to('/');
        // Get the instance to make HTTP Requests        
        $client = getClient();

        try {
            $response = User::getUserMembresias($client, Session::get('ACCESS_TOKEN'), Session::get('USER_ID'));
        } catch (RequestExeption $e) {
            // If something went wrong it will redirect to /mi-cuenta
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::to('/mi-cuenta');
        }

        // Get the response body from HTTP Request and parse to Object        
        $membresias = json_decode($response->getBody()->getContents());

        return view('user.membresias', compact('membresias'));
    }

    public function showFavoritos()
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
        try {
            $response = User::getMembresiasFavoritas(getClient(), Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));
        } catch (RequestExeption $e) {
            // If something went wrong it will redirect to /mi-cuenta
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::to('/mi-cuenta');
        }
        $membresias = json_decode($response->getBody()->getContents());
        // return var_dump($membresias[0]->membresia->id);
        return view('user.mis-favoritos', compact('membresias'));
    }

    public function storeMessage(Request $request)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');

        try {
            $response = User::postMessage(getClient(), $request, Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));
        } catch (RequestException $e) {
            
            $statusCode =  $e->getResponse()->getStatusCode();

            if($statusCode == 400) {
                // In something went wrong it will redirect to home page
                session()->flash('error', 'Ocurrio un problema al enviar el comentario, por favor intentelo más tarde.');
                return Redirect::to(URL::previous() . "#comments");
            } else {
                echo Psr7\str($e->getResponse());
            }
            
        }

        session()->flash('message', '¡Se ha enviado el comentario!');
        return Redirect::to(URL::previous() . "#comments");
    }

    public function correos()
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
    
        try {
            $response = User::getCorreos(getClient(), Session::get('USER_ID'));

        } catch (RequestExeption $e) {
            // If something went wrong it will redirect to /mi-cuenta
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::to('/mi-cuenta');
        }

        $correos = json_decode($response->getBody()->getContents());
        
        $membresias = []; // Contains all membresias without repeting
        $numMensajes = []; // Contains the number of messages of each membresia (this array is parallel to $membresias)
        foreach ($correos as $key => $correo) {
            if ( self::existOnArray($membresias, $correo->membresia) ) {
                $numMensajes[self::getIndexMembresia($correo->membresia->id, $membresias)] += 1; 
            } else {
                $membresias[] = $correo->membresia;
                $numMensajes[] += 1; 
            }
        }
        return view('user.mis-mensajes', compact(['membresias', 'numMensajes']));
    }

    public function membresiaMensajes($id)
    {
        try {
            $response = Membresia::getCorreos(getClient(), $id);
        } catch (RequestExeption $e) {
            // If something went wrong it will redirect to /mi-cuenta
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::to('/mi-cuenta');
        }

        $correos = json_decode($response->getBody()->getContents());
        $correos = array_reverse($correos);
        // return var_dump($correos);
        return view('user.membresia-mensajes', compact('correos'));
    }

    private function existOnArray($membresias, $membresiaToSearch)
    {
        foreach ($membresias as $membresia) 
            if( $membresia->id == $membresiaToSearch->id )
                return true;
        return false;
    }

    private function getIndexMembresia($id, $membresias)
    {
        foreach ($membresias as $key => $membresia) 
            if ($membresia->id == $id)
                return $key;
        return -1;
    }

}
