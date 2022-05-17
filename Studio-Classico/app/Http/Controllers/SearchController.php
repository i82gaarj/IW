<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Piece;
use App\Models\Instrument;

class SearchController extends Controller
{
    function search(Request $request){
        if (count($request->all()) == 0){
            $instruments = Instrument::all();
            return view('search', compact('instruments'));
        }
        else{
            $query = Piece::query();
            if (isset($request->q)){
                $query->where(function($query) use ($request){
                    $query->where('title', 'like', '%'.$request->q.'%'
                    )->orWhere('author', 'like', '%'.$request->q.'%'
                    )->orWhere('type', 'like', '%'.$request->q.'%');
                });
            }
            if (isset($request->n_instruments)){
                $request -> validate([
                    'n_instruments' => 'numeric|min:0|max:50000'
                ]);
                $query->where(function($query){
                    $query->selectRaw('sum(count)')->from('pieces_instruments')->whereColumn('piece_id', 'pieces.id');
                }, $request->n_instruments);
            }
            if (isset($request->min_duration)){
                $request -> validate([
                    'min_duration' => 'numeric|min:0|max:50000'
                ]);
                $query->where('duration', '>', $request->min_duration * 60);
            }
            if (isset($request->max_duration)){
                $request -> validate([
                    'max_duration' => 'numeric|min:0|max:50000'
                ]);
                $query->where('duration', '<', $request->max_duration * 60);
            }
            if (isset($request->instrument) && isset($request->count)){
                if (count($request->instrument) == count($request->count)){
                    for($i = 0; $i < count($request->instrument); $i++) {
                        $query->from('pieces')->wherein('id', function($query) use ($request, $i){
                            $query->select('piece_id')->from('pieces_instruments')->where('instrument_id', $request->instrument[$i])->where('count', $request->count[$i])->get();
                        });
                    }
                }
            }
            
            $pieces = $query->paginate(10);
            return view('search-results', compact('pieces'));
        }

    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
