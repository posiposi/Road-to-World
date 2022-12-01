<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bike;
use App\Consts\Message;

class SearchController extends Controller
{
    // コンストラクタインジェクション
    public function __construct(Bike $bike)
    {
        $this->bike = $bike;
    }

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
     * @param Request $request 検索条件
     * @return void
     */
    public function index(Request $request)
    {
        // 検索結果を配列化
        [$bikes, $search_name, $search_brand, $search_address, $search_price] = $this->bike->doSearchBikes($request);
        
        /*
        検索結果が1件でもある場合は検索結果を表示する。
        検索結果が0件の場合はエラーメッセージを表示する。
        */
        if(count($bikes) >= 1){
            return view('searches.index', compact('bikes', 'search_name', 'search_brand', 'search_address', 'search_price'));
        }
        else {
            return redirect('search')->with('flash_message', Message::MESSAGE_LIST['not_existing_bikes']);
        }
    }
}
