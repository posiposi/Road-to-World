<?php

namespace Core\src\Comment\UseCase;

use App\Events\MessageAdded;
use Core\src\Comment\Domain\Models\Comment;
use Core\src\Comment\UseCase\Ports\SaveCommentCommandPort;

final class SendComment
{
    /**
     * @var SaveCommentCommandPort
     */
    private $saveCommentCommandPort;

    public function __construct(SaveCommentCommandPort $saveCommentCommandPort)
    {
        $this->saveCommentCommandPort = $saveCommentCommandPort;
    }

    public function execute(array $commentValues)
    {
        $this->saveCommentCommandPort->saveComment(Comment::fromArray($commentValues));
        event((new MessageAdded($commentValues))->dontBroadcastToCurrentUser());
    }
}
