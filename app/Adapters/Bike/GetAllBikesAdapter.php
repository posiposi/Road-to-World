<?php

namespace App\Adapters\Bike;

use App\Bike;
use App\UseCase\Ports\GetAllBikesQueryPort;
use App\Consts\PaginationConst;

final class GetAllBikesAdapter implements GetAllBikesQueryPort
{
    private $bike;

    public function __construct(Bike $bike)
    {
        $this->bike = $bike;
    }

    public function getAllBikes()
    {
        return $this->bike->paginate(PaginationConst::BIKES_INDEX_PAGINATION);
    }
}
