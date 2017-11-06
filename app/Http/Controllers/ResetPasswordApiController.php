<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class ResetPasswordApiController extends Controller
{
    public function send(Request $request)
    {
        try {
            $response = getClient()->request('POST', 'People/reset', [
                'header' => [
                    'Accept'  => 'application/json'
                ],
                'form_params' => [
                    'email'  => $request->email
                ]
            ]);
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Ha ocurrido un error, por favor intente de nuevo. Verifique el correo ingresado');
            return Redirect::back();
        }
        session()->flash('message', 'Hemos enviado un mensaje a tu correo');
        return Redirect::to('/');
    }
    public function index($access_token)
    {
        return view('reset-password.index', compact('access_token'));
    }

    public function store(Request $request)
    {
        try {
            ///reset-password?access_token=DEqJXNoIrC9Bxz2b2VmOPYavtkCiH89ZETtQ4drz8JaP6Z9vaKaaJxKWBRBsR7Pu"
            $url = 'People/reset-password?access_token='.$request->__access_token;
            $response = getClient()->request('POST', $url, [
                'header' => [
                    'Accept'  => 'application/json'
                ],
                'form_params' => [
                    'newPassword'  => 'application/json'
                ]
            ]);
        } catch (Exception $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Ha ocurrido un error, por favor intente de nuevo');
            return Redirect::back();
        }
        session()->flash('message', 'Su contraseña ha sido cambiada');
        return Redirect::to('/login');
        
    }
}
