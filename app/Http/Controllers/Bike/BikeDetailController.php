<?php

namespace App\Http\Controllers\Bike;

use App\Http\Controllers\Controller;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Bike\UseCase\BikeDetail\BikeDetail;
use Core\src\User\Domain\Models\UserId;

class BikeDetailController extends Controller
{
    /**
     * @var BikeDetail
     */
    private $useCase;

    public function __construct(BikeDetail $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(
        int $bikeId,
        int $loginUserId,
        int $anotherUserId
    ) {
        $useCaseResult = $this->useCase->execute(UserId::of($loginUserId), UserId::of($anotherUserId), BikeId::of($bikeId));
        $bike = [
            'ownerId' => $useCaseResult['bike']->userId()->toInt(),
            'bikeId' => $useCaseResult['bike']->bikeId()->toInt(),
            'bikeOwner' => $useCaseResult['ownerNickname']->userNickname()->toString(),
            'brand' => $useCaseResult['bike']->brand()->toString(),
            'name' => $useCaseResult['bike']->bikeName()->toString(),
            'status' => $useCaseResult['bike']->status()->toString(),
            'address' => $useCaseResult['bike']->bikeAddress()->toString(),
            'price' => $useCaseResult['bike']->price()->toInt(),
            'remark' => $useCaseResult['bike']->remark()->toString(),
            'image' => $useCaseResult['bike']->imagePath()->toString(),
        ];
        $times = $useCaseResult['times'];
        return view('bikes.detail', compact('bike', 'times'));
    }
}
