<?php

namespace Core\src\Bike\UseCase\Ports;

use core\src\Bike\Domain\Models\ImagePath;

interface UploadBikeImageCommandPort
{
    public function uploadBikeImage(ImagePath $imagePath): string;
}