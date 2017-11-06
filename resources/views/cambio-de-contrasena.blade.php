@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">    
                <h3 class="Latest__title pb-1 text-center tiempo-title">
                        Ingresa tu correo
                </h3>
                <div class="tiempo-line-bottom-container margin-bottom">
                    <span class="tiempo-line-bottom"></span>
                </div>
            </div>              

            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="/send-confirmation-password" method="POST" role="form">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block" >Aceptar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>            
        </div>
    </div>

@endsection