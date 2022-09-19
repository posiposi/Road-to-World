<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Image\S3Service;

class ServiceController extends Controller
{
    public function show(S3Service $image){
        $how_to_images = $image->getImages();
        return response()->json(["how_to_images" => $how_to_images]);
    }
}
