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
        /**
         * @var string $search 検索ワード
         */
        $search = $request->input('search');
        /**
         * @var string[] $array_search 配列化された検索ワード
         * @var object[] $bikes 検索ワードに該当する自転車
         */
        if ($search != null) {
            $array_search = array($search);
            foreach($array_search as $word) {
                    $bikes = Bike::where('name', 'like', '%'.$word.'%')->paginate(10);
                    if (count($bikes) >= 1) {
                        return view('searches.index')->with([
                            'bikes' => $bikes,
                            'search' => $search,
                        ]);
                    } else {
                        return redirect('search')->with('flash_message', '該当する自転車がありませんでした。');
                    }
            }
        } else {
            return redirect('search')->with('flash_message', '検索ワードを入力して下さい。');
        }
    }
}
