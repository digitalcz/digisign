<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Request;

use PHPUnit\Framework\TestCase;

class CredentialsTest extends TestCase
{

    public function testConstruct(): void
    {
        $object = new Credentials('YourAccessKey', 'YourSecretKey');

        self::assertSame('YourAccessKey', $object->getAccessKey());
        self::assertSame('YourSecretKey', $object->getSecretKey());
    }

    public function testToArray(): void
    {
        $object = new Credentials('YourAccessKey', 'YourSecretKey');

        $data = [
            'accessKey' => 'YourAccessKey',
            'secretKey' => 'YourSecretKey',
        ];

        self::assertSame($data, $object->toArray());
    }
}
