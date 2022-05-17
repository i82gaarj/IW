<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
		'lastname',
		'nickname',
        'email',
        'password',
		'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*private $id;
	private $nickname;
	private $password;
	private $phone;
	private $firstName;
	private $lastName;
	private $email;
	private $type;
	//$id, $nickname, $password, $phone, $firstname, $lastname, $email, $type
	function __construct(){
		/*$this -> setID($id);
		$this -> setNickname($nickname);
		$this -> setPassword($password);
		$this -> setPhone($phone);
		$this -> setFirstName($firstname);
		$this -> setLastName($lastname);
		$this -> setEmail($email);
		$this -> setType($type);
	}
	
	function getID() {
		return $this -> id;
	}
	
	function getNickname() {
		return $this -> nickname;
	}
	
	function getPassword() {
		return $this -> password;
	}
	
	function getPhone() {
		return $this -> phone;
	}
	
	function getFirstName() {
		return $this -> firstName;
	}
	
	function getLastName() {
		return $this -> lastName;
	}
	
	function getEmail() {
		return $this -> email;
	}
	
	function getType() {
		return $this -> type;
	}
	
	function setID($id) {
		$this -> id = $id;
	}
	
	function setNickname($nickname) {
		$this -> nickname = $nickname;
	}
	
	function setPassword($password) {
		$this -> password = $password;
	}
	
	function setPhone($phone) {
		$this -> phone = $phone;
	}
	
	function setFirstName($firstName) {
		$this -> firstName = $firstName;
	}
	
	function setLastName($lastName) {
		$this -> lastName = $lastName;
	}
	
	function setEmail($email) {
		$this -> email = $email;
	}
	
	function setType($type) {
		$this -> type = $type;
	}*/
}
