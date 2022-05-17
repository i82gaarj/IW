<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $table = "pieces";

    protected $fillable = [
        'title',
		'year',
		'duration',
        'type',
        'author',
		'phone',
        'score_path'
    ];

    protected $hidden = [
        'id',
        'n_downloads',
        'n_visits',
        'upload_date',
        'instruments'
    ];

    public function instruments(){
        return $this->hasMany(InstrumentCount::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    /*private $id;
    private $title;
    private $year;
    private $duration;
    private $type;
    private $author;
    private $user;
    private $scorePath;
    private $nDownloads;
    private $nVisits;
    private $uploadDate;
    private $instruments;

    function __construct($id, $title, $author, $user, $year, $duration, $type, $scorePath, $nDownloads, $nVisits, $uploadDate, $instruments)
    {
        $this -> setID($id);
        $this -> setTitle($title);
        $this -> setAuthor($author);
        $this -> setUser($user);
        $this -> setYear($year);
        $this -> setScorePath($scorePath);
        $this -> setNDownloads($nDownloads);
        $this -> setNVisits($nVisits);
        $this -> setUploadDate($uploadDate);
        $this -> setInstruments($instruments);
    }

    function getID(){
        return $this -> id;
    }

    function getTitle(){
        return $this -> title;
    }

    function getAuthor(){
        return $this -> author;
    }

    function getUser(){
        return $this -> user;
    }

    function getScorePath(){
        return $this -> scorePath;
    }

    function getNDownloads(){
        return $this -> nDownloads;
    }

    function getNVisits(){
        return $this -> nVisits;
    }

    function getUploadDate(){
        return $this -> uploadDate;
    }

    function getInstruments(){
        return $this -> instruments;
    }

    function setID($id){
        $this -> id = $id;
    }

    function setTitle($title) {
		$this -> title = $title;
	}
	
	function setAuthor($author) {
		$this -> author = $author;
	}
	
	function setUser($user) {
		$this -> user = $user;
	}
	
	function setYear($year) {
		$this -> year = $year;
	}
	
	function setDuration($duration) {
		$this -> duration = $duration;
	}
	
	function setType($type) {
		$this -> type = $type;
	}
	
	function setScorePath($scorePath) {
		$this -> scorePath = $scorePath;
	}
	
	function setNVisits($nVisits) {
		$this -> nVisits = $nVisits;
	}
	
	function setNDownloads($nDownloads) {
		$this -> nDownloads = $nDownloads;
	}
	
	function setUploadDate($uploadDate) {
		$this -> uploadDate = $uploadDate;
	}
	
	function setInstruments($instruments){
		$this -> instruments = $instruments;
	}*/
}
