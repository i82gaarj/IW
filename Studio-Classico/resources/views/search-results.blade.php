@extends('layouts.app')

@section('title')
Resultados de la búsqueda - 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{route('search')}}" method="GET">
                    <div class="input-group">
                            <input name="q" type="search" class="form-control rounded" placeholder="" aria-label="Buscar" aria-describedby="search-addon" required/>
                            <button type="submit" class="btn btn-outline-primary">Buscar</button>
                    </div>
                </form>
            </div>

            <h3 class="pt-3">Resultados de la búsqueda</h3>
            @if (count($pieces) == 0 || !$pieces)
                <p>No se ha encontrado ninguna obra con los filtros especificados.</p>
            @endif
            @foreach($pieces as $piece)
                <div class="card mt-3">
                    <div class="card-header">{{ $piece->title }}</div>

                    <div class="card-body">
                        <p>Compositor: {{ $piece -> author }}</p>
                        <p>Año: {{ $piece -> year }}</p>
                        <a href="{{route('piece-details', $piece->id)}}" ><button class="btn btn-outline-primary">Detalles</button></a>
                    </div>
                </div>
            @endforeach
            @if (count($pieces) > 0)
                {{$pieces->withQueryString()->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
