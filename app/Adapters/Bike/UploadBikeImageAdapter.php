<?php

namespace App\Adapters\Bike;

use App\UseCase\Ports\UploadBikeImageCommandPort;
use Illuminate\Support\Facades\Storage;

class UploadBikeImageAdapter implements UploadBikeImageCommandPort
{
    /**
     * S3へ自転車画像をアップロードする
     *
     * @param string $imagePath アップロード画像のパス
     * @return void
     */
    public function uploadBikeImage(string $imagePath)
    {
        $path = Storage::disk('s3')->putFile('bikes', $imagePath, 'public');
        $url = Storage::disk('s3')->url($path);
        return $url;
    }
}
