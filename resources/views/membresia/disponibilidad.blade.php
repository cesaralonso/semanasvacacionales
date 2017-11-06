@extends('layouts.master')
@section('content')
    <h3 class="Latest__title pb-1 text-center tiempo-title mt-3">
        Agregue una disponibilidad
    </h3>
    <div class="tiempo-line-bottom-container margin-bottom">
        <span class="tiempo-line-bottom"></span>
    </div>
    
    <div class="container mb-3">
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="/saveDisponibilidad">
                    {{csrf_field()}}
                    <input type="hidden" name="membresiaId" value="{{ isset($id) ? $id: ''}}">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3" for="email" style="display:flex;align-items:center"> Fecha inicial </label>
                            <div class="col-sm-7">
                                <span class="block input-icon input-icon-right">
                                    <input type="date" class="form-control" id="fecha_inicial"name="fecha_inicial" required/>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3" for="email" style="display:flex;align-items:center"> Fecha final </label>
                            <div class="col-sm-7">
                                <span class="block input-icon input-icon-right">
                                    <input type="date" class="form-control" id="fecha_final"name="fecha_final" required/>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="row">
                            <label class="col-sm-3 control-label no-padding-right"> </label>
                            <div class="col-sm-7">
                                <button type="submit" class="width-35 pull-right btn btn-primary" >
                                <i class="ace-icon fa fa-check"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                <form>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Libre</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(isset($disponibilidades))
                                @foreach($disponibilidades as $disponibilidad)
                                    <tr>
                                        <th>
                                            <input onchange="setDisponible('{{pv($disponibilidad, 'id')}}')" type="checkbox" class="form-control text-center" {{ $disponibilidad->libre ? 'checked' : '' }}>
                                        </th>
                                        <td> {{ pvDayMonth($disponibilidad, 'entrada')}} </td>
                                        <td> {{ pvDayMonth($disponibilidad, 'salida')}} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection