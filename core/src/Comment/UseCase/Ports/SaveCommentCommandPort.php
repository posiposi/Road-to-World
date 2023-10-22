<?php

namespace Core\src\Comment\UseCase\Ports;

use Core\src\Comment\Domain\Models\Comment;

interface SaveCommentCommandPort
{
    public function saveComment(Comment $comment): void;
}
