<?php

namespace App\UseCase\GetAllBikes;

use App\Bike;
use App\UseCase\Ports\GetAllBikesQueryPort;

/**
 * 全自転車レコード取得ユースケース
 */
class GetAllBikes
{
    /**
     * @var GetAllBikesQueryPort
     */
    private $port;

    /**
     * GetAllBikesQueryPort
     *
     * @param GetAllBikesQueryPort $port
     */
    public function __construct(GetAllBikesQueryPort $port)
    {
        $this->port = $port;
    }

    /**
     * 全自転車レコードを取得する
     *
     * @return Bike 全自転車レコード
     */
    public function execute()
    {
        return $this->port->getAllBikes();
    }
}
