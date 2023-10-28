<?php

namespace Core\src\Comment\Domain\Models;

use App\ValueObjects\ValueObjectString;

final class CommentBody
{
    use ValueObjectString;

    const MIN_COMMENT_LENGTH = 1;
    const MAX_COMMENT_LENGTH = 140;

    /** @param string $value */
    private $value;

    public function __construct(string $value)
    {
        if (!self::validate($value)) {
            throw new \InvalidArgumentException('文字の入力数が不正です。');
        }
        $this->value = $value;
    }

    private function validate(string $value): bool
    {
        if (mb_strlen($value) > self::MAX_COMMENT_LENGTH) {
            return false;
        }
        if (mb_strlen($value) < self::MIN_COMMENT_LENGTH) {
            return false;
        }
        return true;
    }
}
