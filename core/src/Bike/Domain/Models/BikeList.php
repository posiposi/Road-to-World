<?php

namespace Core\src\Bike\Domain\Models;

final class BikeList
{
    /**
     * @var array
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function items(): array
    {
        return $this->items;
    }
}
