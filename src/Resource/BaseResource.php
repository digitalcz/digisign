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
use ReflectionNamedType;
use ReflectionProperty;

/**
 * Represents an API resource
 */
class BaseResource implements ResourceInterface
{
    /** @var array<string, string> Cache of resolved mapping types */
    protected static array $mapping = [];

    /** @var ResponseInterface Original API response */
    protected ResponseInterface $response;

    /** @var mixed[] Original values from API response */
    protected array $result;

    /**
     * @param mixed[] $result
     */
    public function __construct(array $result)
    {
        $this->result = $result;
        $this->hydrate($result);
    }

    /** @inheritDoc */
    public function getResult(): array
    {
        return $this->result;
    }

    /** @inheritDoc */
    public function toArray(): array
    {
        $values = get_object_vars($this);

        $result = [];
        foreach ($values as $property => $value) {
            // skip original values and mapping
            if ($property === 'result' || $property === 'mapping') {
                continue;
            }

            if ($value instanceof DateTimeInterface) {
                $value = $value->format(DateTimeInterface::ATOM);
            }

            if ($value instanceof JsonSerializable) {
                $value = $value->jsonSerialize();
            }

            if ($value instanceof Collection) {
                $value = array_map(static fn (BaseResource $resource) => $resource->toArray(), $value->getArrayCopy());
            }

            $result[$property] = $value;
        }

        return $result;
    }

    public function self(): ?string
    {
        return $this->result['_links']['self'] ?? null;
    }

    public function id(): ?string
    {
        return $this->result['id'] ?? null;
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
        if (!isset($this->response)) {
            throw new RuntimeException('Only resource returned from client has API response set');
        }

        return $this->response;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    /**
     * @param mixed[] $values
     */
    protected function hydrate(array $values): void
    {
        foreach ($values as $property => $value) {
            // skip _links and _actions
            if (strpos($property, '_') === 0) {
                continue;
            }

            $this->setProperty($property, $value);
        }
    }

    /**
     * @param mixed $value
     */
    protected function setProperty(string $property, $value): void
    {
        $type = $this->resolveType($property);

        if ($value !== null) {
            // is Resource
            if (is_a($type, self::class, true)) {
                $value = new $type($value);
            }

            // is Collection<Resource>
            if (is_array($value) && strpos($type, 'Collection') === 0) {
                // parse Resource class from type
                preg_match('/Collection<(.+)>/', $type, $matches);
                $resourceClass = $matches[1];
                $items = array_map(static fn (array $itemValue) => new $resourceClass($itemValue), $value);
                $value = new Collection($items);
            }

            if ($type === DateTime::class) {
                $value = new DateTime($value);
            }
        }

        $this->$property = $value;
    }

    protected function resolveType(string $property): string
    {
        if (isset(static::$mapping[$property])) {
            return static::$mapping[$property];
        }

        try {
            $propertyRefl = new ReflectionProperty($this, $property);
            $typeRefl = $propertyRefl->getType();

            $type = $typeRefl instanceof ReflectionNamedType ? $typeRefl->getName() : (string)$typeRefl;

            if ($type === Collection::class) {
                // parse doc type for Collection inner class
                $doc = $propertyRefl->getDocComment();

                if ($doc === false) {
                    throw new LogicException('Cannot resolve Collection type for ' . static::class . '::' . $property);
                }

                preg_match('/Collection<(\w+)>/', $doc, $matches);

                if (!isset($matches[1])) {
                    throw new LogicException('Cannot resolve Collection type for ' . static::class . '::' . $property);
                }

                // expand resource class
                $resourceClass = __NAMESPACE__ . '\\' . $matches[1];
                $type = "Collection<$resourceClass>";
            }

            static::$mapping[$property] = $type;

            return $type;
        } catch (ReflectionException $e) {
            return 'mixed';
        }
    }
}
