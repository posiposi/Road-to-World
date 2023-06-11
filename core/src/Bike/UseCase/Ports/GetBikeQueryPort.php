<?php

namespace Core\src\Bike\UseCase\Ports;

use App\Bike;
use Core\src\Bike\Domain\Models\BikeId;

interface GetBikeQueryPort
{
    public function findByBikeId(BikeId $bikeId): Bike;
}