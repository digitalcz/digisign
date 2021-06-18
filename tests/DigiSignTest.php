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
        $dgs = new DigiSign(['access_key' => 'foo', 'secret_key' => 'bar']);

        $credentials = $dgs->getCredentials();
        self::assertInstanceOf(ApiKeyCredentials::class, $credentials);
        self::assertSame('foo', $credentials->getAccessKey());
        self::assertSame('bar', $credentials->getSecretKey());
    }

    public function testPleaseProvideCredentialsException(): void
    {
        $dgs = new DigiSign();

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            'No credentials were provided, Please use setCredentials() ' .
            'or constructor options to set them.'
        );
        $dgs->getCredentials();
    }

    public function testCreateWithCachedCredentials(): void
    {
        $dgs = new DigiSign(
            [
                'access_key' => 'foo',
                'secret_key' => 'bar',
                'cache' => new Psr16Cache(new FilesystemAdapter()),
            ]
        );

        $credentials = $dgs->getCredentials();
        self::assertInstanceOf(CachedCredentials::class, $credentials);
        $credentials = $credentials->getInner();
        self::assertInstanceOf(ApiKeyCredentials::class, $credentials);
        self::assertSame('foo', $credentials->getAccessKey());
        self::assertSame('bar', $credentials->getSecretKey());
    }

    public function testCreateWithDoubleCachedCredentials(): void
    {
        $cache = new Psr16Cache(new FilesystemAdapter());
        $dgs = new DigiSign(
            [
                'credentials' => new CachedCredentials(new TokenCredentials(new Token('foo', time())), $cache),
                'cache' => new Psr16Cache(new FilesystemAdapter()),
            ]
        );

        $credentials = $dgs->getCredentials();
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

        $dgs = new DigiSign(['credentials' => new TokenCredentials($token)]);

        $credentials = $dgs->getCredentials();
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
        $dgs = new DigiSign(
            [
                'credentials' => new TokenCredentials(new Token('foo', time())),
                'http_client' => $mockClient,
                'testing' => true,
            ]
        );

        $dgs->request('GET', '/foo');

        self::assertSame('https://api.digisign.digital.cz/foo', (string)$mockClient->getLastRequest()->getUri());
    }

    public function testChildren(): void
    {
        $mockClient = new Client();
        $dgs = new DigiSign(
            [
                'credentials' => new TokenCredentials(new Token('foo', time())),
                'client' => new DigiSignClient($mockClient),
            ]
        );

        $dgs->auth()->request('GET');
        self::assertSame('/api/auth-token', $mockClient->getLastRequest()->getUri()->getPath());
        $dgs->account()->request('GET');
        self::assertSame('/api/account', $mockClient->getLastRequest()->getUri()->getPath());
        $dgs->envelopes()->request('GET');
        self::assertSame('/api/envelopes', $mockClient->getLastRequest()->getUri()->getPath());
        $dgs->envelopeTemplates()->request('GET');
        self::assertSame('/api/envelope-templates', $mockClient->getLastRequest()->getUri()->getPath());
        $dgs->deliveries()->request('GET');
        self::assertSame('/api/deliveries', $mockClient->getLastRequest()->getUri()->getPath());
        $dgs->files()->request('GET');
        self::assertSame('/api/files', $mockClient->getLastRequest()->getUri()->getPath());
        $dgs->images()->request('GET');
        self::assertSame('/api/images', $mockClient->getLastRequest()->getUri()->getPath());
        $dgs->webhooks()->request('GET');
        self::assertSame('/api/webhooks', $mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testUserAgent(): void
    {
        $mockClient = new Client();
        $dgs = new DigiSign(
            [
                'credentials' => new TokenCredentials(new Token('foo', time())),
                'client' => new DigiSignClient($mockClient),
            ]
        );

        $dgs->request('GET');
        self::assertSame(
            'digitalcz/digisign:' . DigiSign::VERSION . ' PHP:' . PHP_VERSION,
            $mockClient->getLastRequest()->getHeaderLine('User-Agent')
        );

        $dgs->removeVersion('PHP');
        $dgs->request('GET');
        self::assertSame(
            'digitalcz/digisign:' . DigiSign::VERSION,
            $mockClient->getLastRequest()->getHeaderLine('User-Agent')
        );
    }

    public function testCreateWithApiBase(): void
    {
        $mockClient = new Client();
        $dgs = new DigiSign(
            [
                'client' => new DigiSignClient($mockClient),
                'credentials' => new TokenCredentials(new Token('foo', time())),
                'api_base' => 'https://example.org/api',
            ]
        );
        $dgs->request('GET', '/foo');

        self::assertSame('https://example.org/api/foo', (string)$mockClient->getLastRequest()->getUri());
    }

    public function testCreateWithInvalidApiBase(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "api_base" option');

        new DigiSign(['api_base' => ['https://example.org/api']]);
    }
}
