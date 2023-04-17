<?php

namespace App\UseCase\DeleteBike;

use App\UseCase\Ports\DeleteBikeCommandPort;

class DeleteBike
{
    /**
     * @var DeleteBikeCommandPort
     */
    private $port;

    /**
     * DeleteBikeCommandPort
     * 
     * @param DeleteBikeCommandPort $port
     */
    public function __construct(DeleteBikeCommandPort $port)
    {
        $this->port = $port;
    }

    /**
     * 登録自転車を削除する
     *
     * @param integer $bikeId 削除対象自転車ID
     * @return void
     */
    public function execute(int $bikeId)
    {
        $this->port->deleteBike($bikeId);
    }
}
