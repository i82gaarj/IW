@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (count($pieces) != 0)
                @foreach($pieces as $piece)
                <div class="card mt-3">
                    <div class="card-header">{{ $piece->title }}</div>

                    <div class="card-body">
                        <p>Compositor: {{ $piece -> author }}</p>
                        <p>Año: {{ $piece -> year }}</p>
                        <p>Duración: {{ $piece -> duration }} segundos</p>
                        <p>Tipo: {{ $piece -> type }}</p>
                    </div>
                </div>
                @endforeach
            @else
                <h4 class="text-center">Usted no ha subido ninguna obra.</h4>
            @endif
        </div>
    </div>
</div>
@endsection
