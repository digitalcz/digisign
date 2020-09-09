<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

class Account
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $status;

    public function __construct(string $id, string $email, string $status)
    {
        $this->id = $id;
        $this->email = $email;
        $this->status = $status;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): Account
    {
        return new Account($data['id'], $data['email'], $data['status']);
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'status' => $this->status,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
