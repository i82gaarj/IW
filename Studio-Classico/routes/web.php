<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/piece/{piece_id}', [PieceController::class, 'pieceDetails'])->name('piece-details');

Route::get('/new-piece', function(){
    return redirect('/new-piece/basic-data');
})->name('new-piece')->middleware('auth');

Route::get('/new-piece/basic-data', function(){
    if (Auth::user()->type == 'Admin'){
        return redirect(route('home'))->with('error', 'Un usuario administrador no puede subir obras');
    }
    else{
        return view('new-piece.basicdata');
    }

})->name('new-piece.basic-data-get')->middleware('auth');
Route::post('/new-piece/basic-data', [PieceController::class, 'newPieceBasicData']
)->name('new-piece.basic-data-post')->middleware('auth');

Route::get('/new-piece/instruments', [PieceController::class, 'newPieceInstrumentsView']
)->name('new-piece.add-instruments-get')->middleware('auth');

Route::get('/new-piece/add-instrument', [ErrorController::class, 'invalidAccess']);
Route::post('/new-piece/add-instrument', [PieceController::class, 'newPieceAddInstrument']
)->name('new-piece.add-instrument-post')->middleware('auth');

Route::get('/new-piece/delete-instrument', [ErrorController::class, 'invalidAccess']);
Route::post('/new-piece/delete-instrument', [PieceController::class, 'newPieceDeleteInstrument']
)->name('new-piece.delete-instrument-post')->middleware('auth');

Route::get('/new-piece/upload-score', [PieceController::class, 'newPieceUploadScoreView']
)->name('new-piece.upload-score-get')->middleware('auth');
Route::post('/new-piece/upload-score', [PieceController::class, 'newPieceUploadScoreFinish']
)->name('new-piece.upload-score-post')->middleware('auth');

Route::get('/new-piece/cancel', [PieceController::class, 'cancel']
)->name('new-piece.cancel-get')->middleware('auth');

Route::get('/piece/{piece_id}/download', [PieceController::class, 'downloadScore'])->name('download-score')->middleware('auth');

Route::get('/report-piece/{piece_id}', [ReportController::class, 'reportView'])->name('report')->middleware('auth');

Route::post('/report-piece', [ReportController::class, 'reportPiece'])->name('report-piece-post')->middleware('auth');

Route::get('/delete-piece/{piece_id}', [PieceController::class, 'deletePieceView'])->name('delete-piece-get')->middleware('auth');
Route::post('/delete-piece', [PieceController::class, 'deletePiece'])->name('delete-piece-post')->middleware('auth');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/my-pieces', [PieceController::class, 'myPieces'])->name('my-pieces')->middleware('auth');

Route::get('/reports', [ReportController::class, 'reportListView'])->name('reports')->middleware('auth');

/*Route::get('/author-list', function(){
    return view('author-list');
})->name('author-list');*/

Route::get('/about-us', function(){
    return view('about-us');
})->name('about-us');


Route::get('/modify-piece/cancel', [PieceController::class, 'cancelModify']
)->name('modify-piece.cancel-get')->middleware('auth');

Route::get('/modify-piece/{piece_id}', [PieceController::class, 'modifyPieceStart'])->name('modify-piece')->middleware('auth');

Route::get('/modify-piece/{piece_id}/basic-data', [PieceController::class, 'modifyPieceBasicDataView']
)->name('modify-piece.basic-data-get')->middleware('auth');

Route::post('/modify-piece/{piece_id}/basic-data', [PieceController::class, 'modifyPieceBasicData']
)->name('modify-piece.basic-data-post')->middleware('auth');

Route::get('/modify-piece/{piece_id}/instruments', [PieceController::class, 'modifyPieceInstrumentsView']
)->name('modify-piece.add-instruments-get')->middleware('auth');


Route::get('/modify-piece/{piece_id}/add-instrument', [ErrorController::class, 'invalidAccess']
)->name('modify-piece.add-instrument-get')->middleware('auth');

Route::get('/modify-piece/{piece_id}/delete-instrument', [ErrorController::class, 'invalidAccess']
)->name('modify-piece.delete-instrument-get')->middleware('auth');

Route::post('/modify-piece/{piece_id}/add-instrument', [PieceController::class, 'modifyPieceAddInstrument']
)->name('modify-piece.add-instrument-post')->middleware('auth');

Route::post('/modify-piece/{piece_id}/delete-instrument', [PieceController::class, 'modifyPieceDeleteInstrument']
)->name('modify-piece.delete-instrument-post')->middleware('auth');

Route::get('/modify-piece/{piece_id}/upload-score', [PieceController::class, 'modifyPieceUploadScoreView']
)->name('modify-piece.upload-score-get')->middleware('auth');
Route::post('/modify-piece/{piece_id}/upload-score', [PieceController::class, 'modifyPieceUploadScoreFinish']
)->name('modify-piece.upload-score-post')->middleware('auth');

