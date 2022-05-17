@extends('layouts.app')

@section('title')
@if ($piece)
Detalles de la obra "{{$piece -> title}}" - 
@endif
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
            @if($piece != null)
            <div class="card">
                <div class="card-header"><b>{{ $piece->title }}</b></div>

                <div class="card-body">
                    <p>Compositor: {{ $piece -> author }}</p>
                    <p>Año: {{ $piece -> year }}</p>
                    <p>Duración: {{ gmdate("H:i:s", $piece -> duration) }}</p>
                    <p>Tipo: {{ $piece -> type }}</p>
                    <p>Autor: {{ $piece -> user -> nickname }} ({{ $piece -> user -> firstname }} {{ $piece -> user -> lastname }})</p>
                    <p>Instrumentos necesarios:
                    @if ($piece->instruments && count($piece->instruments) > 0)
                        @foreach ($piece->instruments as $i)
                            {{$i->count}}x {{$i->instrument->name}}
                            @if(!$loop->last)
                            {{__(',')}}
                            @endif
                        @endforeach
                    @else
                        No especificado
                    @endif
                    </p>
                    <a class="btn btn-primary" href="{{route('download-score', $piece -> id)}}">Descargar partitura</a>
                    @if(Auth::check())
                        @if($piece -> user -> id == Auth::user()->id || Auth::user()->type == 'Admin')
                            <a class="btn btn-primary" href="{{route('modify-piece', $piece->id)}}">Modificar obra</a>
                            <a class="btn btn-primary" href="{{route('delete-piece-get', $piece->id)}}">Eliminar obra</a>
                        @endif
                        @if(Auth::user()->type == 'User')
                        <a class="btn btn-primary" href="{{route('report', $piece->id)}}">Reportar obra</a>
                        @endif
                    @endif
                    <div class="mt-3" style="min-height: 50px">
                        <img src="/twitter.png" width="24" class="social-icon" onclick="compartirObraTwitter();"></img>
                        <img src="/facebook.png" width="24" class="social-icon" onclick="compartirObraFacebook();"></img>
                        <img src="/linkedin.png" width="24" class="social-icon" onclick="compartirObraLinkedin();"></img>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                Esta obra no existe.
            </div>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
function compartirObraTwitter(){
    var path='https://twitter.com/intent/tweet?text=Mira esta obra: ' + window.location.href;
    window.open(path,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}

function compartirObraFacebook(){
    var path='https://www.facebook.com/sharer/sharer.php?u=' + window.location.href;
    window.open(path,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}

function compartirObraLinkedin(){
    var path='http://www.linkedin.com/shareArticle?mini=true&url=' + window.location.href;
    window.open(path,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}

</script>
@endsection