<?php

namespace core\src\Bike\Domain\Models;

use App\ValueObjects\ValueObjectString;

final class Remark
{
    use ValueObjectString;

    private $value;

    private function __construct(?string $value)
    {
        if (is_null($value)) {
            $value = '';
        }

        $this->value = $value;
    }
}
