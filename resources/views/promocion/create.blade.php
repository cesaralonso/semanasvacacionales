@extends('layouts.master')
@section('content')
    <div class="container padding">
    <h1>Publica una promoción</h1>    
    <form method="POST" action="/promocion" class="form-horizontal padding" role="form">
        {{csrf_field()}}
    
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Título </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" class="form-control" id="titulo"name="titulo" required/>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Título (Inglés) </label>
                <div class="col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input type="text" class="form-control" id="title"name="title" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Descripción </label>
                <div class="col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required/>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="description"> Descripción (Inglés) </label>
                <div class="col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input type="text" class="form-control"  id="description" name="description" />
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
                    Crear
                    </button>
                </div>
            </div>
        </div>
   </form>
   </div>
@endsection