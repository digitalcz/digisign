<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DateTimeInterface;
use DigitalCz\DigiSign\Exception\RuntimeException;
use JsonSerializable;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use ReflectionException;
use ReflectionProperty;

/**
 * Represents an API resource
 */
class BaseResource implements ResourceInterface
{
    /** @var array<string, array<string, string>> Cache of resolved mapping types */
    protected static $_mapping = []; // phpcs:ignore

    /** @var ResponseInterface Original API response */
    protected $_response; // phpcs:ignore

    /** @var mixed[] Original values from API response */
    protected $_result; // phpcs:ignore

    /**
     * @param mixed[] $result
     */
    public function __construct(array $result)
    {
        $this->_result = $result;
        $this->hydrate($result);
    }

    /** @inheritDoc */
    public function getResult(): array
    {
        return $this->_result;
    }

    /** @inheritDoc */
    public function toArray(): array
    {
        $values = get_object_vars($this);

        $result = [];
        foreach ($values as $property => $value) {
            // skip internal properties
            if (in_array($property, ['_mapping', '_response', '_result'], true)) {
                continue;
            }

            if ($value instanceof DateTimeInterface) {
                $value = $value->format(DateTimeInterface::ATOM);
            }

            if ($value instanceof JsonSerializable) {
                $value = $value->jsonSerialize();
            }

            if ($value instanceof Collection) {
                $value = array_map(static function (BaseResource $resource): array {
                    return $resource->toArray();
                }, $value->getArrayCopy());
            }

            $result[$property] = $value;
        }

        return $result;
    }

    public function self(): string
    {
        if (!isset($this->_result['_links']['self'])) {
            throw new RuntimeException('Resource has no self link');
        }

        return $this->_result['_links']['self'];
    }

    public function id(): string
    {
        if (!isset($this->_result['id'])) {
            throw new RuntimeException('Resource has no ID');
        }

        return $this->_result['id'];
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
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
     * @param mixed[] $values
     */
    protected function hydrate(array $values): void
    {
        foreach ($values as $property => $value) {
            $this->setProperty($property, $value);
        }
    }

    /**
     * @param mixed $value
     */
    protected function setProperty(string $property, $value): void
    {
        if ($value !== null) {
            $type = $this->getMappingType($property);

            // is Resource class
            if (is_a($type, self::class, true)) {
                $value = new $type($value);
            }

            // is Collection<Resource>
            if (is_array($value) && strpos($type, 'Collection') === 0) {
                // parse Resource class from type
                preg_match('/Collection<(.+)>/', $type, $matches);
                $resourceClass = $matches[1];
                $items = array_map(static function (array $itemValue) use ($resourceClass) {
                    return new $resourceClass($itemValue);
                }, $value);
                $value = new Collection($items);
            }

            if ($type === DateTime::class) {
                $value = new DateTime($value);
            }
        }

        $this->$property = $value; // @phpstan-ignore-line
    }

    protected function getMappingType(string $property): string
    {
        // cache resolved mapping types
        if (!isset(static::$_mapping[static::class][$property])) {
            static::$_mapping[static::class] = static::$_mapping[static::class] ?? [];
            static::$_mapping[static::class][$property] = $this->resolveMappingType($property);
        }

        return static::$_mapping[static::class][$property];
    }

    protected function resolveMappingType(string $property): string
    {
        try {
            $reflection = new ReflectionProperty($this, $property);
            $phpDoc = $reflection->getDocComment();
        } catch (ReflectionException $e) {
            return 'mixed'; // property may not exist
        }

        if ($phpDoc === false) {
            return 'mixed'; // no doc comment
        }

        if (preg_match('/@var\s+(?<type>[^\s]+)/', $phpDoc, $matches) !== 1) {
            return 'mixed'; // doc comment without @var type
        }

        $type = $matches['type'];

        if (class_exists($type)) {
            return $type; // type is FQCN
        }

        if (class_exists(__NAMESPACE__ . '\\' . $type)) {
            return __NAMESPACE__ . '\\' . $type; // type is class in same namespace
        }

        if (strpos($type, 'Collection') === 0) {
            $collectionType = $this->resolveCollectionMappingType($phpDoc);

            return "Collection<$collectionType>"; // type is collection
        }

        return $type;
    }

    protected function resolveCollectionMappingType(string $phpDoc): string
    {
        if (preg_match('/@var\s+Collection<(?<type>[^\s]+)>/', $phpDoc, $matches) !== 1) {
            throw new LogicException('Cannot resolve Collection type on ' . static::class . ' from ' . $phpDoc);
        }

        $type = $matches['type'];

        if (class_exists(__NAMESPACE__ . '\\' . $type)) {
            return __NAMESPACE__ . '\\' . $type; // type is class in same namespace
        }

        return $type;
    }
}
