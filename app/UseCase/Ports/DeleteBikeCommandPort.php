<?php

namespace App\UseCase\Ports;

interface DeleteBikeCommandPort
{
    public function deleteBike(int $bikeId): void;
}
