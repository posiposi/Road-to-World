<?php

namespace App\Adapters\User;

use Core\src\User\Domain\Models\User;
use Core\src\User\Domain\Models\UserId;
use Core\src\User\UseCase\Ports\GetUserQueryPort;
use App\User as EloquentUser;
use Core\src\User\Domain\Exceptions\NotFoundException;

class GetUserAdapter implements GetUserQueryPort
{
    /**
     * @var EloquentUser
     */
    private $eloquentUser;

    public function __construct(EloquentUser $eloquentUser)
    {
        $this->eloquentUser = $eloquentUser;
    }

    public function findByUserId(UserId $userId): User
    {
        /** @var EloquentUser $user */
        $user = $this->eloquentUser->findByUserId($userId);
        if (is_null($user)) {
            throw new NotFoundException('ユーザーが見つかりません。');
        }
        return User::fromArray($user->toArray());
    }
}
