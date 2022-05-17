@extends('layouts.app')

@section('title')
Búsqueda avanzada - 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Búsqueda avanzada</h3>
            <button id="filtradoTButton" onclick="filtradoTInstrumentos();" class="mb-3 btn btn-primary">Filtrar por tipo de instrumentos</button>
            <button id="filtradoNButton" onclick="filtradoNInstrumentos();" style="display: none;" class="mb-3 btn btn-primary">Filtrar por número de instrumentos</button>
            <form id="filtradoN" action="{{route('search')}}" method="GET">
                <input name="q" type="search" class="form-control rounded" placeholder="Título/Compositor/Tipo"/>
                
                <label class="mt-3" for="n_instruments">Número de instrumentos</label>
                <input type="number" name="n_instruments" min="0" class="form-control @error('n_instruments') is-invalid @enderror"/>
                @error('n_instruments')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="mt-3" for="min_duration">Duración mínima (minutos)</label>
                <input type="number" name="min_duration" min="0" class="form-control @error('min_duration') is-invalid @enderror"/>
                @error('min_duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="mt-3" for="max_duration">Duración máxima (minutos)</label>
                <input type="number" name="max_duration" min="0" class="form-control @error('max_duration') is-invalid @enderror"/>
                @error('max_duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit" class="btn btn-outline-primary mt-3">Buscar</button>
            </form>
            <form id="filtradoT" action="{{route('search')}}" style="display: none;" method="GET">
                <input name="q" type="search" class="form-control rounded mb-3" placeholder="Título/Compositor/Tipo" aria-label="Buscar" aria-describedby="search-addon"/>

                <span>Cantidad e instrumento:</span>
                <div class="input-group" id="instrumentFilterGroup">
                    <input type="number" name="count[]" min="1" class="form-control w-25"/>
                    @error('count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <select name="instrument[]" class="w-50 form-control" id="instrument" required autofocus>
                        @foreach ($instruments as $instrument)
                        <option value="{{ $instrument -> id }}">{{ $instrument -> name }}</option>
                        @endforeach
                    </select>
                    <input type="button" onclick="addInstrument();" id="buttonplus" class="btn btn-outline-primary" value="+" />
                    <input type="button" style="visibility: hidden;" onclick="removeInstrument(this);" id="buttonminus" class="btn btn-outline-danger" value="-" />
                </div>

                <label class="mt-3" for="min_duration">Duración mínima (minutos)</label>
                <input type="number" name="min_duration" min="0" class="form-control @error('min_duration') is-invalid @enderror"/>
                @error('min_duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="mt-3" for="max_duration">Duración máxima (minutos)</label>
                <input type="number" name="max_duration" min="0" class="form-control @error('max_duration') is-invalid @enderror"/>
                @error('max_duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit" class="btn btn-outline-primary mt-3">Buscar</button>
            </form>
            
        </div>
    </div>
</div>
<script type="text/javascript">
    function filtradoNInstrumentos(){
        document.getElementById('filtradoT').style.display = 'none';
        document.getElementById('filtradoTButton').style.display = 'block';
        document.getElementById('filtradoN').style.display = 'block';
        document.getElementById('filtradoNButton').style.display = 'none';
    }

    function filtradoTInstrumentos(){
        document.getElementById('filtradoT').style.display = 'block';
        document.getElementById('filtradoN').style.display = 'none';
        document.getElementById('filtradoNButton').style.display = 'block';
        document.getElementById('filtradoTButton').style.display = 'none';
    }

    function addInstrument(){
        var orig = document.getElementById('instrumentFilterGroup');
        var clone = orig.cloneNode(true);
        Array.from(clone.children).forEach(child => {
            if (child.getAttribute('id') === 'buttonminus') {
                child.style.visibility = 'visible';
            }
        })
        /*clone.removeChild(buttonplus);*/

        clone.removeAttribute("id");

        document.getElementById("filtradoT").insertBefore(clone, orig.nextSibling);
    }

    function removeInstrument(btn){
        console.log(btn)
        btn.parentElement.remove();
    }
</script>
@endsection
