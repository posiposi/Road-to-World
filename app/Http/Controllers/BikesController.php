<?php

namespace App\Http\Controllers;

use App\Bike;
use App\Consts\Word;
use App\Enums\BikeStatus;
use App\Http\Requests\BikeRegisterRequest;
use App\UseCase\DeleteBike\DeleteBike;
use App\UseCase\GetAllBikes\GetAllBikes;
use Core\src\Bike\Domain\Models\Bike as DomainBike;
use Illuminate\Support\Facades\Auth;
use Core\src\Bike\UseCase\UpdateRegisteredBike\UpdateRegisteredBike;

class BikesController extends Controller
{
    private $bike;
    private $getAllBikes;
    private $deleteBike;
    private $updateBike;

    public function __construct(
        Bike $bike,
        GetAllBikes $getAllBikes,
        DeleteBike $deleteBike,
        updateRegisteredBike $updateBike,
    ) {
        $this->bike = $bike;
        $this->getAllBikes = $getAllBikes;
        $this->deleteBike = $deleteBike;
        $this->updateBike = $updateBike;
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
        $all_bikes = $this->getAllBikes->execute();
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
     * 自転車の更新
     *
     * @param BikeRegisterRequest $request
     * @param int $id
     * @return void
     */
    public function update(BikeRegisterRequest $request, int $id)
    {
        $values = $request->toArray();
        $values['id'] = $id;
        $domainBike = DomainBike::ofByArray($values);
        $this->updateBike->execute($domainBike);

        return redirect()->route('mybike.index');
    }

    /**
     * 登録自転車の削除
     *
     * @param int $bike_id 削除する自転車のid
     * @return void
     */
    public function destroy(int $bikeId)
    {
        $this->deleteBike->execute($bikeId);
        return back();
    }
}
