@extends('layouts.master')
@section('content')
    <section class="ruta py-1" id="inicia">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="/">Inicio</a> » <a href="/promociones">Promociones</a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-1">
        <div class="container py-2">   
            <div class="row">
                <div class="col-md-12">
                    <h1 class="tiempo-title text-center pb-1"> {{ $promocion->titulo }} </h1>
                    <div class="tiempo-line-bottom-container margin-bottom">
                        <span class="tiempo-line-bottom"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="owl-carousel owl-theme">
                                @if(isset($promocion->imagenes))
                                    @foreach($promocion->imagenes as $imagen)
                                        @if($imagen->tipo == 'original')
                                            <div class="item">
                                                <img src="{{$_ENV['UPLOAD_FOLDER']}}/promociones/{{$imagen->src}}" alt="imagen" style="width:100%;">
                                            </div>
                                        @endif
                                    @endforeach
                                    @else
                                        <div class="item">
                                            <img src="assets/img/sin-imagen-land.jpg" alt="imagen" style="width:100%;">                                    
                                        </div>
                                @endif
                            </div>
                            <div class="owl-nav">
                                <i class="am-prev"></i>
                                <i class="am-next"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <blockquote class="blockquote blockquote-reverse">
                            <p class="mb-0"> {{ $promocion->descripcion }} </p>
                            <footer class="blockquote-footer">Promociones en <cite title="tiempocompartido.com"><a href="http://www.tiempocompartido.com">tiempocompartido.com</a></cite></footer>
                        </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection