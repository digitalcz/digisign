<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Auth\ApiKeyCredentials;
use DigitalCz\DigiSign\Auth\CachedCredentials;
use DigitalCz\DigiSign\Auth\Token;
use DigitalCz\DigiSign\Auth\TokenCredentials;
use Http\Mock\Client;
use InvalidArgumentException;
use LogicException;
use PHPUnit\Framework\TestCase;
use stdClass;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

/**
 * @covers \DigitalCz\DigiSign\DigiSign
 */
class DigiSignTest extends TestCase
{
    public function testCreateWithCredentials(): void
    {
        $digiSign = new DigiSign(['access_key' => 'foo', 'secret_key' => 'bar']);

        $credentials = $digiSign->getCredentials();
        self::assertInstanceOf(ApiKeyCredentials::class, $credentials);
        self::assertSame('foo', $credentials->getAccessKey());
        self::assertSame('bar', $credentials->getSecretKey());
    }

    public function testPleaseProvideCredentialsException(): void
    {
        $digiSign = new DigiSign();

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            'No credentials were provided, Please use setCredentials() ' .
            'or constructor options to set them.',
        );
        $digiSign->getCredentials();
    }

    public function testCreateWithCachedCredentials(): void
    {
        $digiSign = new DigiSign([
            'access_key' => 'foo',
            'secret_key' => 'bar',
            'cache' => new Psr16Cache(new FilesystemAdapter()),
        ]);

        $credentials = $digiSign->getCredentials();
        self::assertInstanceOf(CachedCredentials::class, $credentials);
        $credentials = $credentials->getInner();
        self::assertInstanceOf(ApiKeyCredentials::class, $credentials);
        self::assertSame('foo', $credentials->getAccessKey());
        self::assertSame('bar', $credentials->getSecretKey());
    }

    public function testCreateWithDoubleCachedCredentials(): void
    {
        $cache = new Psr16Cache(new FilesystemAdapter());
        $digiSign = new DigiSign([
            'credentials' => new CachedCredentials(new TokenCredentials(new Token('foo', time())), $cache),
            'cache' => new Psr16Cache(new FilesystemAdapter()),
        ]);

        $credentials = $digiSign->getCredentials();
        self::assertInstanceOf(CachedCredentials::class, $credentials);
        $credentials = $credentials->getInner();
        self::assertInstanceOf(TokenCredentials::class, $credentials);
    }

    public function testCreateWithInvalidCache(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "cache" option');
        new DigiSign(['cache' => new stdClass()]);
    }

    public function testCreateWithCustomCredentials(): void
    {
        $token = new Token('foo', time());

        $digiSign = new DigiSign(['credentials' => new TokenCredentials($token)]);

        $credentials = $digiSign->getCredentials();
        self::assertInstanceOf(TokenCredentials::class, $credentials);
        self::assertSame($token, $credentials->getToken());
    }

    public function testCreateWithInvalidCredentials(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "credentials" option');

        new DigiSign(['credentials' => 'foo:bar']);
    }

    public function testCreateAsTesting(): void
    {
        $mockClient = new Client();
        $digiSign = new DigiSign([
            'credentials' => new TokenCredentials(new Token('foo', time())),
            'client' => new DigiSignClient($mockClient),
            'testing' => true,
        ]);

        $digiSign->request('GET', '/foo');

        self::assertSame('https://api.digisign.digital.cz/foo', (string)$mockClient->getLastRequest()->getUri());
    }

    public function testChildren(): void
    {
        $mockClient = new Client();
        $digiSign = new DigiSign([
            'credentials' => new TokenCredentials(new Token('foo', time())),
            'client' => new DigiSignClient($mockClient),
        ]);

        $digiSign->auth()->request('GET');
        self::assertSame('/api/auth-token', $mockClient->getLastRequest()->getUri()->getPath());
        $digiSign->account()->request('GET');
        self::assertSame('/api/account', $mockClient->getLastRequest()->getUri()->getPath());
        $digiSign->envelopes()->request('GET');
        self::assertSame('/api/envelopes', $mockClient->getLastRequest()->getUri()->getPath());
        $digiSign->deliveries()->request('GET');
        self::assertSame('/api/deliveries', $mockClient->getLastRequest()->getUri()->getPath());
        $digiSign->files()->request('GET');
        self::assertSame('/api/files', $mockClient->getLastRequest()->getUri()->getPath());
        $digiSign->images()->request('GET');
        self::assertSame('/api/images', $mockClient->getLastRequest()->getUri()->getPath());
        $digiSign->webhooks()->request('GET');
        self::assertSame('/api/webhooks', $mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testUserAgent(): void
    {
        $mockClient = new Client();
        $digiSign = new DigiSign([
            'credentials' => new TokenCredentials(new Token('foo', time())),
            'client' => new DigiSignClient($mockClient),
        ]);
        $digiSign->request('GET');
        self::assertSame(
            'digitalcz/digisign:1.0.0 PHP:' . PHP_VERSION,
            $mockClient->getLastRequest()->getHeaderLine('User-Agent'),
        );
    }
}
