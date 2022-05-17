<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

	protected $table = "reports";

	protected $fillable = [
		'description'
	];

	public function piece(){
		return $this -> belongsTo(Piece::class);
	}

	public function user(){
		return $this -> belongsTo(User::class);
	}
    /*private $id;
	private $user;
	private $piece;
	private $description;
	
	function __construct($id, $user, $piece, $description){
		$this -> setID($id);
		$this -> setUser($user);
		$this -> setPiece($piece);
		$this -> setDescription($description);
	}
	
	function getID() {
		return $this -> id;
	}
	
	function getUser() {
		return $this -> user;
	}
	
	function getPiece() {
		return $this -> piece;
	}
	
	function getDescription() {
		return $this -> description;
	}
	
	function setID($id) {
		$this -> id = $id;
	}
	
	function setUser($user) {
		$this -> user = $user;
	}
	
	function setPiece($piece) {
		$this -> piece = $piece;
	}
	
	function setDescription($description) {
		$this -> description = $description;
	}*/
}
