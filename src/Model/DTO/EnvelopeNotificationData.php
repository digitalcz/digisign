<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

class EnvelopeNotificationData
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $days;

    public function __construct(string $type, int $days)
    {
        $this->type = $type;
        $this->days = $days;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'],
            $data['days']
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'days' => $this->days,
        ];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDays(): int
    {
        return $this->days;
    }
}
