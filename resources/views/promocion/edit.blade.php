@extends('layouts.master')
@section('content')
    <div class="container padding">
    <h1>Edita la promoción</h1>    
    <form method="POST" action="/save-promocion" class="form-horizontal padding" role="form">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input name="promocionId" type="hidden" value="{{ pv($promocion, 'id') }}" />
    
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Título </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" class="form-control" value="{{pv($promocion, 'titulo')}}" id="titulo" name="titulo" required/>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Título (Inglés) </label>
                <div class="col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input type="text" class="form-control" value="{{pv($promocion, 'title')}}" id="title" name="title" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Descripción </label>
                <div class="col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input type="text" class="form-control" value="{{pv($promocion, 'descripcion')}}" id="descripcion" name="descripcion" required/>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="description"> Descripción (Inglés) </label>
                <div class="col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input type="text" class="form-control"  value="{{pv($promocion, 'description')}}" id="description" name="description" />
                    </span>
                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right"> </label>
                <div class="col-sm-7">
                    <button type="submit" class="width-35 pull-right btn btn-primary" >
                    <i class="ace-icon fa fa-key"></i>
                    Actualizar
                    </button>
                </div>
            </div>
        </div>
   </form>
   </div>
@endsection