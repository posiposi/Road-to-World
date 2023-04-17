<?php

namespace App\Repositories;

use App\ValueObjects\Bike\BikeId;

interface BikeRepositoryInterface
{
    /**
     * 登録されている自転車を削除する
     *
     * @param BikeId $bikeId 自転車ID値オブジェクト
     * @return void
     */
    public function deleteBike(BikeId $bikeId);
}
