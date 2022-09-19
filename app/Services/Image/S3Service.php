<?php
namespace App\Services\Image;

use App\Consts\Url;

class S3Service{
    public function getImages(){
        return 
        [
            '1' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture1'],
            '2' => URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture2']
        ];
    }
}