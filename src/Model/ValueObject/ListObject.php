<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

abstract class ListObject
{

    /**
     * @var array<mixed>
     */
    private $items = [];
    /**
     * @var int
     */
    private $count = 0;
    /**
     * @var int
     */
    private $page = 0;
    /**
     * @var int
     */
    private $itemsPerPage = 0;

    /**
     * @param array<mixed> $items
     */
    public function __construct(array $items, int $count, int $page, int $itemsPerPage)
    {
        $this->items = $items;
        $this->count = $count;
        $this->page = $page;
        $this->itemsPerPage = $itemsPerPage;
    }

    /**
     * @return array<mixed>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
}
