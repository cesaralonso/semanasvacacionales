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

    <div class="AppSearch">
        <div class="row">
            <div class="col-xs-12 col-md-0 col-lg-1 no-padding"> </div>
            <div class="col-xs-12 col-md-5 col-lg-4 no-padding">
                <div class="AppSearch__Filters">
                    <h1 class="title margin-bottom">
                        Búsqueda
                    </h1>
                    <div class="row">
                        <div class="col-xs-6 col-lg-6">
                            <form id="busquedaForm" role="form">
                                <div class="row margin-bottom padding">
                                    <div class="col-xs-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="cmb__Country">País</label>
                                            <select class="form-control" id="pais" name="pais" onchange="setLocalidadesBusqueda()">
                                                @if (isset($paises))
                                                    @foreach($paises as $pais)
                                                        <option value="{{ $pais->id}}"> {{ $pais->nombre }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-lg-12">
                                        <div class="form-group ciudad-busqueda">
                                            <label for="cmb__Country">Ciudad</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Busco en</label>
                                            <select class="form-control" id="busco" name="busco">
                                                <option value="RENTA" selected>Renta</option>
                                                <option value="VENTA" >Venta</option>
                                            </select>
                                        </div>         
                                    </div>
                                    {{--  <div class="col-xs-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Llegando</label>
                                            <input type="date" class="form-control" id="txt__StartDateVacations" placeholder="Llegada">
                                        </div>         
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Saliendo</label>
                                            <input type="date" class="form-control" id="txt__EndDateVacations" placeholder="Salida">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Huéspedes</label>
                                            <input type="number" class="form-control" placeholder="Huéspedes" min="1" max="30">
                                        </div>  
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Forma de pago</label>
                                            <select class="form-control" id="">
                                                <option value="EFECTIVO">Efectivo</option>
                                                <option value="CREDITO-DEBITO,CHEQUE">Tarjeta Crédito/Débito</option>
                                                <option value="TRANSFERENCIA">Transferencia</option>
                                                <option value="CHEQUE">Cheque</option>
                                            </select>
                                        </div>  
                                    </div>
                                    <!--
                                    <div class="col-xs-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Precio Mínimo</label>
                                            <input type="number" step="1000" min="1000" class="form-control" ng-model="busqueda.precioMin" placeholder="Precio Minimo">
                                        </div>         
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Precio Máximo</label>
                                            <input type="number" step="1000" min="1000" class="form-control" ng-model="busqueda.precioMax" placeholder="Precio Máximo">
                                        </div>
                                    </div>-->
                                    <div class="col-xs-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Habitaciones</label>
                                            <input type="number" class="form-control" ng-model="busqueda.dormitorios" placeholder="Número de habitaciones" min="1" max="20">
                                        </div>         
                                    </div>
                                    <div class="col-xs-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Camas</label>
                                            <input type="number" class="form-control" ng-model="busqueda.camas" placeholder="Número de camas" min="1" max="30">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="">Baños</label>
                                            <input type="number" class="form-control" ng-model="busqueda.banios" placeholder="Número de baños" min="1" max="30">
                                        </div>
                                    </div>  --}}
                                    <!--
                                    <div class="AppSearch__ExtraFilters">
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Aeropuerto cercano?
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Central de Autobuses cercana?
                                                </label>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="col-xs-12 col-lg-12">
                                        <button type="button" class="width-35 pull-right btn btn-primary" onclick="searchMembresias()">
                                            <i class="ace-icon fa fa-search"></i>
                                            Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row margin-bottom padding lel">
                        <div class="col-xs-12 col-lg-12">
                            <h2 class="title margin-bottom">
                                Resultados
                            </h2>
                            {{--  <div>
                                <div class="media" >
                                    <div class="media-left">
                                        <a href="#">
                                        <img class="media-object" src="..." alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">membresia.clubNombre</h4>
                                        membresia.descripcion
                                    </div>
                                </div>
                            </div>  --}}
                            <div class="row membresias-result">
                                {{--  <div class="col-md-6">

                                </div>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-7 col-lg-7 no-padding">
                <div class="AppSearch__Map">
                    <div id="map_search" class="embed-responsive-item" style="height:100vh; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection