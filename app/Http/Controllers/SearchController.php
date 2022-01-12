<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bike;

class SearchController extends Controller
{
    /**
     * 検索フォームページの表示
     *
     * @return void
     */
    public function show()
    {
        return view('searches.show');
    }

    /**
     * 検索結果表示
     *
     * @return void
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search != null) {
            $array_search = array($search);
            foreach($array_search as $word) {
                $bikes = Bike::where('name', 'like', '%'.$word.'%')->paginate(10);
            }
        }
        return view('searches.index')
            ->with([
                'bikes' => $bikes,
                'search' => $search,
            ]);
    }
}
