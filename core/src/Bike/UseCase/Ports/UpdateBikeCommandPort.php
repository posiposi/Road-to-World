<?php

namespace Core\src\Bike\UseCase\Ports;

use Core\src\Bike\Domain\Models\Bike;

interface UpdateBikeCommandPort
{
    public function updateBike(Bike $bike, string $imagePath): void;
}
