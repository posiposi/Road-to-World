<?php

namespace App\Adapters\Bike;

use App\Bike as EloquentBike;
use Core\src\Bike\Domain\Models\Bike;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Bike\Domain\Models\BikeList;
use Core\src\Bike\UseCase\Ports\GetBikeQueryPort;
use Core\src\User\Domain\Models\UserId;

final class GetBikeAdapter implements GetBikeQueryPort
{
    private $bike;

    public function __construct(EloquentBike $bike)
    {
        $this->bike = $bike;
    }

    public function findByBikeId(BikeId $bikeId): Bike
    {
        return $this->bike->getByBikeId($bikeId)->toModel();
    }

    /**
     * @param UserId $userId
     * @return BikeList
     */
    public function findByUserId(UserId $userId): BikeList
    {
        $bikeList = $this->bike->getByUserId($userId)->get();

        return new BikeList($bikeList->toArray());
    }
}
