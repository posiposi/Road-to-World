<?php

namespace App\ValueObjects;

trait ValueObjectInt
{
    use ValueObjectOf;

    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public function toInt(): int
    {
        return $this->value;
    }
}