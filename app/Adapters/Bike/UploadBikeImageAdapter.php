<?php

namespace App\Adapters\Bike;

use Core\src\Bike\Domain\Models\ImagePath;
use Core\src\Bike\UseCase\Ports\UploadBikeImageCommandPort;
use Illuminate\Support\Facades\Storage;

class UploadBikeImageAdapter implements UploadBikeImageCommandPort
{
    public function uploadBikeImage(ImagePath $imagePath): string
    {
        $path = Storage::disk('s3')->putFile('bikes', $imagePath->toString(), 'public');
        return Storage::disk('s3')->url($path);
    }
}
