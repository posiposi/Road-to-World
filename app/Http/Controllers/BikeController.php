<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BikeController extends Controller
{
    //protected $redirectTo = App\Auth\RouteServiceProvider::Home; //コード可否怪しいため要再確認(特にAppとか・・・)
    
    //自転車登録画面表示
    public function index()
    {
        return view('auth.bikeregister');
    }

    public function post(Register $request)
    {
        $bike = new Bike;
        $bike->user_id = $request->user_id;
        $bike->brand = $request->brand;
        $bike->name = $request->name;
        $bike->status = $request->status;
        $bike->bike_address = $request->bike_address;
        $bike->image = $request->image;
    }
}