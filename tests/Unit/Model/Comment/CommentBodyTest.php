<?php

namespace Tests\Unit\Model\Comment;

use Core\src\Comment\Domain\Models\CommentBody;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class CommentBodyTest extends TestCase
{
    use RefreshDatabase;

    const OK_MESSAGE_VALUE = 'コメント生成用';

    public function testCommentBody()
    {
        $commentBody = CommentBody::of(self::OK_MESSAGE_VALUE);
        $this->assertSame(self::OK_MESSAGE_VALUE, $commentBody->toString());
    }

    /**
     * @dataProvider validateDataProvider
     */
    public function testValidate(string $value, $expectedInstance, ?string $exceptionMessage): void
    {
        try {
            $commentBody = new CommentBody($value);
            $this->assertInstanceOf($expectedInstance, $commentBody);
        } catch (\InvalidArgumentException $exception) {
            $this->assertInstanceOf($expectedInstance, $exception);
            $this->assertSame($exceptionMessage, $exception->getMessage());
        }
    }

    public static function validateDataProvider()
    {
        return [
            '文字数140' => [
                'value' => 'あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえお
                あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ
                あいうえおあいうえおあいうえおあいうえお',
                'expectedInstance' => CommentBody::class,
                'exceptionMessage' => null
            ],
            '文字数0' => [
                'value' => '',
                'expectedInstance' => InvalidArgumentException::class,
                'exceptionMessage' => '文字の入力数が不正です。'
            ],
            '文字数141以上' => [
                'value' => 'あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえお
                あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえお
                あいうえおあいうえおあいうえおあいうえお141文字以上',
                'expectedInstance' => InvalidArgumentException::class,
                'exceptionMessage' => '文字の入力数が不正です。'
            ]
        ];
    }
}
