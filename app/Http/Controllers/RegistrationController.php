<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\User;
use App\Email;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class RegistrationController extends Controller
{

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Verify route
        if (Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');

        return view('registration.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Validation form from server side
         $this->validate($request, [
            'user'              => 'required',
            'email'             => 'required',
            'password'          => 'required',
            'password_confirm'  => 'required',
        ]);

        // Get the instance to make HTTP Requests        
        $client = getClient();
        try {
            // Register a new user
            $response = User::registerUser($client, $request);

        } catch (ClientException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error al registrarte, por favor intente de nuevo');
            return view('registration.signup');
        } catch (RequestException $e) {
            
            $statusCode =  $e->getResponse()->getStatusCode();

            if($statusCode == 422) {
                // In something went wrong it will redirect to home page
                session()->flash('error', 'Este correo ya se encuentra en uso, por favor, ingrese otro.');
                return Redirect::to('/signup' . "#inicio");
            } else {
                echo Psr7\str($e->getResponse());
            }
        }
        $user = json_decode($response->getBody()->getContents());
        
        // return var_dump($user);

        // Send email for confirmation
        $response = self::sendMail($user);
        if( $response ) {
            session()->flash('message', 'Te hemos enviado un correo de confirmación de tu cuenta.');
            return view('session.login'); 
        } else {
            session()->flash('error', 'Hubo un problema al realizar el registro. Por favor, intentalo de nuevo');
            return view('session.login'); 
        }

            
    }

    private function sendMail($user)
    {
        $linkToVerify = $_ENV['HOST'].'verifyEmail/';//'https://582e389b.ngrok.io/verifyEmail/';
        $to = $user->email;
        $subject = "CONFIRMA TU CORREO ELECTRONICO - TIEMPOCOMPARTIDO";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers = "Content-type:text/html;charset=UTF-8";
        
        try {
            $response = Email::send(getClient(), $to, $subject, emailForVerification($user->id, $user->email, $linkToVerify. $user->id), $headers);
        } catch (Exception $e) {
            // return dd($e);
            return false;
        }
        return true;

    }
    
}
