<?php

namespace Core\src\Bike\UseCase\Ports;

use Core\src\Bike\Domain\Models\Bike;

interface UploadBikeImageCommandPort
{
    public function uploadBikeImage(Bike $request, array $bike);
}