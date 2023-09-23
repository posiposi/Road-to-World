<?php

namespace Core\src\Bike\UseCase\BikeDetail;

use Core\src\Bike\Domain\Models\Bike;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Bike\UseCase\Ports\GetBikeQueryPort;
use Core\src\Comment\Domain\Models\ReceiverId;
use Core\src\Comment\Domain\Models\SenderId;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;
use Core\src\User\Domain\Models\UserId;
use Core\src\User\UseCase\Ports\GetUserQueryPort;

final class BikeDetail
{
    /**
     * @var GetBikeQueryPort
     */
    private $getBikeQueryPort;
    /**
     * @var GetCommentQueryPort
     */
    private $getCommentQueryPort;

    private $getUserQueryPort;

    public function __construct(
        GetBikeQueryPort $getBikeQueryPort,
        GetCommentQueryPort $getCommentQueryPort,
        GetUserQueryPort $getUserQueryPort,
    ) {
        $this->getBikeQueryPort = $getBikeQueryPort;
        $this->getCommentQueryPort = $getCommentQueryPort;
        $this->getUserQueryPort = $getUserQueryPort;
    }

    public function execute(
        UserId $loginUserId,
        UserId $anotherUserId,
        BikeId $bikeId
    ) {
        $bike = $this->getBikeQueryPort->findByBikeId($bikeId);
        $bikeOwnerNickname = $this->getUserQueryPort->findByUserId($bike->userId());

        return ['bike' => $bike, 'ownerNickname' => $bikeOwnerNickname];
    }
}
