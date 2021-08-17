<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use ArrayObject;
use DigitalCz\DigiSign\Exception\RuntimeException;
use Psr\Http\Message\ResponseInterface;

/**
 * @template T
 *
 * @extends ArrayObject<int|string, T>
 */
class Collection extends ArrayObject implements ResourceInterface
{
    /** @var ResponseInterface Original API response */
    protected $_response; // phpcs:ignore

    /**
     * @var class-string<T>
     */
    protected $resourceClass;

    /**
     * @param mixed[] $result
     * @param class-string<T> $resourceClass
     */
    public function __construct(array $result, string $resourceClass)
    {
        $this->resourceClass = $resourceClass;

        $items = array_map(static function (array $itemValue) use ($resourceClass) {
            return new $resourceClass($itemValue);
        }, $result);

        parent::__construct($items);
    }

    public function getResponse(): ResponseInterface
    {
        if (!isset($this->_response)) {
            throw new RuntimeException('Only resource returned from client has API response set');
        }

        return $this->_response;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->_response = $response;
    }

    /**
     * @return array<T>
     */
    public function getResult(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * @return array<int|string, array<mixed>>
     */
    public function toArray(): array
    {
        return array_map(
            static function (BaseResource $item): array {
                return $item->toArray();
            },
            $this->getArrayCopy()
        );
    }

    public function self(): string
    {
        throw new RuntimeException('Resource has no self link.');
    }

    /**
     * @throws RuntimeException
     */
    public function id(): string
    {
        throw new RuntimeException('Collection doesnt have ID.');
    }

    /**
     * @return array<int|string, array<mixed>>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return class-string<T>
     */
    public function getResourceClass(): string
    {
        return $this->resourceClass;
    }
}
