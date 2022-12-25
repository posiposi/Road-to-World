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

    /**
     * 自転車保管状況の論理名を表示する
     *
     * @return array 自転車保管状況の論理名配列
     */
    public function label_BikeStatus(): string
    {
        return match($this)
        {
            BikeStatus::Good => '良好',
            BikeStatus::Normal => '普通',
            BikeStatus::Bad => '悪い',
        };
    }
}