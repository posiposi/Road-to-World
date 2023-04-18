<?php

namespace App\UseCase\Ports;

interface UploadBikeImageCommandPort
{
    public function uploadBikeImage(string $imagePath);
}