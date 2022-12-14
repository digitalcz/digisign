<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

/**
 * @template T of ResourceInterface
 */
class ListResource extends BaseResource
{
    /** @var array<T> */
    public array $items;

    public int $count;
    public int $page;
    public int $itemsPerPage;

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

        /** @var array<BaseResource> $items */
        $items = $values['items'] ?? [];
        $values['items'] = array_map(
            static function (BaseResource $item): array {
                return $item->toArray();
            },
            $items
        );

        return $values;
    }

    protected function setProperty(string $property, mixed $value): void
    {
        if ($property === 'items') {
            /** @var array<array<mixed>> $items */
            $items = $value;
            $resourceClass = $this->resourceClass;
            $value = array_map(
                static function (array $itemValues) use ($resourceClass): ResourceInterface {
                    return new $resourceClass($itemValues);
                },
                $items
            );
        }

        parent::setProperty($property, $value);
    }
}
