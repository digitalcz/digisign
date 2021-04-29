<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Psr16Cache;

/**
 * @covers \DigitalCz\DigiSign\Auth\CachedCredentials
 */
class CachedCredentialsTest extends TestCase
{
    public function testHash(): void
    {
        $credentials = new TokenCredentials(new Token('token', 123));
        $cache = new Psr16Cache(new ArrayAdapter());
        $cachedCredentials = new CachedCredentials($credentials, $cache);

        self::assertSame($credentials, $cachedCredentials->getInner());
        self::assertSame('DGS_tok_1fc34072660678ab6395a990ca908258', $cachedCredentials->getHash());
    }

    public function testProvide(): void
    {
        $credentials = $this->createMock(Credentials::class);
        $credentials
            ->expects(self::once())
            ->method('provide')
            ->willReturn(new Token('token', time() + 300));

        $digiSign = new DigiSign();

        $cache = new Psr16Cache(new ArrayAdapter());
        $cachedCredentials = new CachedCredentials($credentials, $cache);

        $cachedCredentials->provide($digiSign);
        $cachedCredentials->provide($digiSign);
        $cachedCredentials->provide($digiSign);
        $cachedCredentials->provide($digiSign);
    }
}
