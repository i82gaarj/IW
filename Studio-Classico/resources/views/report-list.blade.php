@extends('layouts.app')

@section('title')
Últimos reportes - 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Listado de reportes') }}</div>

                <div class="card-body">
                @if (count($reports) == 0)
                    <p>No hay ningún reporte</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Obra</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                            <td><a href="{{route('piece-details', $report -> piece->id)}}">{{ $report -> piece -> title }}</a></td>
                            <td>{{ $report -> description }}</td>
                            <td>{{ $report -> user -> nickname }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                @if (count($reports) > 0)
                    {{ $reports->links() }}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
