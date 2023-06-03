<?php

namespace App\ValueObjects;

trait ValueObjectOf
{
    public static function of($value): self
    {
        if ($value instanceof static) {
            return $value;
        }

        return new self($value);
    }
}
