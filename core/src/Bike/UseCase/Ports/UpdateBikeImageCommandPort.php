<?php

namespace Core\src\Bike\UseCase\Ports;

use Core\src\Bike\Domain\Models\Bike;

interface UpdateBikeImageCommandPort
{
    public function updateBikeImage(Bike $request, array $bike);
}