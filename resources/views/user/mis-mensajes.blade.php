@extends('layouts.master')
@section('content')
    <section class="ruta py-1" id="inicia">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="/">Inicio</a> » <a href="/mi-cuenta">Mi cuenta</a> » Mis mensajes
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
                <div class="col-md-7 col-xl-8 mt-3" >
                    @if( isset($membresias) )
                        @foreach( $membresias as $index => $membresia )
                            <div class="row mt-1 mb-1" style="border-style: solid;border-width: 1px; border-color: #DEDEDE">
                                <div class="col-md-5 pl-0 pr-0">
                                    @if( isset($membresia->imagenes[0]) )
                                        <img src="{{$_ENV['UPLOAD_FOLDER']}}/membresias-images/{{$membresia->imagenes[0]->src}}" class="card-image-desktop" style="max-width:100%">                            
                                    @else
                                        <img src="assets/message-image.png" class="card-image-desktop" style="max-width:100%">
                                    @endif 
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="card-title mt-1"> Tienes {{ $numMensajes[$index] }} mensaje(s)</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <div class="col-md-12 mb-1 text-right">
                                            <a href="/membresia-mensajes/{{$membresia->id}}" class="btn btn-primary"> Ver más </a>
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