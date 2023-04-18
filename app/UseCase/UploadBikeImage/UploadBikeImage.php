<?php

namespace App\UseCase\UploadBikeImage;

use App\UseCase\Ports\UploadBikeImageCommandPort;

class UploadBikeImage
{
    private $port;

    public function __construct(UploadBikeImageCommandPort $port)
    {
        $this->port = $port;
    }

    public function execute(string $imagePath)
    {
        $this->port->uploadBikeImage($imagePath);
    }
}