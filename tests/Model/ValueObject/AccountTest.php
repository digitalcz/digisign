<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testConstruct(): void
    {
        $account = new Account('your-id-example', 'hans@example.com', 'active');

        self::assertSame('your-id-example', $account->getId());
        self::assertSame('hans@example.com', $account->getEmail());
        self::assertSame('active', $account->getStatus());
    }

    public function testFromArray(): void
    {
        $data = [
            'id' => 'your-id-example',
            'email' => 'hans@example.com',
            'status' => 'active',
        ];

        $account = Account::fromArray($data);

        self::assertSame($data['id'], $account->getId());
        self::assertSame($data['email'], $account->getEmail());
        self::assertSame($data['status'], $account->getStatus());
    }

    public function testToArray(): void
    {
        $data = [
            'id' => 'your-id-example',
            'email' => 'hans@example.com',
            'status' => 'active',
        ];

        $account = Account::fromArray($data);

        self::assertSame($data, $account->toArray());
    }
}
