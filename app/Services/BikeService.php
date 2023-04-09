<?php

namespace App\Services;

use App\Repositories\BikeRepository;
use App\Repositories\BikeRepositoryInterface;

class BikeService
{
    private $bike_repository;

    public function __construct(BikeRepository $bike_repository)
    {
        $this->bike_repository = $bike_repository;
    }

    /**
     * 自転車一覧を取得する
     *
     * @return collection 自転車一覧
     */
    public function getBikesList()
    {
        return $this->bike_repository->getAllBikes();
    }
}
