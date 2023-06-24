<?php

namespace App\Http\Controllers;

use App\Bike;
use App\Consts\Word;
use App\Enums\BikeStatus;
use App\Http\Requests\BikeRegisterRequest;
use App\UseCase\DeleteBike\DeleteBike;
use App\UseCase\GetAllBikes\GetAllBikes;
use Core\src\Bike\Domain\Models\Bike as DomainBike;
use Core\src\Bike\UseCase\RegisterBike\RegisterBike;
use Illuminate\Support\Facades\Auth;
use Core\src\Bike\UseCase\UpdateRegisteredBike\UpdateRegisteredBike;
use Illuminate\View\View;

class BikesController extends Controller
{
    private $bike;
    private $getAllBikes;
    private $deleteBike;
    private $updateBike;
    private $registerBike;

    public function __construct(
        Bike $bike,
        GetAllBikes $getAllBikes,
        DeleteBike $deleteBike,
        UpdateRegisteredBike $updateBike,
        RegisterBike $registerBike,
    ) {
        $this->bike = $bike;
        $this->getAllBikes = $getAllBikes;
        $this->deleteBike = $deleteBike;
        $this->updateBike = $updateBike;
        $this->registerBike = $registerBike;
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
     * @param BikeRegisterRequest $request
     * @return void
     */
    public function store(BikeRegisterRequest $request)
    {
        $this->registerBike->execute($request->toArray());
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
     * @param int $bikeId
     */
    public function edit(int $bikeId): View
    {
        $bike = Bike::findOrFail($bikeId);
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
        $userId = Auth::id();
        $values['user_id'] = $userId;
        $domainBike = DomainBike::ofByArray($values);
        $this->updateBike->execute($domainBike);

        return redirect()->route('mybike.index');
    }

    /**
     * 登録自転車の削除
     *
     * @param int $bikeId
     * @return void
     */
    public function destroy(int $bikeId)
    {
        $this->deleteBike->execute($bikeId);
        return back();
    }
}
