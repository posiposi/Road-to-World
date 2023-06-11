<?php

namespace App\Adapters\Bike;

use App\Bike;
use Core\src\Bike\UseCase\Ports\GetBikeQueryPort;
use Core\src\Bike\Domain\Models\BikeId;

final class GetBikeAdapter implements GetBikeQueryPort
{
    private $bike;

    public function __construct(Bike $bike)
    {
        $this->bike = $bike;
    }

    public function findByBikeId(BikeId $bikeId): Bike
    {
        return $this->bike->getByBikeId($bikeId);
    }
}
