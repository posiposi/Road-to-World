<?php

namespace core\tests\UseCase\Comment;

use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\CommentList;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;
use Core\src\Comment\UseCase\GetComment;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;
use Core\src\User\Domain\Models\UserId;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class GetCommentTest extends TestCase
{
    use RefreshDatabase;

    public function testExcute()
    {
        $useCase = new GetComment(
            new class implements GetCommentQueryPort
            {
                public function getCommentList(
                    SenderId $senderId,
                    ReceiverId $receiverId,
                    BikeId $bikeId
                ): CommentList {
                    $values = [];
                    return CommentList::fromArray($values);
                }
            }
        );

        $loginUserId = 1;
        $anotherUserId = 2;
        $bikeId = 1;
        $commentList = $useCase->execute(UserId::of($loginUserId), UserId::of($anotherUserId), BikeId::of($bikeId));
        $this->assertCount(2, $commentList);
    }
}
