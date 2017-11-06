@extends('layouts.master')
@section('content')
    <div class="container mt-3">
        <h3 class="Latest__title pb-1 text-center tiempo-title">
            Membresias recomendadas
        </h3>
        <div class="tiempo-line-bottom-container margin-bottom">
            <span class="tiempo-line-bottom"></span>
        </div>

        @if( isset($destacados[0]) )
            <div class="row">
                    @foreach( $destacados as $index => $destacado )
                        <div class="col-md-4" style="max-width:100%;">
                            <div class="card">
                                @if( isset($destacado->membresia->imagenes[0]->src) )
                                    <img src="{{$_ENV['UPLOAD_FOLDER']}}/membresias-images/thumbs/{{ $destacado->membresia->imagenes[0]->src }}" style="width: 100%;"> 
                                @else
                                    <img src="assets/img/sin-imagen-land.jpg" style="width: 100%;">                         
                                @endif
                                <div class="card-block">
                                    <h4 class="card-title">{{ pv($destacado->membresia, 'titulo') }}</h4>
                                    <p class="card-text">{{ pv($destacado->membresia, 'descripcion') }}</p>
                                    <a  class="btn btn-primary-outline" href="/membresia/tiempo-compartido-en-{{ slugify( pv($destacado->membresia, 'localidadNombre') ) }}-{{ slugify( pv($destacado->membresia, 'clubNombre') ) }}-{{ slugify( pv($destacado->membresia, 'paisNombre') ) }}/{{ pv($destacado->membresia, 'id') }}">
                                        Ver membresia
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="row center-pagination">
                <nav aria-label="Page navigation example" >
                <ul class="pagination pagination-lg">
                    <li class="page-item {{ $init == 0 ? 'disabled' : ''}}">
                        <a class="page-link" href="{{ $init > 0 ? '/'.$filter.'/'. slugify(pv($destacados[0]->membresia, 'titulo')).'/'. (($final - $pagination ) - $pagination) .'/'. ($final - $pagination ) : '#'}} " tabindex="-1">Atrás</a>
                    </li>
                    @for($index = 0; $index < $paginationNumber; $index ++)
                        <li class="page-item {{ (($index ) * $pagination) == $init ? 'active' : '' }}"><a class="page-link" href="/{{$filter}}/{{ slugify( pv($destacados[0]->membresia, 'titulo')) }}/{{ ($index ) * $pagination }}/{{ ($index + 1) * $pagination }}">{{ $index + 1 }}</a></li>
                    @endfor
                    <li class="page-item {{ $final >= ($paginationNumber * $pagination)? 'disabled' : ''}}">
                        <a class="page-link" href="/{{$filter}}/{{ slugify(pv( $destacados[0]->membresia, 'titulo')) }}/{{ $final }}/{{ $final + $pagination}}">Siguiente</a>
                    </li>
                </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection