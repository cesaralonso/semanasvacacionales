@extends('layouts.master')
@section('content')
    <section class="py-1">   
        <div class="container">
            <div class="row">
            <div class="col-lg-12 mb-2">
                <h3 class="Latest__title pb-1 text-center tiempo-title display-4">
                    Membresias
                </h3>
                <div class="tiempo-line-bottom-container" style="padding-bottom: .5rem;">
                    <span class="tiempo-line-bottom"></span>
                </div>
                <h4 class="text-center" style="color: #7fb2d4;">Selecciona una membresia para hacerla recomendada</h4>
            </div>
            <div class="col-md-12">
                <div class="list-group text-center" style="box-shadow: 10px 10px 5px #888888;">
                    @foreach($membresias as $membresia)
                        <a class="list-group-item list-group-item-action categoria-list" href="/su-recomendados/create/{{$membresia->id}}" class="list-group-item">
                            {{ $membresia->titulo }} -  {{ $membresia->id}}
                        </a>
                    @endforeach
                </div>

            </div>
            </div>
        </div>
    </section>
@endsection