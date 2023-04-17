<?php

namespace App\Services;

use App\Repositories\BikeRepository;
use App\ValueObjects\Bike\BikeId;

class BikeService
{
    private $bike_repository;

    public function __construct(BikeRepository $bike_repository)
    {
        $this->bike_repository = $bike_repository;
    }

    /**
     * 自転車登録を削除する
     *
     * @param integer $bike_id 削除対象自転車のID
     * @return void
     */
    public function deleteBike(int $bike_id)
    {
        $bikeId = new BikeId($bike_id);
        $this->bike_repository->deleteBike($bikeId);
    }
}
