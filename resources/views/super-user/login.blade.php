@extends('layouts.master')
@section('content')
    <div id="inicio" class="container padding">
    <h1 class="title margin-bottom">Ingresa</h1>
    <form ng-controller="MainCtrl as main"method="POST" action="/su-login" name="loginForm" role="form" novalidate>
            {{csrf_field()}}

            <div class="form-group " ng-class="{'has-danger': loginForm.email.$touched && loginForm.email.$invalid, 'has-success': loginForm.email.$touched && loginForm.email.$valid}">
                <label>Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required ng-model="data.email" ng-class="{'form-control-danger': loginForm.email.$touched && loginForm.email.$invalid}">
                <div class="form-control-feedback" ng-messages="loginForm.email.$error" ng-show="loginForm.email.$invalid && loginForm.email.$touched">
                    <p>Email invalido.</p>
                </div>
            </div>
            <div class="form-group " ng-class="{'has-success': loginForm.password.$touched && loginForm.password.$valid}">
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="clearfix">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-xl pull-right"  data-ng-disabled="loginForm.$invalid">
                        <i class="ace-icon fa fa-user"></i>
                        Ingresar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection