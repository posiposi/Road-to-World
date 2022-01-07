<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * 検索フォームページの表示
     *
     * @return void
     */
    public function show()
    {
        return view('search.show');
    }

    /**
     * 検索結果表示
     *
     * @return void
     */
    public function index()
    {
        return view('search.index');
    }
}
