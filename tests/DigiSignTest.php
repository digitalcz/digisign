<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Auth\ApiKeyCredentials;
use DigitalCz\DigiSign\Auth\CachedCredentials;
use DigitalCz\DigiSign\Auth\Token;
use DigitalCz\DigiSign\Auth\TokenCredentials;
use DigitalCz\DigiSign\Endpoint\AccountEndpoint;
use DigitalCz\DigiSign\Endpoint\AuthEndpoint;
use DigitalCz\DigiSign\Endpoint\DeliveriesEndpoint;
use DigitalCz\DigiSign\Endpoint\EnvelopesEndpoint;
use DigitalCz\DigiSign\Endpoint\FilesEndpoint;
use DigitalCz\DigiSign\Endpoint\ImagesEndpoint;
use DigitalCz\DigiSign\Endpoint\WebhooksEndpoint;
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
        $digiSign = new DigiSign(
            [
                'access_key' => 'foo',
                'secret_key' => 'bar',
                'cache' => new Psr16Cache(new FilesystemAdapter()),
            ],
        );

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
        $digiSign = new DigiSign(
            [
                'credentials' => new CachedCredentials(new TokenCredentials(new Token('foo', time())), $cache),
                'cache' => new Psr16Cache(new FilesystemAdapter()),
            ],
        );

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
        $digiSign = new DigiSign(
            [
                'credentials' => new TokenCredentials(new Token('foo', time())),
                'http_client' => $mockClient,
                'testing' => true,
            ],
        );

        $digiSign->request('GET', '/foo');

        self::assertSame('https://api.digisign.digital.cz/foo', (string)$mockClient->getLastRequest()->getUri());
    }

    public function testChildren(): void
    {
        $dgs = new DigiSign();

        self::assertInstanceOf(AuthEndpoint::class, $dgs->auth());
        self::assertInstanceOf(AccountEndpoint::class, $dgs->account());
        self::assertInstanceOf(EnvelopesEndpoint::class, $dgs->envelopes());
        self::assertInstanceOf(DeliveriesEndpoint::class, $dgs->deliveries());
        self::assertInstanceOf(FilesEndpoint::class, $dgs->files());
        self::assertInstanceOf(ImagesEndpoint::class, $dgs->images());
        self::assertInstanceOf(WebhooksEndpoint::class, $dgs->webhooks());
    }

    public function testUserAgent(): void
    {
        $mockClient = new Client();
        $digiSign = new DigiSign(
            [
                'credentials' => new TokenCredentials(new Token('foo', time())),
                'client' => new DigiSignClient($mockClient),
            ],
        );

        $digiSign->request('GET');
        self::assertSame(
            'digitalcz/digisign:1.0.0 PHP:' . PHP_VERSION,
            $mockClient->getLastRequest()->getHeaderLine('User-Agent'),
        );

        $digiSign->removeVersion('PHP');
        $digiSign->request('GET');
        self::assertSame(
            'digitalcz/digisign:1.0.0',
            $mockClient->getLastRequest()->getHeaderLine('User-Agent'),
        );
    }

    public function testCreateWithApiBase(): void
    {
        $mockClient = new Client();
        $digiSign = new DigiSign(
            [
                'client' => new DigiSignClient($mockClient),
                'credentials' => new TokenCredentials(new Token('foo', time())),
                'api_base' => 'https://example.org/api',
            ],
        );
        $digiSign->request('GET', '/foo');

        self::assertSame('https://example.org/api/foo', (string)$mockClient->getLastRequest()->getUri());
    }

    public function testCreateWithInvalidApiBase(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "api_base" option');

        new DigiSign(['api_base' => ['https://example.org/api']]);
    }
}
