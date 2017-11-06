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

    <section class="py-1">   
        <div class="Listados padding-row">
            <div class="container">
                <div class="row">
                    {{--  <div class="col-xs-12 col-lg-12 margin-bottom">
                        <h1 class="title">
                            Listados por categoria
                        </h1>
                    </div>  --}}
                    <div class="col-lg-12 mb-2">
                        <h3 class="Latest__title pb-1 text-center tiempo-title display-4">
                            Listados por categoría
                        </h3>
                        <div class="tiempo-line-bottom-container" style="padding-bottom: .5rem;">
                            <span class="tiempo-line-bottom"></span>
                        </div>
                        <h4 class="text-center" style="color: #7fb2d4;">Selecciona una categoria de listado de tiempos compartidos</h4>
                    </div>
                    <div class="col-xs-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1  margin-bottom">

                        {{--  <h2 class="title margin-bottom">Listados por ciudades</h2>
                        <div class="list-group">
                            <a ng-href="{{listado.enlace_url}}" class="list-group-item" ng-repeat="listado in listados.ciudades">
                                {{listado.enlace_des}}
                            </a>
                        </div>  --}}
                        {{--  <h2 class="lead margin-bottom">Selecciona una categoria de listado de tiempos compartidos</h2>  --}}
        
                        <div class="list-group text-center" style="box-shadow: 10px 10px 5px #888888;">
                            <a class="list-group-item list-group-item-action categoria-list" href="/listados/clubes/listados-de-tiempos-compartidos-por-clubes" class="list-group-item">
                                Listados de tiempos compartidos por club
                            </a>
                            <a class="list-group-item list-group-item-action categoria-list"href="/listados/destinos/listados-de-tiempos-compartidos-por-destinos" class="list-group-item">
                                Listados de tiempos compartidos por destinos
                            </a>
                            <a class="list-group-item list-group-item-action categoria-list"href="/listados/paises/listados-de-tiempos-compartidos-por-paises" class="list-group-item">
                                Listados de tiempos compartidos por paises
                            </a>
                            <a class="list-group-item list-group-item-action categoria-list"href="/listados/unidades/listados-de-tiempos-compartidos-por-unidades" class="list-group-item">
                                Listados de tiempos compartidos por unidades
                            </a>
                            <a class="list-group-item list-group-item-action categoria-list"href="/listados/amenidades/listados-de-tiempos-compartidos-por-amenidades" class="list-group-item">
                                Listados de tiempos compartidos por amenidades
                            </a>
                        </div>
                        {{--  <table class="table table-hover">
                                <tr>
                                    <th class="text-center">
                                        <a href="#">Listados de tiempos compartidos por club</a>
                                    </th>
                                </tr>                                
                                <tr>
                                    <th class="text-center">
                                        <a href="#">Listados de tiempos compartidos por destinos</a>
                                    </th>
                                </tr>                                
                                <tr>
                                    <th class="text-center">
                                        <a href="#">Listados de tiempos compartidos por paises</a>
                                    </th>
                                </tr>                                
                                <tr>
                                    <th class="text-center">
                                        <a href="#">Listados de tiempos compartidos por unidades</a>
                                    </th>
                                </tr>                                
                                <tr>
                                    <th class="text-center">
                                        <a href="#">Listados de tiempos compartidos por amenidades</a>
                                    </th>
                                </tr>                                
                            </tbody>
                        </table>  --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection