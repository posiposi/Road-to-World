<?php

namespace App\Services;

use App\User;

/**
 * ユーザーサービスクラス
 */
class UserService
{
    /**
     * ログインユーザーのIDを取得する
     *
     * @return int ログインユーザーID
     */
    public static function getLoginUserId(): int
    {
        return User::getLoginUserId();
    }

    /**
     * 対象ユーザーの全所有自転車を取得する
     *
     * @param integer $user_id ユーザーID
     * @return array ログインユーザーの全所有自転車
     */
    public static function getUserBikes(int $user_id): array
    {
        $user = new User();
        return $user->find($user_id)->bikes;
    }
}