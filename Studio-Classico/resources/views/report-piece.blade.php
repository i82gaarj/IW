@extends('layouts.app')

@section('title')
Reportar obra - 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('msg'))
            <div class="alert alert-success" role="alert">
                {{session()->get('msg')}}
            </div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{session()->get('error')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Reportar obra') }} "{{ $piece->title }}"</div>

                <div class="card-body">
                <form method="POST" action="{{ route('report-piece-post') }}">
                        @csrf

                        <div class="row mb-3">
                            <input type="hidden" name="piece" value="{{$piece->id}}" required>
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required autocomplete="desc" autofocus>
                                </textarea>

                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
