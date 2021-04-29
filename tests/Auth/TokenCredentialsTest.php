<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Auth\TokenCredentials
 */
class TokenCredentialsTest extends TestCase
{
    public function test(): void
    {
        $token = new Token('token', 123);
        $credentials = new TokenCredentials($token);

        self::assertSame('1fc34072660678ab6395a990ca908258', $credentials->getHash());
        self::assertSame($token, $credentials->getToken());
        self::assertSame($token, $credentials->provide(new DigiSign()));
    }
}
