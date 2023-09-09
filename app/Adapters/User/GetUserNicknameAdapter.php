<?php

namespace App\Adapters\User;

use App\User;
use Core\src\User\Domain\Models\UserId;
use Core\src\User\Domain\Models\UserNickname;
use Core\src\User\UseCase\Ports\GetUserNicknamePort;

class GetUserNicknameAdapter implements GetUserNicknamePort
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserNickname(UserId $userId): UserNickname
    {
        $user = $this->user->findByUserId($userId);
        // TODO アカウントが見つからない場合の例外処理を追加
        return UserNickname::of($user->nickname);
    }
}
