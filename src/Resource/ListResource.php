<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

/**
 * @template T
 */
class ListResource extends BaseResource
{
    /** @var array<T> */
    public $items;

    /** @var int */
    public $count;

    /** @var int */
    public $page;

    /** @var int */
    public $itemsPerPage;

    /** @var int|null */
    public $nextPage;

    /** @var int|null */
    public $prevPage;

    /** @var int */
    public $lastPage;

    /** @var class-string<T> */
    protected $resourceClass;

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
        $values['items'] = array_map(
            static function (BaseResource $item): array {
                return $item->toArray();
            },
            ($values['items'] ?? [])
        );

        return $values;
    }

    /** @inheritDoc */
    protected function setProperty(string $property, $value): void
    {
        if ($property === 'items') {
            $resourceClass = $this->resourceClass;
            $value = array_map(
                static function (array $itemValues) use ($resourceClass): BaseResource {
                    return new $resourceClass($itemValues);
                },
                $value
            );
        }

        parent::setProperty($property, $value);
    }
}
