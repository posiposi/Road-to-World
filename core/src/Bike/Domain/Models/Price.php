<?php

namespace core\src\Bike\Domain\Models;

use App\ValueObjects\ValueObjectInt;

final class price
{
    use ValueObjectInt;

    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }
}
