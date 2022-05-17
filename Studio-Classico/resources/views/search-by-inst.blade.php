@extends('layouts.app')

@section('title')
Búsqueda avanzada - 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('search')}}" method="GET">
                <input name="q" type="search" class="form-control rounded mb-3" placeholder="Título/Compositor/Tipo" aria-label="Buscar" aria-describedby="search-addon" required/>
                <!--<select name="instrument" class="form-control @error('instrument') is-invalid @enderror" id="instrument" value="{{ old('instrument') }}" required autofocus>
                    @foreach ($instruments as $instrument)
                    <option value="{{ $instrument -> id }}">{{$instrument -> name}}</option>
                    @endforeach
                </select>-->
                <label for="n_instruments">Número de músicos</label>
                <input type="number" name="n_instruments" class="form-control"/>
                    <label for="n_instruments">Duración mínima (minutos)</label>
                    <input type="number" name="min_duration" class="form-control"/>
                    <label for="n_instruments">Duración máxima (minutos)</label>
                    <input type="number" name="max_duration" class="form-control"/>
                <button type="submit" class="btn btn-outline-primary mt-3">Buscar</button>
            </form>
            <button href="" class="mt-3 btn btn-primary">Filtrar por tipo de instrumentos</button>
        </div>
    </div>
</div>
@endsection
