<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentCount extends Model
{
    use HasFactory;

    protected $table = "pieces_instruments";

    protected $fillable = [
        'count',
        'instrument_id'
    ];

    public function piece(){
        return $this->belongsTo(Piece::class);
    }

    public function instrument(){
        return $this->belongsTo(Instrument::class);
    }

}