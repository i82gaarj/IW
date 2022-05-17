@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modificar obra') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
				<h1 class="page-title">Añadir instrumentos</h1>
				<p class="subtitle">Rellene el formulario</p>
				<form method="POST" action="{{ route('modify-piece.add-instrument-post', $piece->id) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Instrumento') }}</label>

                            <div class="col-md-6">
                                <select name="instrument" class="form-control @error('instrument') is-invalid @enderror" id="instrument" value="{{ old('instrument') }}" required autofocus>
                                    @foreach ($instruments as $instrument)
                                    <option value="{{ $instrument -> id }}">{{$instrument -> name}}</option>
                                    @endforeach
                                </select>
                                @error('instrument')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="row mb-3">
                            <label for="count" class="col-md-4 col-form-label text-md-end">{{ __('Cantidad') }}</label>

                            <div class="col-md-6">
                                <input id="count" type="number" class="form-control @error('count') is-invalid @enderror" name="count" value="{{ old('count') }}" required autocomplete="count">

                                @error('count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Añadir') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(session('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        {{session()->get('error')}}
                    </div>
                    @endif
                    <p>Instrumentos añadidos</p>
                    @if ($instruments_session != null)
                        @foreach($instruments_session as $instrument)
                            <form class="my-3" action="{{route('modify-piece.delete-instrument-post', $piece->id)}}" method="post">
                                @csrf
                                <div class="input-group mb-2">
                                    <p class="mx-3">{{$instrument['count']}}x {{$instrument['name']}}</p>
                                    <input type="hidden" name="instrument" value="{{$instrument['id']}}"/>
                                    <div class="input-group-append">
                                        <input type="submit" class="btn btn-danger input-group-append btn-sm" value="Eliminar" />
                                    </div>
                                </div>

                                
                            </form>
                        @endforeach
                    @else
                        <p><b>Ninguno</b></p>
                    @endif
                    <button class="btn btn-danger" onclick='window.location.href = "{{route('modify-piece.cancel-get')}}"'>Cancelar</button>
                    <button class="btn btn-primary" onclick='window.location.href = "{{route('modify-piece.upload-score-get', $piece->id)}}"'>Siguiente</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection