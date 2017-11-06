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
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-12">
                <h1 class="tiempo-title display-4">Búsqueda</h1>
                <hr>
            </div>
            <div class="col-md-5">

                <form id="busquedaForm" role="form">
                    
                    <div class="form-group">
                        <label for="cmb__Country">País</label>
                        @if(isset($search))
                            {{ Form::select(
                                'pais', $paises, 
                                $search['pais'], [
                                    'class'     => 'form-control',
                                    'id'        => 'pais',
                                    'onchange' => 'setLocalidadesBusqueda()'
                            ])}}
                        @else
                            <select class="form-control" id="pais" name="pais" onchange="setLocalidadesBusqueda()">
                                @if (isset($paises))
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id}}"> {{ $pais->nombre }} </option>
                                    @endforeach
                                @endif
                            </select>
                        @endif
                    </div>
                    <div class="form-group ciudad-busqueda">
                        
                    </div>
                    <div class="form-group">
                        <label>Busco en</label>
                        @if(isset($search))
                            {{ Form::select(
                                'busco', ['RENTA' => 'Renta', 'VENTA' => 'Venta'], 
                                $search['rentaventa'], [
                                    'class'     => 'form-control',
                                    'id'        => 'busco'
                            ])}}
                        @else
                            <select class="form-control" id="busco" name="busco">
                                <option value="RENTA" selected>Renta</option>
                                <option value="VENTA" >Venta</option>
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Huéspedes</label>
                        @if( isset($search['huespedes']))
                            {{ Form::select(
                                    'huespedes', [0 => 'Ignorar',1,2,3,4,5,6,7,8,9,0,10,11,12,13,14,15,16,17,18], 
                                    $search['huespedes'], [
                                        'class'     => 'form-control',
                                        'id'        => 'huespedes'
                                ])}}
                        @else
                        <select class="form-control" name="huespedes" id="huespedes">
                            <option value="0" selected>Ignorar</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                        </select>
                        @endif
                    </div>  
                    <div class="form-group">
                        <label for="">Tipo de destino</label>
                        <select class="form-control" name="ubicacion" id="ubicacion">
                            @if(isset($ubicaciones))
                                <option value="" selected>Todas</option>
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->nombre}}"> {{ $ubicacion->nombre }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="">Tipo de hospedaje</label>
                        <select class="form-control" name="inmueble" id="inmueble">
                            @if(isset($unidades))
                                <option value="" selected>Todos</option>
                                @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->nombre}}"> {{ $unidad->nombre }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>  
                    <div class="form-group">
                        <button type="button" class="width-35 pull-right btn btn-primary" onclick="searchMembresias()">
                            <i class="ace-icon fa fa-search"></i>
                            Buscar
                        </button>
                    </div>
                        
                </form>

            </div>
            <div class="col-md-7">
                <div id="mapSearch" style="width 500px; height:400px"> </div>
            </div>
        </div>
        <section id="resultados-busqueda">
            <div class="row membresias-result mt-3">
                <div class="col-md-12">
                    <h3 class="Latest__title pb-1 text-center tiempo-title">
                        Resultados  
                    </h3>
                    <div class="tiempo-line-bottom-container margin-bottom">
                        <span class="tiempo-line-bottom"></span>
                    </div>
                </div>
                <div class="resultados-content row" ></div>
            </div>
        </section>
    </div>
@endsection