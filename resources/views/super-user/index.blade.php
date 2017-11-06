@extends('layouts.master')
@section('content')
    <section class="py-1">   
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xl-4">
                    @include('layouts.su-menu')
                </div>
                <div class="col-md-7 col-xl-8 ">
                    <h3>Promociones</h3>
                    <hr>

                    @foreach( $promociones as $index => $promocion )
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4">
                                    @if ( isset($promocion->imagenes[0]) )
                                        <img src="{{$_ENV['UPLOAD_FOLDER']}}/promociones/thumbs/{{ $promocion->imagenes[0]->src }}" style="width:100%" class="card-image-mobile w-100">
                                        <img src="{{$_ENV['UPLOAD_FOLDER']}}/promociones/thumbs/{{ $promocion->imagenes[0]->src }}" style="width:100%" class="card-image-desktop">
                                    @else 
                                        <img src="assets/img/sin-imagen.jpg" class="card-image-desktop">
                                        <img src="assets/img/sin-imagen.jpg" class="card-image-mobile w-100">
                                    @endif
                                </div>
                                <div class="card-image-mobile col-md-8 px-3"> 
                                    <div class="card-block" style="padding-left: 0; padding-right:0;">
                                        <h4 class="card-title">{{ pv($promocion, 'titulo') }}</h4>
                                        <p class="card-text"> {{ pv($promocion, 'descripcion') }} </p>
                                        <hr>
                                        @include('layouts.su-promocion-opciones')                                        
                                    </div>
                                </div>
                                <div class="card-image-desktop col-md-8 px-3"> 
                                    <div class="card-block pl-3">
                                        <h4 class="card-title">{{ pv($promocion, 'titulo') }}</h4>
                                        <p class="card-text">{{ str_limit(pv($promocion, 'descripcion'),65 )}}</p>
                                        <hr>
                                        @include('layouts.su-promocion-opciones')
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection