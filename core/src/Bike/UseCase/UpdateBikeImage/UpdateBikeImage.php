<?php

namespace Core\src\Bike\UseCase\UpdateBikeImage;

use Core\src\Bike\Domain\Models\Bike;
use Core\src\Bike\UseCase\Ports\UpdateBikeImageCommandPort;

class UpdateBikeImage
{
    private $port;

    public function __construct(UpdateBikeImageCommandPort $port)
    {
        $this->port = $port;
    }

    public function execute(Bike $request, array $bike)
    {
        $this->port->updateBikeImage($request, $bike);
    }
}
