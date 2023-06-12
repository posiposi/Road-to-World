<?php

namespace Core\src\Bike\UseCase\RegisterBike;

use Core\src\Bike\Domain\Models\ImagePath;
use Core\src\Bike\UseCase\Ports\RegisterBikeCommandPort;
use Core\src\Bike\UseCase\Ports\UploadBikeImageCommandPort;

class RegisterBike
{
    private $uploadBikeImagePort;
    private $registerBikePort;

    public function __construct(
        UploadBikeImageCommandPort $uploadBikeImagePort,
        RegisterBikeCommandPort $registerBikeCommandPort,
    ) {
        $this->uploadBikeImagePort = $uploadBikeImagePort;
        $this->registerBikePort = $registerBikeCommandPort;
    }

    /**
     * @param array $values
     */
    public function execute(array $values): void
    {
        $image = new ImagePath($values['image_path']);
        // S3へ画像をアップロード、保存した画像のパスを取得
        $imagePath = $this->uploadBikeImagePort->uploadBikeImage($image);
        // 自転車情報を永続化
        $this->registerBikePort->registerBike($values, $imagePath);
    }
}
