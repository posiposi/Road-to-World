<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Image\S3Service;

class ServiceController extends Controller
{
    /**
     * S3から画像を取得し、JSON形式で返却する
     *
     * @param S3Service $image S3サービスクラスに定義されている画像
     * @return array<string> 取得した画像のS3URLパス
     */
    public function show(S3Service $image){
        $how_to_images = $image->getImages();
        return response()->json(["how_to_images" => $how_to_images]);
    }
}
