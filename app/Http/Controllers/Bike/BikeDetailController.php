<?php

namespace App\Http\Controllers\Bike;

use App\Http\Controllers\Controller;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Bike\UseCase\BikeDetail;
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
        UserId $loginUserId,
        UserId $anotherUserId,
        BikeId $bikeId
    ) {
        $this->useCase->execute($loginUserId, $anotherUserId, $bikeId);
    }
}
