<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

/**
 * @template T
 */
class ListResource extends BaseResource
{
    /** @var array<T> */
    public array $items;
    public int $count;
    public int $page;
    public int $itemsPerPage;
    public ?int $nextPage;
    public ?int $prevPage;
    public int $lastPage;

    /** @var class-string<T> */
    protected string $resourceClass;

    /**
     * @param mixed[] $result
     * @param class-string<T> $resourceClass
     */
    public function __construct(array $result, string $resourceClass)
    {
        $this->resourceClass = $resourceClass;

        parent::__construct($result);
    }

    /** @inheritDoc */
    public function toArray(): array
    {
        $values = parent::toArray();

        unset($values['resourceClass']);
        $values['items'] = array_map(static fn (BaseResource $item) => $item->toArray(), ($values['items'] ?? []));

        return $values;
    }

    /** @inheritDoc */
    protected function setProperty(string $property, $value): void
    {
        if ($property === 'items') {
            $resourceClass = $this->resourceClass;
            $value = array_map(static fn (array $itemValues): BaseResource => new $resourceClass($itemValues), $value);
        }

        parent::setProperty($property, $value);
    }
}
