<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Comment implements ValidationRule
{
    const MAX_COMMENT_LENGTH = 5;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (mb_strlen($value) > self::MAX_COMMENT_LENGTH) {
            $fail('入力できる最大文字数は140文字です。');
        }
    }
}
