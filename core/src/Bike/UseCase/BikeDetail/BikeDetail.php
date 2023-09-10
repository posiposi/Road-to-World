<?php

namespace Core\src\Bike\UseCase;

use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;
use Core\src\User\Domain\Models\UserId;

final class BikeDetail
{
    /**
     * @var GetCommentQueryPort
     */
    private $getCommentQueryPort;

    public function __construct(GetCommentQueryPort $getCommentQueryPort)
    {
        $this->getCommentQueryPort = $getCommentQueryPort;
    }

    public function execute(
        UserId $loginUserId,
        UserId $anotherUserId,
        BikeId $bikeId
    ) {
        // TODO 自転車詳細情報表示UseCase呼び出し
        // TODO 予約機能UseCase呼び出し
    }
}
