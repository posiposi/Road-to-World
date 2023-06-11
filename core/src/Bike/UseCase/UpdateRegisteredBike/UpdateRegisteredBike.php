<?php

namespace Core\src\Bike\UseCase\UpdateRegisteredBike;

use Core\src\Bike\Domain\Models\Bike;
use Core\src\Bike\UseCase\Ports\GetBikeQueryPort;
use Core\src\Bike\UseCase\Ports\UpdateBikeCommandPort;
use Core\src\Bike\UseCase\Ports\UploadBikeImageCommandPort;

class UpdateRegisteredBike
{
    private $getBikePort;
    private $uploadBikeImagePort;
    private $updateBikePort;

    public function __construct(
        GetBikeQueryPort $getBikePort,
        UploadBikeImageCommandPort $uploadBikeImagePort,
        UpdateBikeCommandPort $updateBikePort,
    ) {
        $this->getBikePort = $getBikePort;
        $this->uploadBikeImagePort = $uploadBikeImagePort;
        $this->updateBikePort = $updateBikePort;
    }

    /**
     * 既存登録自転車の情報を変更する
     *
     * @param Bike $domainBike
     */
    public function execute(Bike $domainBike): void
    {
        // 既存自転車を配列で取得
        $bike = $this->getBikePort->findByBikeId($domainBike->bikeId())->attributesToArray();
        // S3へ画像をアップロード、保存した画像のパスを取得
        $imagePath = $this->uploadBikeImagePort->uploadBikeImage($domainBike, $bike);
        // 自転車情報を永続化
        $this->updateBikePort->updateBike($domainBike, $imagePath);
    }
}
