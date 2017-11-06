@extends('layouts.master')
@section('content')
    <h3 class="Latest__title pb-1 text-center tiempo-title mt-3">
        Mis mensajes de mi membresia "{{ $correos[0]->membresia->titulo }}"
    </h3>
    <div class="tiempo-line-bottom-container margin-bottom">
        <span class="tiempo-line-bottom"></span>
    </div>
    
    <div class="container">

        @if( isset($correos) )
            @foreach($correos as $index => $correo)
                    <div class="row">
                        @if($correo->remitenteId == Session::get('USER_ID'))
                            <div class="col-md-4"></div>
                        @endif                            
                        <div class="col-md-7 pt-1 pb-1">
                            <div class="col-md-12 pt-1 pb-1" style="border-style: solid;border-width: 1px; border-color: #DEDEDE">
                                <div class="col-md-12">
                                <strong>De:</strong> {{ pv($correo, 'nombreRemitente') }}
                                </div>
                                <div class="col-md-12">
                                    <strong>Fecha:</strong> {{ pvsDat($correo, 'fechaHora') }}
                                </div>
                                <div class="col-md-12">
                                    <strong>Mensaje</strong><br>
                                    <textarea class="form-control" disabled>{{ pv($correo, 'cuerpo') }}</textarea>
                                </div>
                                @if(!($correo->remitenteId == Session::get('USER_ID')))
                                    <div class="col-md-12 text-right mt-1">
                                        <button data-toggle="modal" data-target="#exampleModalLabel-{{$index}}" class="btn btn-primary"> Responder </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalLabel-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Responder a {{ pv($correo, 'nombreRemitente')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form name="contactForm" method="POST" action="/contact-sender">
                                        <div class="modal-body">
                                                {{csrf_field()}}
                                                <input type="hidden" id="destinatario" name="destinatario" value="{{ pv($correo->remitente, 'email') }}"/>
                                                <input type="hidden" id="membresiaId"  name="membresiaId"  value="{{ pv($correo->membresia, 'id') }}"/>
                                                <input type="hidden" id="destinatarioId" name="destinatarioId" value="{{ pv($correo, 'remitenteId') }}"/>
                                                <input type="hidden" id="nombre" name="nombre" value="{{ Session::get('NAME') }}"/>
                                                <div class="form-group">
                                                    <label for="InputFile">Mensaje</label>
                                                    <textarea class="form-control" rows="5" name="cuerpo" required></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-outline-primary">Enviar <i class="fa fa-paper-plane"></i></button>                                
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!($correo->remitenteId == Session::get('USER_ID')))
                        <div class="col-md-4"></div>
                    @endif  
            @endforeach
        @endif
        </div>
@endsection