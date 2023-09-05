<?php

namespace Core\src\Comment\Domain\Models;

final class CommentList
{
    /**
     * @var array
     */
    private $items;

    public function __construct(array $parkingList = [])
    {
        $this->items = $parkingList;
    }

    public function items(): array
    {
        return $this->items;
    }

    public static function fromArray(array $items = []): self
    {
        return new self($items);
    }
}
