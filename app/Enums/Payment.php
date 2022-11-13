<?php

namespace App\Enums;

// 支払い状況
enum Payment: int
{
    // 済
    case Still = 0;
    // 未
    case Already = 1;
}