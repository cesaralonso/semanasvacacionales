@extends('layouts.master')
@section('content')
    
    <section class="px-5">
        <div class="container mt-3 mb-3">
            <h1> Agrega imágenes a tu promoción</h1>
            <hr>

            {{Form::open(['route' => 'saveImagePromocion', 'files' => true, 'onsubmit' => 'envio_form()', 'name' => 'form_imagen'])}}
                <input name="promocionTitulo" type="hidden" value="{{ slugify($promocion->titulo) }}"/>
                <input name="promocionId" type="hidden" value="{{ $promocion->id }}"/>
                <div class="form-group">
                    <div class="row">
                        {{Form::label('agregar_imagen', 'Agregar imagen',['class' => 'col-sm-3 control-label no-padding-right'])}}
                        <div class="col-sm-5">
                            {{Form::file('images[]', ['class' => 'form-control', 'id' => 'inputFiles', 'multiple' => true])}} 
                        </div>
                        <div class="col-sm-4">
                            {{Form::submit('Guardar', ['class' => 'width-35 pull-right btn btn-primary btn-block'])}}
                        </div>
                    </div>
                </div>
            {{Form::close()}}
        </div>
        @if(isset($promocion->imagenes[0]))
            <div id="mis-imagenes" class="container mb-3 pt-3">
                <div class="row">
                    <div class="col-md-6 pb-1">
                        <h2 class="">Imágenes de la promoción</h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($promocion->imagenes as $key => $image)
                        @if($image->tipo == 'thumb')
                            <div class="text-center col-md-4 col-sm-6 mb-1">
                                <div class="thumbnail">
                                    <a href="{{$_ENV['UPLOAD_FOLDER']}}/promociones/thumbs/{{ $image->src }}">
                                        <img style="width:100%;" src="{{$_ENV['UPLOAD_FOLDER']}}/promociones/thumbs/{{ $image->src }}"/> 
                                    </a>
                                </div>
                            </div>

                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection