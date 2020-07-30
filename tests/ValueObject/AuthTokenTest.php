<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject;

use PHPUnit\Framework\TestCase;

class AuthTokenTest extends TestCase
{
    public function testConstruct(): void
    {
        $expiresAt = time();

        $authToken = new AuthToken('YourSecretToken', $expiresAt);

        self::assertSame('YourSecretToken', $authToken->getToken());
        self::assertSame($expiresAt, $authToken->getExpiresAt());
    }

    public function testTtlMethod(): void
    {
        $expiresAt = time();

        $authToken = new AuthToken('YourSecretToken', $expiresAt);

        self::assertSame(time() - $expiresAt, $authToken->getTtl());

        $expiresAt = 123;

        $authToken = new AuthToken('YourSecretToken', $expiresAt);

        self::assertSame(0, $authToken->getTtl());
    }

    public function testFromArray(): void
    {
        $data = [
            'token' => 'AccessTokenIU78JO',
            'expiresAt' => time(),
        ];

        $authToken = AuthToken::fromArray($data);

        self::assertSame($data['token'], $authToken->getToken());
        self::assertSame($data['expiresAt'], $authToken->getExpiresAt());
    }

    public function testToArray(): void
    {
        $data = [
            'token' => 'AccessTokenIU78JO',
            'expiresAt' => time(),
        ];

        $authToken = AuthToken::fromArray($data);

        self::assertSame($data, $authToken->toArray());
    }
}
