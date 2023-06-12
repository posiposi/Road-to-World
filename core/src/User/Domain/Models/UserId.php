<?php

namespace Core\src\User\Domain\Models;

use App\ValueObjects\ValueObjectInt;

final class UserId
{
    use ValueObjectInt;

    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }
}
