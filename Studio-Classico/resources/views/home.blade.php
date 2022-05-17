@extends('layouts.app')

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
            <h1 class="text-center"><b>Studio Classico 🎼</b></h1>
            <h4 class="text-center">Encuentra y crea tu propio contenido</h4>
            <form action="{{route('search')}}" method="GET">
                <div class="input-group">
                    <input name="q" type="search" class="form-control rounded" placeholder="¿Qué estás buscando?" aria-label="Buscar" aria-describedby="search-addon" required/>
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </div>
            </form>
            <div class="pt-3">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mx-1" onclick="tablaDuracion();">Duración</button>
                    <button class="btn btn-primary mx-1" onclick="tablaPopularidad();">Popularidad</button>
                    <button class="btn btn-primary mx-1" onclick="tablaAntiguedad();">Antigüedad</button>
                </div>
            </div>
            <div class="pt-3">
                <div id="tabla-ranking-duracion" class="card">
                    <div class="card-header text-center">{{ __('Ranking de obras por duración') }}</div>

                    <div class="card-body">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Año</th>
                            <th scope="col">Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pieces_ranking_duration as $piece)
                            <tr>
                            <td><a href="{{route('piece-details', $piece->id)}}">{{strlen($piece->title) > 13 ? substr($piece->title,0,13)."..." : $piece->title;}}</a></td>
                            <td>{{strlen($piece->author) > 11 ? substr($piece->author,0,11)."..." : $piece->author;}}</td>
                            <td>{{$piece->year}}</td>
                            <td>{{ gmdate("H:i:s", $piece -> duration) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" id="tabla-ranking-popularidad" style="display: none;">
                    <div class="card-header text-center">{{ __('Ranking de obras por popularidad') }}</div>
                    <div class="card-body">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Año</th>
                            <th scope="col">Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pieces_ranking_popularity as $piece)
                            <tr>
                            <td><a href="{{route('piece-details', $piece->id)}}">{{strlen($piece->title) > 13 ? substr($piece->title,0,13)."..." : $piece->title;}}</a></td>
                            <td>{{strlen($piece->author) > 11 ? substr($piece->author,0,11)."..." : $piece->author;}}</td>
                            <td>{{$piece->year}}</td>
                            <td>{{ gmdate("H:i:s", $piece -> duration) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" id="tabla-ranking-antiguedad" style="display: none;" >
                    <div class="card-header text-center">{{ __('Ranking de obras por antigüedad') }}</div>

                    <div class="card-body">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Año</th>
                            <th scope="col">Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pieces_ranking_antiquity as $piece)
                            <tr>
                            <td><a href="{{route('piece-details', $piece->id)}}">{{strlen($piece->title) > 13 ? substr($piece->title,0,13)."..." : $piece->title;}}</a></td>
                            <td>{{strlen($piece->author) > 11 ? substr($piece->author,0,11)."..." : $piece->author;}}</td>
                            <td>{{$piece->year}}</td>
                            <td>{{ gmdate("H:i:s", $piece -> duration) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function tablaDuracion(){
        document.getElementById('tabla-ranking-popularidad').style.display = 'none';
        document.getElementById('tabla-ranking-antiguedad').style.display = 'none';
        document.getElementById('tabla-ranking-duracion').style.display = 'block';
    }

    function tablaPopularidad(){
        document.getElementById('tabla-ranking-popularidad').style.display = 'block';
        document.getElementById('tabla-ranking-antiguedad').style.display = 'none';
        document.getElementById('tabla-ranking-duracion').style.display = 'none';
    }

    function tablaAntiguedad(){
        document.getElementById('tabla-ranking-popularidad').style.display = 'none';
        document.getElementById('tabla-ranking-antiguedad').style.display = 'block';
        document.getElementById('tabla-ranking-duracion').style.display = 'none';
    }
</script>
@endsection
