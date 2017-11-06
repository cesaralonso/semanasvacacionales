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

    <section class="py-1" id="">
        <div class="QuickSearch padding-row">
            <div class="container">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="jumbotron" style="padding: 2rem;">
                                <h1 class="display-3 hidden-xs-down pb-1">¡Promociones!</h1>
                                <h1 class="hidden-sm-up pb-1">¡Promociones!</h1>
                                <p c<lass="lead"><strong>Importante: </strong> La informacion contenida en las publicaciones ni es confirmada ni autorizada por <a href="http://www.tiempocompartido.com">tiempocompartido.com</a>. La confirmacion de la informacion publicada o adjunta es responsabilidad de la persona contratante o Usuario.</p>
                                <p>Las respuestas a los comentarios de los Usuarios es responsabilidad exclusiva del Anunciante..</p>
                                <footer class="text-right">
                                    <small class="blockquote-footer">tiempocompartido.com</small>
                                </footer>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h3 class="Latest__title pb-1 text-center tiempo-title">
                                Promociones del mes
                            </h3>
                            <div class="tiempo-line-bottom-container margin-bottom">
                                <span class="tiempo-line-bottom"></span>
                            </div>
                        </div>
                        <div class="row container">
                            @foreach($promociones as $promocion)

                                <div class="text-center col-md-4 col-sm-6 mb-1">
                                    <div class="thumbnail">
                                        <a href="/promociones/{{ slugify($promocion->titulo) }}/{{$promocion->id}}">
                                            <img style="width:100%; height:100%;" src="{{ isset($promocion->imagenes[0]->src) ?  $_ENV['UPLOAD_FOLDER'].'/promociones/' . $promocion->imagenes[0]->src : 'assets/img/sin-imagen-land.jpg' }}" alt="imagen"/> 
                                        </a>
                                        <div class="caption gradient pb-1" style="color: #C0C0C0;">
                                            {{ str_limit( pv($promocion, 'titulo'), 65)}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection