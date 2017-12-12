<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\User;
use App\Promocion;
use App\Destacado;
use App\Membresia;
use Illuminate\Http\Request;

class SuperUserController extends Controller
{
    function index()
    {
        // Verify route
        if (!(Session::has('USER_ID')))
            return Redirect::to('/');
        try {
            $responsePromocion = Promocion::getAll(getClient());
        } catch (RequestException $e) {
            return view('super-user.index');
        }

        try {
            $responseRecomendado = Destacado::getByFilter(getClient(), '[include][membresia]=imagenes');
        } catch (RequestException $e) {
            return view('super-user.index');
        }

        $promociones = json_decode($responsePromocion->getBody()->getContents());
        $recomendados = json_decode($responseRecomendado->getBody()->getContents());
        return view('super-user.index', compact(['promociones', 'recomendados']));
    }

    function create()
    {
        return view('super-user.login');
    }

    function store(Request $request)
    {
        // Validation form from server side
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        try {
            $response = User::logUser(getClient(), $request);
        } catch (RequestException $e) {

            $response = $e->getResponse();
            $responseBodyAsJSON = json_decode($response->getBody()->getContents());
            
            if ($responseBodyAsJSON->error->message == 'login failed as the email has not been verified')
                session()->flash('error', 'Tu cuenta no ha sido verificada, debes verificarla desde tu correo');
                else if($responseBodyAsJSON->error->message == 'login failed') 
                    session()->flash('error', 'El usuario o contraseña no coinciden');                
                else 
                    session()->flash('error', 'Ocurrio un error al iniciar sesión');                
            return Redirect::to('/login'. '#inicio');     
        }
        $superUser = json_decode($response->getBody()->getContents());
        
        if (isset($superUser->id) && $request->email == 'superuser@user.com') {
            Session::put([
                'ACCESS_TOKEN'  => $superUser->id,
                'USER_ID'       => $superUser->userId,
                'SUPER_USER'    => true
            ]);
           return Redirect::to('/controlpanelsv');
        } 
    }

    function recomendados()
    {
        try {
            $response = Membresia::getByFilter(getClient(), '');
        } catch (RequestException $e) {
            return view('super-user.index');
        }

        $membresias = json_decode($response->getBody()->getContents());

        return view('super-user.recomendados', compact('membresias'));
    }

    function recomendadosCreate($id)
    {
        return view('super-user.recomendados-create', compact('id'));
    }

    function recomendadosStore(Request $request)
    {
        // Verifica si esta membresia ya se encuentra como destacada
        try {
            $responseMembresias = Destacado::getAll(getClient());
        } catch (RequestException $e) {
            return view('super-user.index');
        }
        $destacados = json_decode($responseMembresias->getBody()->getContents());
        // echo $request->membresiaId;
        foreach ($destacados as $destacado) {
            // echo "<br>" . var_dump($destacado->idMembresia);
            if ($destacado->idMembresia == $request->membresiaId) {
                session()->flash('error', 'Esta membresia ya se encuentra en recomendados');
                return Redirect::back();     
            }
        }

        try {
            $response = Destacado::create(getClient(), $request);
        } catch (RequestException $e) {
            return view('super-user.index');
        }

        $result = json_decode($response->getBody()->getContents());

        session()->flash('success', '¡Agregado a recomendados exitosamente!');
        return Redirect::to('controlpanelsv');
    }
}
