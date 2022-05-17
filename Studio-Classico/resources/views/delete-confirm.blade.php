@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($piece)
            <h3 class="text-center"><b>¿Realmente desea eliminar la siguiente obra?</b></h3>
            <div class="card">
                <div class="card-header"><b>{{ $piece->title }}</b></div>

                <div class="card-body">
                    <p>Compositor: {{ $piece -> author }}</p>
                    <p>Año: {{ $piece -> year }}</p>
                    <p>Duración: {{ $piece -> duration }} segundos</p>
                    <p>Tipo: {{ $piece -> type }}</p>
                    <p>Autor: {{ $piece -> user -> nickname }}</p>
                    <form action="{{route('delete-piece-post')}}" method="post">
                        @csrf
                        <input type="hidden" name="piece" value="{{$piece ->id}}"/>
                        <input type="submit" class="btn btn-danger" value="Eliminar obra" />
                    </form>
                </div>
            </div>
            @else
            <p>Esta obra no existe.</p>
            @endif
        </div>
    </div>
</div>
@endsection