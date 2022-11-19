<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopPageController extends Controller
{
    /**
     * メインページを表示する
     */
    public function index()
    {
        return view('welcome');
    }
}
