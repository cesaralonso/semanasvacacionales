@extends('layouts.master')
@section('content')
    <section class="ruta py-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="/">Inicio</a> » <a href="/mi-cuenta">Mi cuenta</a> » <a href="/mis-membresias">Mis membresias</a>
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
                        Establecer ubicación en mapa
                    </h1>
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Dirección</label>
                                        <input type="text" id="us2-address" class="form-control"  placeholder="Escribe la dirección" >
                                    </div>  
                                </div>
                                <div class="col-xs-12 col-lg-12">
                                    <button type="button" class="width-35 pull-right btn btn-primary" onclick="setLocation('{{ $membresia->id }}')">
                                        <i class="ace-icon fa fa-check"></i>
                                        Establecer ubicación
                                    </button>
                                </div>
                                <div id="successLocationChanged" class="alert alert-success mt-1" style="display:none;" role="alert">
                                    <strong>Cambios guardados!</strong> Se han guardado los cambios correctamente.
                                </div>
                                @if(isset($membresia->ubicacion))
                                    <input type="hidden" id="us2-lat"  value="{{ pv($membresia->ubicacion, 'lat')}}"/>
                                    <input type="hidden" id="us2-lon"  value="{{ pv($membresia->ubicacion, 'lng')}}"/>
                                    <input type="hidden" id="us2-city" value="{{ pv($membresia->ubicacion, 'ciudad')}}"/>
                                @else
                                    <input type="hidden" id="us2-lat"  value="19.4326077" />
                                    <input type="hidden" id="us2-lon"  value="-99.13320799999997" />
                                    <input type="hidden" id="us2-city" />

                                @endif
                                <input type="hidden" id="membresiaId" value="{{$membresia->id}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-7 col-lg-7 no-padding">
                <div class="AppSearch__Map">
                    <div id="map-component" class="embed-responsive-item"  style="height:70vh; width: 90%;"></div>
                </div>
            </div>
            
        </div>
    </div>
@endsection