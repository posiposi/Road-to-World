<?php

namespace App\Adapters\Bike;

use App\Bike as EloquentBike;
use Core\src\Bike\Domain\Models\Bike;
use Core\src\Bike\UseCase\Ports\UpdateBikeCommandPort;
use Illuminate\Support\Facades\Auth;

class UpdateBikeAdapter implements UpdateBikeCommandPort
{
    /** @var EloquentBike */
    private $bike;

    public function __construct(EloquentBike $bike)
    {
        $this->bike = $bike;
    }

    public function updateBike(Bike $bike, string $imagePath): void
    {
        $userId = Auth::id();
        $this->bike->updateBike($bike, $imagePath, $userId);
    }
}
