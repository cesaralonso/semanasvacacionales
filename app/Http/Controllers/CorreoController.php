<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\Correo;
use App\User;
use App\Email;
use Illuminate\Http\Request;

class CorreoController extends Controller
{
    public function contactOwner(Request $request)
    {   
        if ( !Session::has('ACCESS_TOKEN') ) {
            session()->flash('error', 'Necesitas iniciar sesion para contactar al propietario');
            return Redirect::back();
        }
        // Post correo to API
        try {
            // Store a new membresia
            $response = Correo::create(getClient(), $request, Session::get('USER_ID'), $request->destinatario, $request->membresiaId );
        } catch (ClientException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error al registrar la nueva membresia, por favor intente de nuevo');
            return Redirect::back();
        }

        $confirm = json_decode($response->getBody()->getContents());

        if(isset($confirm->id)) {
            try {

                $responseDestinatario = User::findById(getClient(), $confirm->destinatarioId );

                $responseRemitente = User::findById(getClient(), $confirm->remitenteId );
            } catch (ClientException $e) {
                // In case something went wrong it will redirect to register view
                session()->flash('error', 'Hubo un error, por favor intente de nuevo');
                return Redirect::back();
            }

            $destinatario = json_decode($responseDestinatario->getBody()->getContents());
            $remitente = json_decode($responseRemitente->getBody()->getContents());
            // Send Email
            self::sendMail(pv($destinatario, 'email'), $request->nombre, $request->cuerpo);
            
            session()->flash('message','Su mensaje ha sido enviado');
            return Redirect::back();
        }
    }

    public function contactSender(Request $request)
    {   
        if ( !Session::has('ACCESS_TOKEN') ) {
            session()->flash('error', 'Necesitas iniciar sesion para contactar al propietario');
            return Redirect::back();
        }
        // Post correo to API
        try {
            // Store a new membresia
            // $client, $request, $remitenteId, $destinatarioId, $membresiaId
            $response = Correo::create(getClient(), $request, Session::get('USER_ID'), $request->destinatarioId, $request->membresiaId );
        } catch (ClientException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error, por favor intente de nuevo');
            return Redirect::back();
        }

        $confirm = json_decode($response->getBody()->getContents());
        // return var_dump($confirm);
        if(isset($confirm->id)) {
            try {

                $responseDestinatario = User::findById(getClient(), $confirm->destinatarioId );

                $responseRemitente = User::findById(getClient(), $confirm->remitenteId );
            } catch (ClientException $e) {
                // In case something went wrong it will redirect to register view
                session()->flash('error', 'Hubo un error, por favor intente de nuevo');
                return Redirect::back();
            }
            $destinatario = json_decode($responseDestinatario->getBody()->getContents());
            $remitente = json_decode($responseRemitente->getBody()->getContents());
            
            // return var_dump($remitente);
            // Send Email
            self::sendMail(pv($destinatario, 'email'), $request->nombre, $request->cuerpo);
            
            session()->flash('message','Su mensaje ha sido enviado');
            return Redirect::back();
        }
    }
    private function sendMail($emailDestinatario, $nombreRemitente, $mensaje)
    {
        $subject = $nombreRemitente.' te envió un mensaje.';
        $html = '
         <html>
            <head>
                <title></title>
                <style>
                    .wrapper {
                        width: 100%; 
                        color: black;
                    }
                    .button-wrapper {
                        width: 50%; 
                        margin: 0 auto;
                    }
                    .button {
                        background-color: #4A608C; 
                        border: none;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;

                    }
                    .header-title {
                        display: flex;
                        justify-content: center;
                        width: 50%; 
                        margin: 0 auto;
                    }
                    
                </style>
            </head>
            <body>
                    
                <div class="wrapper">
                    <h1 class="header-title">'. $nombreRemitente .' te envió un mensaje</h1>
                    <hr>
                    <p>Deberás entrar a tu cuenta en tiempocompartido.com para ver y responder el mensaje de '. $nombreRemitente. '.</p>
                    <div class="button-wrapper">
                        <a class="button" href="'.$_ENV['HOST'].'mis-mensajes" >Ir a mis mensajes</a><br/>
                    </div>                    
                    <p>O puedes ingresar al siguiente enlace: '.$_ENV['HOST'].'mis-mensajes </p>
                    <p>
                        <small>
                            Recomendamos que toda la comunicación con otros usuarios sea mediante este sistema de mensajes. 
                            Existen empresas enviando mensajes argumentando tener un comprador muy interesado y que se comuniquen con ellos por otros medios. 
                            Después de exigir un pago por sus servicios por intermediar, cambian los numeros de teléfonos y domicilio para continuar estafando.
                        </small>
                    </p>
                </div>
            </body>
         </html>
        ';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers = "Content-type:text/html;charset=UTF-8";
        
        try {
            $response = Email::send(getClient(), $emailDestinatario, $subject, $html, $headers);
        } catch (Exception $e) {
            // return dd($e);
            return false;
        }
        return true;

    }
}
