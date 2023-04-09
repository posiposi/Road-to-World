<?php

namespace App\Repositories;

use App\Bike;
use App\Consts\PaginationConst;

class BikeRepository implements BikeRepositoryInterface
{
    private $bike;

    public function __construct(Bike $bike)
    {
        $this->bike = $bike;
    }

    /**
     * 全自転車レコードを取得する
     *
     * @return collection $all_bikes 全自転車のレコード
     */
    public function getAllBikes()
    {
        return $this->bike->paginate(PaginationConst::BIKES_INDEX_PAGINATION);
    }
}
