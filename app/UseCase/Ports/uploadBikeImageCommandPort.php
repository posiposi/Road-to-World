<?php

namespace App\UseCase\Ports;

interface uploadBikeImageCommandPort
{
    public function uploadBikeImage(string $imagePath);
}