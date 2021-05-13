<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

/**
 * @property string $unmapped
 */
class DummyResource extends BaseResource
{
    public const ID = '5248129d-7713-4d30-9518-71cb09adfd22';
    public const EXAMPLE = [
        'id' => self::ID,
        'bool' => true,
        'string' => 'foo',
        'nullable' => null,
        'integer' => 123,
        'float' => 1.55,
        'resource' => [
            'string' => 'bar',
        ],
        'dateTime' => '2021-01-01T01:01:01+00:00',
        'collection' => [
            ['string' => 'moo'],
            ['string' => 'baz'],
        ],
        'unmapped' => 'goo',
        '_links' => ['self' => '#foobar'],
    ];

    public const LIST_EXAMPLE = [
        'items' => [
            DummyResource::EXAMPLE,
            DummyResource::EXAMPLE,
            DummyResource::EXAMPLE,
        ],
        'count' => 3,
        'page' => 1,
        'itemsPerPage' => 10,
        'lastPage' => 1,
    ];

    public string $id;
    public bool $bool;
    public string $string;
    public ?string $nullable;
    public int $integer;
    public float $float;
    public DummyResource $resource;
    public DateTime $dateTime;

    /** @var Collection<DummyResource> */
    public Collection $collection;
}
