@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-2 mt-2">
                <h3 class="Latest__title pb-1 text-center tiempo-title display-4">
                    Agregar a recomendados
                </h3>
                <div class="tiempo-line-bottom-container" style="padding-bottom: .5rem;">
                    <span class="tiempo-line-bottom"></span>
                </div>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <form action="/recomendados-create" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$id}}" name="membresiaId" id="membresiaId">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label no-padding-right" for="email"> Entrada </label>
                                <div class="">
                                    <span class="block input-icon input-icon-right">
                                        <input type="date" class="form-control" id="entrada"name="entrada" required/>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label no-padding-right" for="email"> Salida </label>
                                <div class="">
                                    <span class="block input-icon input-icon-right">
                                        <input type="date" class="form-control" id="salida"name="salida" required/>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6"></div>                    
                        <div class="col-md-6 text-right">
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
@endsection