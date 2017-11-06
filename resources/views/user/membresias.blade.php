@extends('layouts.master')
@section('content')
        <section class="ruta py-1" id="inicia">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-right">
                        <a href="/">Inicio</a> » <a href="/mi-cuenta">Mi cuenta</a> » Mis membresias
                    </div>
                </div>
            </div>
        </section>
        <section class="py-1">   
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-5 col-xl-4">
                        @include('layouts.menu-cuenta')
                    </div>
                    <div class="col-md-7 col-xl-8 padding">
                        <div class="alert alert-warning">
                            <strong>¡Promociona tu membresia!</strong> </br>
                            Adicionalmente aparecera listado en la sección especial de membresias destacadas de nuestra página principal.</br>
                            ¡Además, tu publicación será listada en la parte superior de la página de resultados que los visitantes obtengan buscando inventario!.</br>
                            Plan a 3 meses. recomendado para ofertas. $199 Pesos Mx+Imp.</br>
                            Plan a 6 meses. recomendado para renta de semanas, intercambios y ventas de inventario de alta demanda. $359 pesos Mx+Imp.</br>
                            Plan a 12 meses recomendado para reventas de menor demanda, $599 pesos Mx+Imp.</br>
                            Para contratar este nuevo servicio, haz click en el botón destacar membresia</br>
                        </div>
                        @foreach($membresias as $index => $membresia)
                            {{--  <div class="card">
                                <div class="row">
                                    <div class="col-md-4">
                                        @if ( App\User::getPrincipalImage(getClient(), $membresia->id) != null)
                                            <img src="{{$_ENV['UPLOAD_FOLDER']}}/membresias-images/thumbs/{{ App\User::getPrincipalImage(getClient(), $membresia->id)->src }}" class="card-image-desktop">
                                            <img src="{{$_ENV['UPLOAD_FOLDER']}}/membresias-images/thumbs/{{ App\User::getPrincipalImage(getClient(), $membresia->id)->src }}" class="card-image-mobile w-100">
                                        @else 
                                            <img src="assets/img/sin-imagen.jpg" class="card-image-desktop">
                                            <img src="assets/img/sin-imagen.jpg" class="card-image-mobile w-100">
                                        @endif
                                    </div>
                                        <div class="card-image-mobile col-md-8 px-3"> 
                                            <div class="card-block" style="padding-left: 0; padding-right:0;">
                                                <h4 class="card-title">{{ $membresia->titulo }}</h4>
                                                <p class="card-text">{{ $membresia->descripcion }}</p>
                                                <hr>
                                                <div>
                                                    @include('layouts.membresia-opciones')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-image-desktop col-md-8 px-3"> 
                                            <div class="card-block pl-3">
                                                <h4 class="card-title">{{ $membresia->titulo }}</h4>
                                                <p class="card-text">{{ $membresia->descripcion }}</p>
                                                <hr>
                                                <div>
                                                    @include('layouts.membresia-opciones')
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>  --}}
                            <div class="row mt-1 mb-1" style="border-style: solid;border-width: 1px; border-color: #DEDEDE">
                                <div class="col-md-5 pl-0">
                                    @if ( App\User::getPrincipalImage(getClient(), $membresia->id) != null)
                                        <img src="{{$_ENV['UPLOAD_FOLDER']}}/membresias-images/{{ App\User::getPrincipalImage(getClient(), $membresia->id)->src }}" class="card-image-desktop" style="max-width:100%">
                                    @else 
                                        <img src="assets/img/sin-imagen.jpg" class="card-image-desktop" style="max-width:100%">
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="card-title mt-1">{{ $membresia->titulo }}</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="card-text">{{ $membresia->descripcion }}</p>
                                            <hr>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            @include('layouts.membresia-opciones')                                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalLabel-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">¡Mejora tu cuenta!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                                <input type="hidden" name="cmd" value="_s-xclick">
                                                <input type="hidden" name="hosted_button_id" value="DC3VKGYPRRQFS">
                                                <input type="hidden" name="custom" value="{{$membresia->id}}">
                                                <table>
                                                    <tr><td>
                                                        <input type="hidden" name="on0" value="Planes y Precios">Planes y Precios
                                                    </td></tr><tr><td>
                                                    <select name="os0">
                                                        <option value="3 Meses">3 Meses $199.00</option>
                                                        <option value="6 Meses">6 Meses $359.00</option>
                                                        <option value="12 Meses">12 Meses $599.00</option>
                                                    </select> </td></tr>
                                                </table>
                                                <input type="hidden" name="currency_code" value="MXN">
                                                <input type="hidden" name="return" value="http://www.tiempocompartido.com/index.php"> 
                                                <input type="hidden" name="rm" value="2"> 
                                                <input type="hidden" name="notify_url" value="http://www.tiempocompartido.com/ipn_success.php"> 
                                                <input type="image" src="https://www.paypal.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en línea.">
                                                <img alt="" border="0" src="https://www.paypal.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <a href="/new-membresia" class="width-35 pull-right btn btn-success" ng-click="newMembresia()">
                        <i class="ace-icon fa fa-plus"></i>
                            Crea nueva publicación
                    </a>

                    {{--  <div class="demo">
                        <p><a href="#" data-tooltip="I’m the tooltip text.">I’m a link with a tooltip.</a></p>
                        <p><button data-tooltip="I’m the tooltip text.">I’m a button with a tooltip</button></p>
                    </div>  --}}
                </div>
            </div>
        </section>
@endsection