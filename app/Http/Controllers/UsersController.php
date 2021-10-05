<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        return view('users.index', ['auth' => $auth]);
    }
}
