<?php

namespace App\ValueObjects\Bike;

/**
 * 自転車IDクラス
 */
class BikeId
{
    /** @var int */
    private $value;

    public function __construct(int $bike_id)
    {
        $this->value = $bike_id;
    }

    /**
     * 自転車IDを取得する
     *
     * @return integer
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
