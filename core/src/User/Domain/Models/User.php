<?php

namespace Core\src\User\Domain\Models;

use Core\src\User\Domain\Models\UserNickname;

final class User
{
    /**
     * @var UserNickname
     */
    private $userNickname;

    private function __construct($userNickname)
    {
        $this->userNickname = $userNickname;
    }

    public function userNickname(): UserNickname
    {
        return $this->userNickname;
    }

    public static function fromArray(array $value): self
    {
        return new self(
            UserNickname::of($value['nickname'] ?? '')
        );
    }
}
