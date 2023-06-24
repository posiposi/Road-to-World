<?php

namespace Core\src\Bike\UseCase\Ports;

interface RegisterBikeCommandPort
{
    public function registerBike(array $request, string $imagePath): void;
}
