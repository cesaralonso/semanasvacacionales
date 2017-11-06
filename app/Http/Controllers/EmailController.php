<?php

namespace App\Http\Controllers;

use Redirect;
use App\User;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;


class EmailController extends Controller
{
    public function verify($id)
    {
        try {
            $response = User::verifyEmail(getClient(), $id);
        } catch (RequestException $e) {
            session()->flash('error', 'Hubo un error, por favor intente de nuevo');
            return Redirect::to('/');
        }

        $confirm= json_decode($response->getBody()->getContents());
        if($confirm->emailVerified) {
            session()->flash('message', 'Tu correo ha sido verificado, pueden iniciar sesion ahora.');
            return Redirect::to('/login');
        } else {
            session()->flash('error', 'Ha ocurrido un problema al intentar verificar tu cuenta, por favor, intentalo de nuevo.');
            return Redirect::to('/');
        }
    }

}
