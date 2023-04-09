<?php

namespace App\Http\Controllers;

use App\Bike;
use App\Enums\BikeStatus;
use App\Consts\Word;
use App\Http\Requests\BikeRegisterRequest;
use App\Services\BikeService;
use Illuminate\Support\Facades\Auth;

class BikesController extends Controller
{
    private $bike;
    private $bike_service;

    public function __construct(Bike $bike, BikeService $bikeService)
    {
        $this->bike = $bike;
        $this->bike_service = $bikeService;
    }

    /**
     * 自転車登録画面表示
     *
     * @return void
     */
    public function show()
    {
        // 自転車保管状態ラジオボタンの選択肢を取得
        $bike_status_cases = BikeStatus::cases();
        // 入力フォーム用ラベルテキストを取得
        $bike_form_label = Word::BIKE_FORM_LABEL;

        // 自転車登録画面へ変遷する
        return view('auth.bikeregister', compact('bike_status_cases', 'bike_form_label'));
    }

    /**
     * 自転車を登録する
     *
     * @param BikeRegisterRequest $request 登録する自転車の情報リクエスト
     * @return void
     */
    public function store(BikeRegisterRequest $request)
    {
        // 自転車を登録する
        $this->bike->registerBike($request);
        // ログインユーザーのマイページへ画面変遷
        return redirect()->route('mybike.index');
    }

    /**
     * 貸出中自転車一覧画面の表示
     * 
     * @return void 
     */
    public function index()
    {
        $all_bikes = $this->bike_service->getBikesList();
        $user = Auth::user();
        $times = [];
        for ($i = 0; $i < 48; $i++) {
            $times[] = date("H:i", strtotime("+" . $i * 30 . "minute", (-3600 * 9)));
        };

        // 自転車一覧画面へ変遷する
        return view('bikes.index', compact('all_bikes', 'user', 'times'));
    }

    /**
     * 自転車情報変更画面を表示する
     *
     * @param int $bike_id 対象自転車のid
     * @var object $bike 対象となる自転車
     * @return void
     */
    public function edit(int $bike_id)
    {
        $bike = Bike::findOrFail($bike_id);
        // 自転車保管状態ラジオボタンの選択肢を取得
        $bike_status_cases = BikeStatus::cases();
        // 入力フォーム用ラベルテキストを取得
        $bike_form_label = Word::BIKE_FORM_LABEL;

        return view('bikes.edit', compact('bike', 'bike_status_cases', 'bike_form_label'));
    }

    /**
     * 自転車の変更保存
     *
     * @param BikeRegisterRequest $request 変更する自転車の情報リクエスト
     * @param int $id 対象自転車のid
     * @return void
     */
    public function update(BikeRegisterRequest $request, int $id)
    {
        // idで該当自転車を検索し、登録情報を変更する
        $this->bike->updateRegisteredBike($request, $id);
        // マイバイク画面へ戻る
        return redirect()->route('mybike.index');
    }

    /**
     * 登録自転車の削除
     *
     * @param int $bike_id 削除する自転車のid
     * @return void
     */
    public function destroy(int $bike_id)
    {
        // 該当するidの自転車を削除する
        $this->bike->deleteRegisteredBike($bike_id);
    }
}
