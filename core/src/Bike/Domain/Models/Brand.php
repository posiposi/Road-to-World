<?php

namespace core\src\Bike\Domain\Models;

use App\ValueObjects\ValueObjectString;

final class Brand
{
    use ValueObjectString;

    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
