<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 

use Session;
use App\Models\Instrument;
use App\Models\InstrumentCount;
use App\Models\Piece;
use App\Models\User;

class PieceController extends Controller
{
    function newPieceBasicData(Request $request){
        if (Auth::user()->type == 'Admin'){
            return redirect(route('home'))->with('error', 'Un usuario administrador no puede subir obras');
        }
        else{
            $validated = $request->validate([
                'title' => 'required',
                'author' => 'required',
                'year' => 'numeric|min:0|max:4000',
                'duration' => 'numeric|min:0|max:100000',
                'type' => 'required'
            ]);

            Session::put('piece-basic', $validated);
            return redirect(route('new-piece.add-instruments-get'));
        }
    }

    function newPieceInstrumentsView(Request $request){
        if (Auth::user()->type == 'Admin'){
            return redirect(route('home'))->with('error', 'Un usuario administrador no puede subir obras');
        }
        else{
            $piece_basicdata = $request->session()->get('piece-basic');
            if (!$piece_basicdata){
                return redirect(route('new-piece.basic-data-get'));
            }
            $instruments = Instrument::all();
            $instruments_session = Session::get('piece-instruments');
            $instruments_names = array();
            if ($instruments_session != null){
                foreach ($instruments_session as $i){
                    $instrument_name = Instrument::where('id', $i['instrument'])->pluck('name')[0];
                    array_push($instruments_names, ['id' => $i['instrument'], 'name' => $instrument_name, 'count' => $i['count']]);
                }
                $instruments_session = $instruments_names;
            }
            return view('new-piece.addInstruments', compact('instruments', 'instruments_session'));
        }
    }

    function newPieceAddInstrument(Request $request){
        $validated = $request->validate([
            'instrument' => 'numeric|exists:instruments,id',
            'count' => 'numeric|min:1|max:1000'
        ]);

        $instruments_session = Session::get('piece-instruments');

        if (!$instruments_session){
            $instruments_session = array();
            array_push($instruments_session, $validated);
            Session::put('piece-instruments', $instruments_session);
        }
        else{
            foreach ($instruments_session as $instrument_session){
                if ($instrument_session['instrument'] == $validated['instrument']){
                    return redirect(route('new-piece.add-instruments-get'))->with('error', 'Este instrumento ya se ha añadido.');
                }
            }
            array_push($instruments_session, $validated);
            Session::put('piece-instruments', $instruments_session);
        }
        return redirect(route('new-piece.add-instruments-get'));
    }

    function newPieceDeleteInstrument(Request $request){
        $validated = $this->validate($request, [
            'instrument' => 'required|exists:instruments,id',
        ]);
        $instruments_session = Session::get('piece-instruments');
        if (!$instruments_session){
            return redirect(route('new-piece.add-instruments-get'))->with('error', "Error al borrar: No hay ningún instrumento añadido");
        }
        else{
            foreach ($instruments_session as $k => $v){
                foreach ($v as $k2 => $v2){
                    if ($k2 == 'instrument' && $v2 == $validated['instrument']){
                        unset($instruments_session[$k]);
                        Session::put('piece-instruments', $instruments_session);
                        return redirect(route('new-piece.add-instruments-get'));
                    }
                }
                
            }
            return redirect(route('new-piece.add-instruments-get'))->with('error', "Error al borrar: no se encuentra este instrumento");
        }
    }

    function newPieceUploadScoreView(Request $request){
        if (Auth::user()->type == 'Admin'){
            return redirect(route('home'))->with('error', 'Un usuario administrador no puede subir obras');
        }
        else{
            $piece_basicdata = $request->session()->get('piece-basic');
            $instruments_session = $request->session()->get('piece-instruments');
            if (!$piece_basicdata){
                return redirect(route('new-piece.basic-data-get'));
            }
            $instruments = Instrument::all();
    
            $instruments_names = array();
            if ($instruments_session != null){
                foreach ($instruments_session as $i){
                    $instrument_name = Instrument::where('id', $i['instrument'])->pluck('name')[0];
                    array_push($instruments_names, ['id' => $i['instrument'], 'name' => $instrument_name, 'count' => $i['count']]);
                }
                $instruments_session = $instruments_names;
            }
    
            return view('new-piece.uploadscore', compact('instruments_session'));
        }
    }

    function newPieceUploadScoreFinish(Request $request){
        $request -> validate([
            'file' => 'required|max:50000'
        ]);

        $piece_basicdata = $request->session()->get('piece-basic');
        $piece_instruments = $request->session()->get('piece-instruments');

        if (!$piece_basicdata || !$piece_instruments){
            return redirect(route('new-piece.upload-score-get'))->with('error', 'No se han podido encontrar los datos de la obra');
        }

        if ($request->file){
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $request->file->move(public_path('pieces'), $file_name);

            $piece_title = $piece_basicdata['title'];
            $piece_author = $piece_basicdata['author'];
            $piece_type = $piece_basicdata['type'];
            $piece_duration = $piece_basicdata['duration'];
            $piece_year = $piece_basicdata['year'];

            $piece = new Piece;
            $piece->file_name = time().'_'.$request->file->getClientOriginalName();
            $piece->title = $piece_title;
            $piece->author = $piece_author;
            $piece->year = $piece_year;
            $piece->duration = $piece_duration;
            $piece->type = $piece_type;
            $piece->user_id = Auth::user()->id;
            $piece->save();

            
            $instruments_obj = array();
            foreach ($piece_instruments as $i){
                $instrument_count = new InstrumentCount;
                $instrument_count->count = $i['count'];
                $instrument_count->piece_id = $piece->id;
                $instrument_count->instrument_id = $i['instrument'];
                $instrument_count->save();
            }

            $request->session()->forget('piece-instruments');
            $request->session()->forget('piece-basic');
            return redirect(route('home'))->with('msg', 'Obra subida correctamente');
        }
        else{
            return redirect(route('new-piece.upload-score-get'))->with('error', 'No se ha subido ningún archivo');
        }

    }

    function cancel(Request $request){
        $piece_basicdata = $request->session()->get('piece-basic');
        $piece_instruments = $request->session()->get('piece-instruments');
        if (!$piece_basicdata){
            $error_controller = new ErrorController;
            return $error_controller->invalidAccess();
        }
        else{
            $request->session()->forget('piece-instruments');
            $request->session()->forget('piece-basic');
            return redirect(route('home'))->with('msg', 'Se ha cancelado la creación de la obra');
        }
    }

    function myPieces(Request $request){
        $pieces = Piece::where('user_id', Auth::user()->id)->get();
        return view('my-pieces', compact('pieces'));
    }

    function pieceDetails(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if ($piece != null){
            $piece -> n_visits += 1;
            $piece -> save();
            $instruments = InstrumentCount::where('piece_id', $piece->id)->get();
            $piece -> instruments = $instruments;
        }
        return view('piece-details', compact('piece'));
    }

    function downloadScore(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        $file_name = $piece->file_name;
        $file_path = public_path('pieces/' . $file_name);
        if (!file_exists($file_path)){
            return redirect(route('home'))->with('error', 'No hemos podido encontrar el archivo');
        }

    	//$headers = ['Content-Type: application/pdf'];

    	$file_name_download = $file_name;

        $piece -> n_downloads += 1;
        $piece -> save();
    	return response()->download($file_path, $file_name_download);

    }

    function deletePieceView(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if ($piece != null){
            $piece_author = $piece->user_id;
            if (Auth::user()->id == $piece_author || Auth::user()->type == 'Admin'){
                return view('delete-confirm', compact('piece'));
                
            }
            return redirect(route('home'))->with('error', 'No puede eliminar una obra que no es suya');
        }
        else{
            return redirect(route('home'))->with('error', 'Esta obra no existe');;
        }
    }

    function deletePiece(Request $request){
        $piece = Piece::where('id', $request->piece)->first();
        if ($piece != null){
            $piece_author = $piece->user_id;
            $piece_file = $piece->file_name;
            if (Auth::user()->id == $piece_author || Auth::user()->type == 'Admin'){
                $res = Piece::where('id', $request->piece)->delete();
                if ($res){
                    if(File::exists(public_path('pieces/' . $piece_file))){
                        File::delete(public_path('pieces/' . $piece_file));
                    }
                    else{
                        return redirect(route('home'))->with('msg', 'Obra eliminada. Sin embargo, el fichero correspondiente no se ha podido encontrar.');
                    }
                    return redirect(route('home'))->with('msg', 'Obra eliminada correctamente.');
                }
                else {
                    return redirect(route('home'))->with('error', 'Se ha producido un error al eliminar la obra. Inténtalo de nuevo.');
                }
            }
            else{
                return redirect(route('home'))->with('error', 'No puede eliminar una obra que no es suya.');
            }
        }
        else{
            return redirect(route('home'))->with('error', 'Ha intentado eliminar una obra que ya no existe.');
        }

    }

    function modifyPieceStart(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if ($piece != null){
            if (Auth::user()->type == 'Admin' || Auth::user()->id == $piece->user->id){
                return redirect(route('modify-piece.basic-data-get', $piece->id));
            }
            else{
                return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
            }
        }
        else{
            return redirect(route('home'))->with('error', 'Esta obra no existe');
        }
    }

    function modifyPieceBasicDataView(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if ($piece != null){
            if (Auth::user()->type == 'Admin' || Auth::user()->id == $piece->user->id){
                return view('modify-piece.basic-data', compact('piece'));
            }
            else{
                return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
            }
        }
        else{
            return redirect(route('home'))->with('error', 'Esta obra no existe');
        }
    }

    function modifyPieceBasicData(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if (Auth::user()->id != ($piece->user->id) && Auth::user()->type != 'Admin'){
            return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
        }
        else{
            $validated = $this->validate($request, [
                'title' => 'required',
                'author' => 'required',
                'year' => 'required|min:0|max:4000',
                'duration' => 'required|min:0|max:100000',
                'type' => 'required'
            ]);

            Session::put('piece-basic-mod', $validated);
            Session::forget('piece-instruments-mod');

            $piece_instruments = $piece->instruments;
            $instruments_session = array();
            foreach ($piece_instruments as $i){
                $instrument = $i->instrument->id;
                $count = $i->count;
                array_push($instruments_session, ['instrument' => $instrument, 'count' => $count]);
            }
            
            Session::put('piece-instruments-mod', $instruments_session);
            
            return redirect(route('modify-piece.add-instruments-get', $piece_id));
        }
    }

    function modifyPieceInstrumentsView(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if (Auth::user()->id != ($piece->user->id) && Auth::user()->type != 'Admin'){
            return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
        }
        else{
            $piece_basicdata = $request->session()->get('piece-basic-mod');
            if (!$piece_basicdata){
                return redirect(route('new-piece.basic-data-get'));
            }
            $instruments = Instrument::all();
            $instruments_session = Session::get('piece-instruments-mod');
            $instruments_names = array();
            if ($instruments_session != null && count($instruments_session) != 0){
                foreach ($instruments_session as $i){
                    $instrument_name = Instrument::where('id', $i['instrument'])->pluck('name')[0];
                    array_push($instruments_names, ['id' => $i['instrument'], 'name' => $instrument_name, 'count' => $i['count']]);
                }
                $instruments_session = $instruments_names;
            }
            return view('modify-piece.addInstruments', compact('instruments', 'instruments_session', 'piece'));
        }
    }

    function modifyPieceAddInstrument(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if (Auth::user()->id != ($piece->user->id) && Auth::user()->type != 'Admin'){
            return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
        }
        else{
            $validated = $this->validate($request, [
                'instrument' => 'required|exists:instruments,id',
                'count' => 'required|min:1|max:1000'
            ]);

            $instruments_session = Session::get('piece-instruments-mod');

            if (!$instruments_session){
                $instruments_session = array();
                array_push($instruments_session, $validated);
                Session::put('piece-instruments-mod', $instruments_session);
            }
            else{
                foreach ($instruments_session as $instrument_session){
                    if ($instrument_session['instrument'] == $validated['instrument']){
                        return redirect(route('modify-piece.add-instruments-get', $piece->id))->with('error', 'Error: Este instrumento ya se ha añadido.');
                    }
                }
                array_push($instruments_session, $validated);
                Session::put('piece-instruments-mod', $instruments_session);
            }
            return redirect(route('modify-piece.add-instruments-get', $piece->id));
        }
    }

    function modifyPieceDeleteInstrument(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if (Auth::user()->id != ($piece->user->id) && Auth::user()->type != 'Admin'){
            return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
        }
        else{
            $validated = $this->validate($request, [
                'instrument' => 'required|exists:instruments,id',
            ]);
            $instruments_session = Session::get('piece-instruments-mod');
            if (!$instruments_session){
                return redirect(route('modify-piece.add-instruments-get', $piece->id))->with('error', "Error al borrar: No hay ningún instrumento añadido");
            }
            else{
                foreach ($instruments_session as $k => $v){
                    foreach ($v as $k2 => $v2){
                        if ($k2 == 'instrument' && $v2 == $validated['instrument']){
                            unset($instruments_session[$k]);
                            Session::put('piece-instruments-mod', $instruments_session);
                            return redirect(route('modify-piece.add-instruments-get', $piece->id));
                        }
                    }
                }
                return redirect(route('modify-piece.add-instruments-get'))->with('error', "Error al borrar: no se encuentra este instrumento");
            }
        }
    }

    function modifyPieceUploadScoreView(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if (Auth::user()->id != ($piece->user->id) && Auth::user()->type != 'Admin'){
            return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
        }
        else{
            $piece_basicdata = $request->session()->get('piece-basic-mod');
            $instruments_session = $request->session()->get('piece-instruments-mod');
            if (!$piece_basicdata){
                return redirect(route('modify-piece', $piece->id));
            }
            $instruments = Instrument::all();
    
            $instruments_names = array();
            if ($instruments_session != null){
                foreach ($instruments_session as $i){
                    $instrument_name = Instrument::where('id', $i['instrument'])->pluck('name')[0];
                    array_push($instruments_names, ['id' => $i['instrument'], 'name' => $instrument_name, 'count' => $i['count']]);
                }
                $instruments_session = $instruments_names;
            }
    
            return view('modify-piece.uploadscore', compact('instruments_session', 'piece'));
        }
    }

    function modifyPieceUploadScoreFinish(Request $request, $piece_id){
        $piece = Piece::where('id', $piece_id)->first();
        if (Auth::user()->id != ($piece->user->id) && Auth::user()->type != 'Admin'){
            return redirect(route('home'))->with('error', 'No puede modificar una obra que no es suya.');
        }
        else{
            $request -> validate([
                'file' => 'required'
            ]);

            $piece_basicdata = $request->session()->get('piece-basic-mod');
            $piece_instruments = $request->session()->get('piece-instruments-mod');
            $piece_file = $piece->file_name;

            if (!$piece_basicdata || !$piece_instruments){
                return redirect(route('modify-piece.upload-score-get'))->with('error', 'No se han podido encontrar los datos de la obra');
            }

            if ($request->file){
                $file_name = time().'_'.$request->file->getClientOriginalName();

                $piece_title = $piece_basicdata['title'];
                $piece_author = $piece_basicdata['author'];
                $piece_type = $piece_basicdata['type'];
                $piece_duration = $piece_basicdata['duration'];
                $piece_year = $piece_basicdata['year'];

                $piece->file_name = time().'_'.$request->file->getClientOriginalName();
                $piece->title = $piece_title;
                $piece->author = $piece_author;
                $piece->year = $piece_year;
                $piece->duration = $piece_duration;
                $piece->type = $piece_type;
                
                InstrumentCount::where('piece_id', $piece->id)->delete();

                if(File::exists(public_path('pieces/' . $piece_file))){
                    File::delete(public_path('pieces/' . $piece_file));
                }
                $request->file->move(public_path('pieces'), $file_name);

                $piece->save();
                $instruments_obj = array();
                foreach ($piece_instruments as $i){
                    $instrument_count = new InstrumentCount;
                    $instrument_count->count = $i['count'];
                    $instrument_count->piece_id = $piece->id;
                    $instrument_count->instrument_id = $i['instrument'];
                    $instrument_count->save();
                }

                $request->session()->forget('piece-instruments-mod');
                $request->session()->forget('piece-basic-mod');
                return redirect(route('home'))->with('msg', 'Obra modificada correctamente');
            }
            else{
                return redirect(route('modify-piece.upload-score-get'))->with('error', 'No se ha subido ningún archivo');
            }
        }
    }

    function cancelModify(Request $request){
        $piece_basicdata = $request->session()->get('piece-basic-mod');
        $piece_instruments = $request->session()->get('piece-instruments-mod');
        if (!$piece_basicdata){
            return redirect(route('home'))->with('error', 'Acceso inválido');
        }
        else{
            $request->session()->forget('piece-instruments-mod');
            $request->session()->forget('piece-basic-mod');
            return redirect(route('home'))->with('msg', 'Se ha cancelado la modificación de la obra');
        }
    }
}
