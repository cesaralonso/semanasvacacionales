@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">    
                <h3 class="Latest__title pb-1 text-center tiempo-title">
                        Ingresa tu nueva contraseña
                </h3>
                <div class="tiempo-line-bottom-container margin-bottom">
                    <span class="tiempo-line-bottom"></span>
                </div>
            </div>              

            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="/save-reseted-password" method="POST" role="form">
                    {{csrf_field()}}
                    <input type="hidden" id="__access_token" name="__access_token" value="{{ $access_token }}">                    
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nueva contraseña</label>
                        <input type="password" class="form-control" id="new_password_reset" name="new_password_reset">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Confirma tu nueva contraseña</label>
                        <input type="password" class="form-control" id="new_password_reset_confirm" name="new_password_reset_confirm">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block" >Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>            
        </div>
    </div>

@endsection