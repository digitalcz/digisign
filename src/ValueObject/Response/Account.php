<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Response;

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
     * @return Account
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
}
