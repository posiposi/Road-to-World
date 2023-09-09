<?php

namespace Core\src\User\Domain\Models;

use App\ValueObjects\ValueObjectString;
use Exception;

final class UserNickname
{
    use ValueObjectString;

    private $value;

    private function __construct(string $value)
    {
        try {
            if (mb_strlen($value) < 1 || mb_strlen($value) > 191) {
                throw new Exception('ニックネーム文字数に誤りがあります');
            }
        } catch (\Exception $e) {
            info($e->getMessage());
        }
        $this->value = $value;
    }
}
