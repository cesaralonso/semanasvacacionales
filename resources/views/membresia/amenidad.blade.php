@extends('layouts.master')
@section('content')
    <h3 class="Latest__title pb-1 text-center tiempo-title mt-3">
        Agregue amenidades a su membresia
    </h3>
    <div class="tiempo-line-bottom-container margin-bottom">
        <span class="tiempo-line-bottom"></span>
    </div>
    
    <div class="container mb-3">
        <div class="row">
            @if(isset($allAmenidades))
                @foreach($allAmenidades as $amenidad)
                    <div class="col-md-4">
                        <div class="row" style="display: flex;justify-content: center;align-items: center;">
                            <div class="col-md-1">
                                <input onchange="selectAmenidad('{{ $amenidad[0] }}','{{ $id }}' )" type="checkbox" {{ $amenidad[2] == true ? 'checked': ''}}>
                            </div>
                            <div class="col-md-11">
                               {{ $amenidad[1] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection