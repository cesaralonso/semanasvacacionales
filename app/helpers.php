<?php
/**
* Gets the instance to make HTTP Requests
*/
function getClient()
{
    $client = new GuzzleHttp\Client([
        // Base URI is used with relative requests
        'base_uri' => $_ENV['END_POINT'],
    ]);
    return $client;
}

function slugify($input)
{
    $tittles  = ['/Ã/','/À/','/Á/','/Ä/','/Â/','/È/','/É/','/Ë/','/Ê/','/Ì/','/Í/','/Ï/','/Î/','/Ò/','/Ó/','/Ö/','/Ô/','/Ù/','/Ú/','/Ü/','/Û/','/ã/','/à/','/á/','/ä/','/â/','/è/','/é/','/ë/','/ê/','/ì/','/í/','/ï/','/î/','/ò/','/ó/','/ö/','/ô/','/ù/','/ú/','/ü/','/û/','/Ñ/','/ñ/','/Ç/','/ç/','/ /','/%/'];
    $original = ['A','A','A','A','A','E','E','E','E','I','I','I','I','O','O','O','O','U','U','U','U','a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','u','u','u','u','n','n','c','c','-','p'];
    
    return strtolower(str_replace('$','c', preg_replace($tittles, $original, $input)));
}

/*
* Verify if there's an attribute named '$attribute'
* If it does exists, it will return the value
* If it doesn't it will return an empty string
*/
function pv($object, $attribute)
{
    return isset($object->{$attribute}) ? $object->{$attribute} : '';
}

// Returns date in correct format
function pvDate($object, $attribute)
{

     if(isset($object->{$attribute})) {

        $date = new DateTime($object->{$attribute});
        $date = $date->format('Y-m-d');
        
        return $date;
     } else 
         return '';
}

function pvsDat($object, $attribute)
{
    if(isset($object->{$attribute})) {
        $dateArray = date_parse($object->{$attribute});
        return $dateArray['day']. '/'. $dateArray['month']. '/' .$dateArray['year']. ' '. $dateArray['hour']. ':'. $dateArray['minute'];
    } else 
        return '';
}
function pvDayMonth($object, $attribute)
{
    $months = ['Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    if(isset($object->{$attribute})) {
        $dateArray = date_parse($object->{$attribute});
        return $dateArray['day']. ' / '. $months[$dateArray['month'] - 1] . ' / ' . date('Y');
    } else 
        return '';
}

function isVentaRenta($renta, $venta)
{
    return $renta ? 'renta' : $venta ? 'venta' : ''; 
}
/**
* Create an associative array giving an object.
*
* @param  Object  $object
* @param  String  $firstParam
* @param  String  $secondParam
*
* @return Array
*/
function makeAsocArray($object, $firstParam, $secondParam)
{
    $array=[];
    foreach ($object as $value) 
        $array[$value->{$firstParam}] = $value->{$secondParam};
    
    return $array;
}

function emailForVerification($id, $email, $verifyLink)
{
    return '
    <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
    #outlook a { padding: 0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .ExternalClass * { line-height:100%; }
    body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
    p { display: block; margin: 13px 0; }
    </style>
    <!--[if !mso]><!-->
    <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport { width:320px; }
      @viewport { width:320px; }
    }
    </style>
    <!--<![endif]-->
    <!--[if mso]>
    <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-100, * [aria-labelledby="mj-column-per-100"] { width:100%!important; }
    .mj-column-per-80, * [aria-labelledby="mj-column-per-80"] { width:80%!important; }
    .mj-column-per-30, * [aria-labelledby="mj-column-per-30"] { width:30%!important; }
    .mj-column-per-70, * [aria-labelledby="mj-column-per-70"] { width:70%!important; }
    }
    </style>
    </head>
    <body style="background: #E3E5E7;">
    <div style="background-color:#E3E5E7;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div style="margin:0 auto;max-width:600px;background:white;"><table cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:white;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
        <![endif]--><div aria-labelledby="mj-column-per-100" class="mj-column-per-100" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" style="vertical-align:top;" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:10px 25px;" align="center"><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;" align="center" border="0"><tbody><tr><td style="width:80px;"><a href="about:blank" target="_blank"><img alt="auth0" title="" height="auto" src="http://www.tiempocompartido.com/images/tiempo-compartido-logo.gif" style="border:none;border-radius:;display:block;outline:none;text-decoration:none;width:20em;height:auto;" width="80"></a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
        <!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div style="margin:0 auto;max-width:600px;background:#222228;"><table cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#222228;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:480px;">
        <![endif]--><div aria-labelledby="mj-column-per-80" class="mj-column-per-80" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" style="vertical-align:top;" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:10px 25px;padding-top:30px;" align="center"><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;" align="center" border="0"><tbody><tr><td style="width:80px;"><img alt="Zero To Launch" title="" height="auto" src="https://cdn.auth0.com/website/emails/product/top-verify.png" style="border:none;border-radius:;display:block;outline:none;text-decoration:none;width:100%;height:auto;" width="80"></td></tr></tbody></table></td></tr><tr><td style="word-break:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:white;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:32px;line-height:60ps;">
              Verifica tu cuenta
            </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
        <!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div style="margin:0 auto;max-width:600px;background:white;"><table cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:white;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0px;padding:40px 25px 0px;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
        <![endif]--><div aria-labelledby="mj-column-per-100" class="mj-column-per-100" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:0px 0px 25px;" align="left"><div style="cursor:auto;color:#222228;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:18px;font-weight:500;line-height:30px;">
              Información de tu cuenta
            </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td><td style="vertical-align:top;width:180px;">
        <![endif]--><div aria-labelledby="mj-column-per-30" class="mj-column-per-30" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:0px 0px 10px;" align="left"><div style="cursor:auto;color:#222228;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:16px;line-height:30px;">
              <strong style="font-weight: 500; white-space: nowrap;">Cuenta</strong>
            </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td><td style="vertical-align:top;width:420px;">
        <![endif]--><div aria-labelledby="mj-column-per-70" class="mj-column-per-70" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:0px 0px 10px;" align="left"><div style="cursor:auto;color:#222228;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:16px;line-height:30px;">
            '.$email.'
            </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td><td style="vertical-align:top;width:180px;">
        <![endif]-->
        <div aria-labelledby="mj-column-per-30" class="mj-column-per-30" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:0px 0px 10px;" align="left"><div style="cursor:auto;color:#222228;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:16px;line-height:30px;">
                <strong style="font-weight: 500; white-space: nowrap;">Link de verificación</strong>
        </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td><td style="vertical-align:top;width:420px;">
        <![endif]--><div aria-labelledby="mj-column-per-70" class="mj-column-per-70" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:0px 0px 10px;" align="left"><div style="cursor:auto;color:#222228;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:16px;line-height:30px;">
            <a href="'.$verifyLink.'">'.$verifyLink.'</a>
            </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td><td style="vertical-align:top;width:180px;">
        <![endif]-->
        
        
        <!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div style="margin:0 auto;max-width:600px;background:white;"><table cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:white;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0px;padding:0px 30px;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:undefined;width:600px;">
        <![endif]--><p style="font-size:1px;margin:0 auto;border-top:1px solid #E3E5E7;width:100%;"></p><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:1px;margin:0 auto;border-top:1px solid #E3E5E7;width:100%;" width="600"><tr><td style="height:0;line-height:0;"> </td></tr></table><![endif]--><!--[if mso | IE]>
        </td></tr></table>
        <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
        <!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div style="margin:0 auto;max-width:600px;background:white;"><table cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:white;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
        <![endif]-->
        <form action="'.$verifyLink.'" method="GET">
            <div aria-labelledby="mj-column-per-100" class="mj-column-per-100" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;">
                <table cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                        <tr><td style="word-break:break-word;font-size:0px;padding:10px 25px;" align="center">
                            <table cellpadding="0" cellspacing="0" align="center" border="0">
                                <tbody>
                                    <tr><td style="border-radius:3px;color:white;cursor:auto;" align="center" valign="middle" bgcolor="#163862">
                                        <a href="#" style="display:inline-block;text-decoration:none;background:#163862;border-radius:3px;color:white;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:14px;font-weight:500;line-height:35px;padding:10px 25px;margin:0px;" target="_blank" onclick="myscript()">
                                            VERIFICAR MI CUENTA
                                        </a>
                                    </td></tr>
                                </tbody>
                            </table>
                        </td></tr>
                    </tbody>
                </table>
            </div>
        </form>
        <!--[if mso | IE]>
        </td></tr></table>
        <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
        <!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div style="margin:0 auto;max-width:600px;background:white;"><table cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:white;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
        <![endif]--><div aria-labelledby="mj-column-per-100" class="mj-column-per-100" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" style="vertical-align:top;" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:0px 25px 15px;" align="left"><div style="cursor:auto;color:#222228;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:16px;line-height:30px;">
              Si tienes algun inconveniente con tu cuenta, por favor no dudes en ponerte en contacto con nosotros.
              <br>¡Gracias!
            </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
        <!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div style="margin:0 auto;max-width:600px;background:#F5F7F9;"><table cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#F5F7F9;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0px;padding:20px 0px;"><!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
        <![endif]--><div aria-labelledby="mj-column-per-100" class="mj-column-per-100" style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;"><table cellpadding="0" cellspacing="0" style="vertical-align:top;" width="100%" border="0"><tbody><tr><td style="word-break:break-word;font-size:0px;padding:0px 20px;" align="center"><div style="cursor:auto;color:#222228;font-family:\'Avenir Next\', Avenir, sans-serif;font-size:13px;line-height:20px;">
            Estas recibiendo este correo porque acabas de crear una cuenta en <a href="http://www.tiempocompartido.com">tiempocompartido</a>     
            Si no estas seguro de porque estas recibiendo este correo, por favor, ponte en contacto con nostros.
            </div></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
        <!--[if mso | IE]>
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
          <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]--><div></div><!--[if mso | IE]>
        </td></tr></table>
        <![endif]--></div>
    <img src="https://mandrillapp.com/track/open.php?u=9812467&amp;id=bca57efeee894396adad890ad5feefe1" height="1" width="1">
    
    </body>  
    ';
}
