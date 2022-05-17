@extends('layouts.app')
@section('title')
Equipo de desarrollo - 
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center">Equipo de desarrollo</h3>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="card m-2" style="width: 14.2rem;">
                    <div class="card-header text-center"><b>{{ __('Gonzalo Bolaños Campos') }}</b></div>
                    <img class="card-img-top" src="/gbc.png" />
                    <div class="card-body text-center">
                        Modelado y diseño
                    </div>
                </div>
                <div class="card m-2" style="width: 14.2rem;">
                    <div class="card-header text-center"><b>{{ __('José Carlos Cobos López') }}</b></div>
                    <img class="card-img-top" src="/jccl.png" />
                    <div class="card-body text-center">
                        BBDD y Pruebas
                    </div>
                </div>
                <div class="card m-2" style="width: 14.2rem;">
                    <div class="card-header text-center"><b>{{ __('Emilio García Gutiérrez') }}</b></div>
                    <img class="card-img-top" src="/egg.png" />
                    <div class="card-body text-center">
                        Frontend
                    </div>
                </div>
                <div class="card m-2" style="width: 14.2rem;">
                    <div class="card-header text-center"><b>{{ __('Jaime García Arjona') }}</b></div>
                    <img class="card-img-top" src="/jga.png" />
                    <div class="card-body text-center">
                        Backend
                    </div>
                </div>
                <div class="card m-2" style="width: 14.2rem;">
                    <div class="card-header text-center"><b>{{ __('Fernando Lucena Fernández') }}</b></div>
                    <img class="card-img-top" src="/flf.png" />
                    <div class="card-body text-center">
                        Scrum Master
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection