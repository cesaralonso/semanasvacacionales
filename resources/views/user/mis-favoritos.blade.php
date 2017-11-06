@extends('layouts.master')
@section('content')
    <section class="ruta py-1" id="inicia">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="/">Inicio</a> » <a href="/mi-cuenta">Mi cuenta</a> » Mis favoritos
                </div>
            </div>
        </div>
    </section>
    <section class="py-1">   
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xl-4">
                    @include('layouts.menu-cuenta')
                </div>
                <div class="col-md-7 col-xl-8 padding">
                    @if( isset($membresias) )
                        @foreach($membresias as $membresia)
                    
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-4">
                                    <a href="/membresia/tiempo-compartido-en-{{ slugify (pv($membresia->membresia, 'localidadNombre')) }}-{{ slugify(pv($membresia->membresia, 'clubNombre')) }}-{{ slugify(pv($membresia->membresia, 'paisNombre')) }}/{{ pv($membresia->membresia, 'id') }}">   
                                        @if ( App\User::getPrincipalImage(getClient(), $membresia->idMembresia) != null)
                                                <img src="{{$_ENV['UPLOAD_FOLDER']}}/membresias-images/thumbs/{{ App\User::getPrincipalImage(getClient(), $membresia->idMembresia)->src }}" class="card-image-desktop">
                                                <img src="{{$_ENV['UPLOAD_FOLDER']}}/membresias-images/thumbs/{{ App\User::getPrincipalImage(getClient(), $membresia->idMembresia)->src }}" class="card-image-mobile w-100">
                                        @else 
                                                <img src="assets/img/sin-imagen.jpg" class="card-image-desktop">
                                                <img src="assets/img/sin-imagen.jpg" class="card-image-mobile w-100">
                                        @endif
                                    </a>
                                    </div>
                                    <div class="card-image-mobile col-md-8 px-3"> 
                                        <div class="card-block" style="padding-left: 0; padding-right:0;">
                                            <h4 class="card-title">{{ pv($membresia->membresia, 'titulo') }}</h4>
                                            <p class="card-text">{{ pv($membresia->membresia, 'descripcion') }}</p>
                                        </div>
                                    </div>
                                    <div class="card-image-desktop col-md-8 px-3"> 
                                        <div class="card-block pl-3">
                                            <h4 class="card-title">{{ pv($membresia->membresia, 'titulo') }}</h4>
                                            <p class="card-text">{{ pv($membresia->membresia, 'descripcion') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection