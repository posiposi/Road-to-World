<?php

namespace App\Enums;

// 自転車保管状況
enum BikeStatus: string
{
    // 良好
    case Good = '0';

    // 普通
    case Normal = '1';

    // 悪い
    case Bad = '2';
}