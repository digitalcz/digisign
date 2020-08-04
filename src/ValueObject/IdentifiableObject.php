<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject;

abstract class IdentifiableObject
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param array<mixed> $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new static($data['id']);
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }

    final public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
