<?php

namespace App\Enums;

enum BikeStatus: string
{
    case Good = '0';
    case Normal = '1';
    case Bad = '2';

    public static function label_BikeStatus(BikeStatus $bikeStatus): string
    {
        return match ($bikeStatus) {
            BikeStatus::Good => '良好',
            BikeStatus::Normal => '普通',
            BikeStatus::Bad => '悪い',
        };
    }
}
