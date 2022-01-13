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
        $query = Bike::query();
        $search_name = $request->input('search_name');
        $search_brand = $request->input('search_brand');
        $search_address = $request->input('search_address');
        $search_price = $request->input('search_price');

        if (!empty('search_name')) {
            $query->where('name', 'like', '%'.$search_name.'%');
        }
        if (!empty('search_brand')) {
            $query->where('brand', 'like', '%'.$search_brand.'%');
        }
        if (!empty('search_address')) {
            $query->where('bike_address', 'like', '%'.$search_address.'%');
        }
        if (!empty('search_price')) {
            $query->where('price', 'like', '%'.$search_price.'%');
        }
        $bikes = $query->get();
            if (count($bikes) >= 1) {
                return view('searches.index', compact('bikes', 'search_name', 'search_brand', 'search_address', 'search_price'));
            } else {
                return redirect('search')->with('flash_message', '該当する自転車がありませんでした。');
            }
    }
}
