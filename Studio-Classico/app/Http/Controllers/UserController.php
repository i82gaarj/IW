<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    function getUserByID($user_id){
        $user = User::where('id', '=', $user_id);
        return $user;
    }

}
