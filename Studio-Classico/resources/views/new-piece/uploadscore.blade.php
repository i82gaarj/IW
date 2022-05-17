@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nueva obra') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
				<h1 class="page-title">Subir partitura</h1>
				<form method="POST" action="{{ route('new-piece.upload-score-post') }}" enctype="multipart/form-data">
                        @csrf

						<div class="row mb-3">
                            <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Partitura') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" required>

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Finalizar') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(session('error'))
                        <p>{{ session('error')}}</p>
                    @endif
                    <p>Instrumentos añadidos:</p>
                    @if ($instruments_session != null)
                        @foreach($instruments_session as $instrument)
                            <p>{{$instrument['count']}}x {{$instrument['name']}}</p>
                        @endforeach
                    @else
                        <p><b>Ninguno</b></p>
                    @endif
                    <button class="btn btn-danger" onclick='window.location.href = "{{route('new-piece.cancel-get')}}"'>Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection