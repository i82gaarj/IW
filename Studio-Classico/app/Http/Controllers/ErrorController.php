<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    function invalidAccess(){
        return redirect(route('home'))->with('error', 'Acceso inválido');
    }
}
