@extends('layouts.master')
@section('content')
    <section class="ruta py-1" id="inicia">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="/">Inicio</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container padding-row">

        <div class="row no-margin margin-bottom-xl">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <figure class="img wow slideInLeft">
                    <img class="margin-top-sm" src="assets/img/slide-4.jpg" alt="www.tiempocompartido.com" height="250" width="100%">
                </figure>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 wow fadeIn">
                <h1 class="title">
                    ¿Quiénes somos?
                </h1>
                <p class="text">
                    Somos una empresa hermana a <a href="http://www.tiempocompartido.com/">Tiempo Compartido</a> que ofrece un servicio libre a nivel mundial sin intermediacion para renta de Semanas Vacacionales, Venta de Semanas Vacacionales e Intercambio de Semanas Vacacionales.<br><br>
                    <blockquote>
                        "Vacaciones Increibles"
                    </blockquote>
                </p>
                <p class="text">
                    Somos una empresa que pone a tu disposición un medio para la libre difusión de propiedades y tiempos compartidos en venta y renta entre usuarios vacacionistas, sin comisiones ni intermediarios, ¡Consigue el mejor precio para tus vacaciones!.<br><br>
                </p>
                <a href="/busqueda" class="btn btn-lg btn-info margin-bottom">Busca tus próximas vacaciones</a>
            </div>
        </div>

        <div class="row no-margin margin-bottom-xl">
            <div class="col-xs-12 col-md-6 col-lg-6 wow fadeIn">
                <h1 class="title">
                    Publica sin costo propiedades vacacionales
                </h1>
                <p class="text">
                    Publica tu semana vacacional o propiedad vacacional sin costo alguno. ¡Aprovecha esta oportunidad!.<br><br>
                </p>
                @if(Session::has('ACCESS_TOKEN'))
                    <a href="/mis-membresias" class="btn btn-lg btn-success margin-bottom">Publicar propiedades vacacionales</a>
                @else
                    <a href="/login" class="btn btn-lg btn-success margin-bottom">Publicar propiedades vacacionales</a>
                @endif
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <figure class="img wow slideInRight">
                    <img class="margin-top-sm" src="assets/img/slide-3.jpg" alt="www.tiempocompartido.com" height="250" width="100%">
                </figure>
            </div>
        </div>

        <div class="row no-margin margin-bottom-xl">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <figure class="img wow slideInLeft">
                    <img class="margin-top-sm" src="assets/img/slide-5.jpg" alt="www.tiempocompartido.com" height="250" width="100%">
                </figure>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 wow fadeIn">
                <h1 class="title">
                    Encuentra el mejor lugar para vacacionar
                </h1>
                <p class="text">
                    Experimenta una diferente forma de vacacionar, disfruta de tu semana vacacional en los clubes mas importantes del mundo haciendo trato directo con los propietarios, sin intermediación! consiguiendo los mejores precios!, ¿que esperas?, esta oportunidad es única.<br><br>
                </p>
                @if( Session::has('ACCESS_TOKEN'))
                    <a href="/" class="btn btn-lg btn-warning">¡Comienza Ahora!.</a>
                @else
                    <a href="/login" class="btn btn-lg btn-warning">¡Comienza Ahora!.</a>                    
                @endif
            </div>
        </div>
    </div>
@endsection