<?php

namespace App\Adapters\Bike;

use App\Bike as EloquentBike;
use Core\src\Bike\Domain\Models\Bike;
use Illuminate\Support\Facades\Auth;
use Core\src\Bike\UseCase\Ports\RegisterBikeCommandPort;

class RegisterBikeAdapter implements RegisterBikeCommandPort
{
    /** @var EloquentBike */
    private $bike;

    public function __construct(EloquentBike $bike)
    {
        $this->bike = $bike;
    }

    public function registerBike(array $request, string $imagePath): void
    {
        $query = $this->bike->newQuery();
        $request['id'] = $query->latest('id')->value('id') + 1;
        $request['user_id'] = Auth::id();
        $request['image_path'] = $imagePath;
        $this->bike->createBike(Bike::ofByArray($request));
    }
}
