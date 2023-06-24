<?php

namespace core\src\Bike\Domain\Models;

use App\ValueObjects\ValueObjectString;

final class ImagePath
{
    use ValueObjectString;

    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
