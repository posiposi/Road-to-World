<?php

namespace Core\src\Bike\UseCase\UploadBikeImage;

use Core\src\Bike\Domain\Models\Bike;
use Core\src\Bike\UseCase\Ports\UploadBikeImageCommandPort;

class UploadBikeImage
{
    private $port;

    public function __construct(UploadBikeImageCommandPort $port)
    {
        $this->port = $port;
    }

    public function execute(Bike $request, array $bike)
    {
        $this->port->uploadBikeImage($request, $bike);
    }
}
