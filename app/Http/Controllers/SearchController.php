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
     * @var string $search_name 検索モデル名
     * @var string $search_brand 検索ブランド名
     * @var string $search_address 検索受け渡し場所
     * @var int $search_price 検索価格
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
        $bikes = $query->get();
            if (count($bikes) >= 1) {
                return view('searches.index', compact('bikes', 'search_name', 'search_brand', 'search_address', 'search_price'));
            } else {
                return redirect('search')->with('flash_message', '該当する自転車がありませんでした。');
            }
    }

    /**
     * 名称検索画面表示
     *
     * @return void
     */
    public function name()
    {
        return view('searches.name',);
    }

    /**
     * ブランド検索画面表示
     *
     * @return void
     */
    public function brand()
    {
        return view('searches.brand',);
    }
}
