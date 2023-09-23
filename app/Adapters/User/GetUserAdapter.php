<?php

namespace App\Adapters\User;

use Core\src\User\Domain\Models\User;
use Core\src\User\Domain\Models\UserId;
use Core\src\User\UseCase\Ports\GetUserQueryPort;
use App\User as EloquentUser;

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
        $user = $this->eloquentUser->findByUserId($userId);
        return User::fromArray($user->toArray());
    }
}
