<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\User;
use App\Promocion;
use Illuminate\Http\Request;

class SuperUserController extends Controller
{
    function index()
    {
        try {
            $response = Promocion::getAll(getClient());
        } catch (RequestException $e) {
            return view('super-user.index');
        }

        $promociones = json_decode($response->getBody()->getContents());
        return view('super-user.index', compact('promociones'));
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
           return Redirect::to('/controlpanel');
        } 
    }
}
