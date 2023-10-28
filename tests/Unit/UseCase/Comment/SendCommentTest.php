<?php

namespace core\tests\UseCase\Comment;

use Carbon\Carbon;
use Core\src\Comment\Domain\Models\Comment;
use Core\src\Comment\UseCase\Ports\SaveCommentCommandPort;
use Core\src\Comment\UseCase\SendComment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class SendCommentTest extends TestCase
{
    use RefreshDatabase;

    private $useCase;

    public function testExcute()
    {
        $this->useCase = new SendComment(
            new class implements SaveCommentCommandPort
            {
                public function saveComment(Comment $comment): void
                {
                }
            }
        );

        $arrayValue = [
            'sender_id' => 4,
            'receiver_id' => 3,
            'bike_id' => 2,
            'body' => 'テストコメント1',
            'sendDateTime' => Carbon::parse('2023-10-28 12:00:00')
        ];

        $response = $this->useCase->execute($arrayValue);
        $this->assertNull($response);
    }
}
