<?php

namespace App\Http\Controllers;

use URL;
use Session;
use Redirect;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


$fecha_inicio=date("Y-m-d");


switch($_POST['option_selection1'] ){
    case "3 Meses":
    $dias_comprados=92;
    break;
    case "6 Meses":
    $dias_comprados=184;
    break;
    case "12 Meses":
    $dias_comprados=365;
    break;
    }

$fecha=new DateTime;

$fecha->modify("+".$dias_comprados." day");

$fecha_fin =  $fecha->format("Y-m-d");



try {
    
    $response =  getClient()->request('POST', 'Membresia'. $_POST['custom']. '/destacado', [
        'form_params' => [
            'entrada' => $fecha_inicio,
            'salida'  => $fecha_fin
        ],
        'headers' => [
            'Accept' => 'application/json'
        ]
    ]);

} catch (RequestException $e) {
        
    // Hubo un error, no procede el correo.
    session()->flash('membresia-fallo', 'Lo sentimos, ocurrio un error al actualizar tu membresia. Intentalo nuevamente');
    header("Location: http://www.tiempocompartido.com/");    
    
}

$statusCode = $response->getStatusCode();

if($statusCode == 200) {
    $html = "
    <html>
    <head>
    <title>Detalle de Artículo Comprado en TiempoCompartido.com</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
    </head>
    <body>
    
    <div><a href='http://www.tiempocompartido.com/index.php'><img src='http://www.tiempocompartido.com/images/tiempo-compartido-logo.gif' alt='TiempoCompartido.com - Vende, Renta o Intercambia Tu Membresia de Tiempo Compartido en Todo el Mundo' border='0'></a></div><br>    
    
    <h1>Detalles de su compra</h1>
    <table width=\"814\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
    <tr bgcolor=\"#333333 \" class=\"tit\"> 
    <td width=\"358\">Producto</td>
    <td width=\"227\">Precio</td>
    <td width=\"357\">ID Membresia Destacada</td>
    <td width=\"159\" align=\"center\">".$_POST['option_name1']."</td>
    <td width=\"159\" >Inicia</td><td width=\"259\" >Finaliza</td>
    </tr>";
    
    $html.="<tr bgcolor=\"f2f2f2\" class=\"prod\"> 
    <td>".$_POST['item_name']."</td>
    <td>$".$_POST['mc_gross']." ".$_POST['mc_currency']."</td>
    <td>".$_POST['custom']."</td>
    <td align=\"center\">".$_POST['option_selection1']."</td>
    <td>".$fecha_inicio."</td>
    <td>".$fecha_fin."</td>
    </tr>";
    
    $html .=
    "</table>
    <div align=\"center\"><span class=\"prod\">Total de Articulos: 1</span> </div><br>
    <div align=\"center\"><span class=\"prod\">Total: \$".$_POST['mc_gross']." ".$_POST['mc_currency']."</span></div><br>
    <div align=\"left\"><span class=\"prod\">
    <h1 class='destacar'>Gracias por su compra!</h1><h2>Ahora su Membresia esta Destacada en Nuestro Sitio Web http://www.tiempocompartido.com Apareciendo en la seccion 'Destacados' en Portada y en Primeros Lugares de los Resultados de Busquedas.</h2>
    </span></div>";
    
    
    $para      = $_POST['payer_email'];
    $titulo    = 'Detalle de su compra en tiempocompartido.com';
    $mensaje   = $html;
    $cabeceras = '
    MIME-Version: 1.0\r\n
    Content-type: text/html; charset= iso-8859-1\r\n'.
    'Reply-To: contacto@tiempocompartido.com\r\n'.
        'X-Mailer: PHP/' . phpversion();
    
    mail($para, $titulo, $mensaje, $cabeceras);

    session()->flash('membresia-destacada', '¡Tu membresia ha sido destacada!');

    header("Location: http://www.tiempocompartido.com/");
}




