<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Piece;
use App\Models\Report;

class ReportController extends Controller
{
    function reportView(Request $request, $piece_id){
        if (Auth::user()->type == 'Admin'){
            return redirect(route('home'))->with('error', 'Como administrador no puede enviar reportes.');
        }
        $piece = Piece::where('id', $piece_id)->first();
        return view('report-piece', compact('piece'));
    }

    function reportListView(Request $request){
        if (Auth::user()->type != 'Admin'){
            return redirect(route('home'))->with('error', 'Usted no puede ver la lista de reportes.');
        }
        $reports = Report::orderBy('created_at', 'desc')->get();
        return view('report-list', compact('reports'));
    }

    function reportPiece(Request $request){
        if (Auth::user()->type == 'Admin'){
            return redirect(route('home'))->with('error', 'Como administrador no puede enviar reportes.');
        }
        $validated = $this->validate($request, [
            'desc' => 'required',
            'piece' => 'required'
        ]);

        $report = new Report;
        $report -> description = $validated['desc'];
        $report -> user_id = Auth::user()->id;
        $report -> piece_id = $validated['piece'];
        $report -> save();
        return redirect(route('home'))->with('msg', 'Obra reportada correctamente. Gracias por su colaboración.');
    }
}
