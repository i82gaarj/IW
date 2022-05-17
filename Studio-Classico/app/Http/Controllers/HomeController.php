<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Piece;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pieces_ranking_duration = Piece::orderBy('duration', 'desc')->take(10)->get();
        $pieces_ranking_popularity = Piece::orderBy('n_downloads', 'desc')->take(10)->get();
        $pieces_ranking_antiquity = Piece::orderBy('year', 'asc')->take(10)->get();
        return view('home', compact('pieces_ranking_duration', 'pieces_ranking_popularity', 'pieces_ranking_antiquity'));
    }
}
