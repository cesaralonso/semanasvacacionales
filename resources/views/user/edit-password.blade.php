@extends('layouts.master')
@section('content')
    <section class="ruta py-1" id="inicia">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-right">
                    <a href="/">Inicio</a> » <a href="/mi-cuenta">Mi cuenta</a> » Modifica tu contraseña
                </div>
            </div>
        </div>
    </section>
     <section  class="py-1">   
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xl-4">
                    @include('layouts.menu-cuenta')
                </div>
                <div class="col-md-7 col-xl-8"> 
                    <div class="container padding">
                        <h2 class="title margin-bottom">Modifica tu contraseña</h2>
                         <form ng-controller="MainCtrl as main" method="POST" action="/guardar-contrasena" role="form" name="passwordForm">
                             {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-control-default required">
                                        <label>Contraseña actual</label>
                                        <input id="oldPassword" name="oldPassword" type="password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group " ng-class="{'has-danger': passwordForm.newPassword.$touched && passwordForm.newPassword.$invalid, 'has-success': passwordForm.newPassword.$touched && passwordForm.newPassword.$valid}">
                                        <label>Nueva contraseña</label>
                                        <input id="newPassword" name="newPassword" ng-model="newPassword" type="password" ng-minlength="7" ng-maxlength="20" ng-pattern="passwordPattern" class="form-control" required ng-class="{'form-control-danger': passwordForm.newPassword.$touched && passwordForm.newPassword.$invalid, 'form-control-success': passwordForm.newPassword.$touched && passwordForm.newPassword.$valid}">
                                        <div class="form-control-feedback" ng-messages="passwordForm.newPassword.$error" ng-show="passwordForm.newPassword.$invalid && passwordForm.newPassword.$touched">
                                            <p ng-show='passwordForm.newPassword.$error.required'>Debes completar este campo.</p>
                                            <p ng-show='passwordForm.newPassword.$error.minlength'>La contraseña debe tener por lo menos 7 carácteres.</p>
                                            <p ng-show="passwordForm.newPassword.$error.maxlength">La contraseña debe tener máximo 20 carácteres.</p>
                                            <p ng-show="passwordForm.newPassword.$error.pattern">La contraseña debe tener letras mayúsculas, minúsculas, al menos un número y sin carácteres especiales.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group " ng-class="{'has-danger': passwordForm.newPasswordConfirm.$touched && passwordForm.newPasswordConfirm.$invalid, 'has-success': passwordForm.newPasswordConfirm.$touched && passwordForm.newPasswordConfirm.$valid}">
                                        <label>Ingrese de nuevo la nueva contraseña</label>
                                        <input id="newPasswordConfirm" name="newPasswordConfirm" ng-model="newPasswordConfirm" pw-check='newPassword' type="password" class="form-control" required ng-class="{'form-control-danger': passwordForm.newPasswordConfirm.$touched && passwordForm.newPasswordConfirm.$invalid, 'form-control-success': passwordForm.newPasswordConfirm.$touched && passwordForm.newPasswordConfirm.$valid}">
                                        <div class="form-control-feedback" ng-messages="passwordForm.newPasswordConfirm.$error" ng-show="passwordForm.newPasswordConfirm.$invalid && passwordForm.newPasswordConfirm.$touched">
                                            <p ng-show='passwordForm.newPasswordConfirm.$error.required'>Debes completar este campo.</p>
                                            <p ng-show='passwordForm.newPasswordConfirm.$error.pwmatch'>Las contraseñas no coinciden.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="clearfix">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-xl pull-right" data-ng-disabled="passwordForm.$invalid">
                                                <i class="ace-icon fa fa-user"></i>
                                                Guardar Cambios
                                            </button>
                                        </div>
                                    </div>
                                </div>
                         </form>
                        
                    </div>
                </div>        
            </div>
        </div>
    </section>
   
@endsection