<?php

namespace App;

use Httpful\Request;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * Send email data by HTTP Request
     * Method: POST 
     * URI: http://aidihosting.com/proyectos/tiempocompartido_api/api/v1/sendEmail
     */
     public static function send($client, $to, $subject, $message, $headers)
     {
        $data = [
            'to'      => $to,
            'subject' => $subject,
            'message' => $message,
            'headers' => $headers,
        ];
        return Request::post('http://aidihosting.com/proyectos/tiempocompartido_api/api/v1/sendEmail')
            ->addHeader('Content-Type', "application/json ")
            ->body(json_encode($data))
            ->sendsJson()
            ->send();
    }

}
