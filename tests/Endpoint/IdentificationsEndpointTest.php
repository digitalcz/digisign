<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\IdentificationsEndpoint
 */
class IdentificationsEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(
            self::endpoint()->primaryDocument('foo'),
            '/api/identifications/foo/primary-document',
        );
        self::assertDefaultEndpointPath(
            self::endpoint()->secondaryDocument('foo'),
            '/api/identifications/foo/secondary-document',
        );
    }

    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/identifications?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/identifications/foo');
    }

    public function testApprove(): void
    {
        self::endpoint()->approve('foo');
        self::assertLastRequest('POST', '/api/identifications/foo/approve');
    }

    public function testDeny(): void
    {
        self::endpoint()->deny('foo');
        self::assertLastRequest('POST', '/api/identifications/foo/deny');
    }

    public function testDenyWithBody(): void
    {
        self::endpoint()->deny('foo', ['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/identifications/foo/deny', ['foo' => 'bar']);
    }

    public function testCancel(): void
    {
        self::endpoint()->cancel('foo');
        self::assertLastRequest('POST', '/api/identifications/foo/cancel');
    }

    public function testDelete(): void
    {
        self::endpoint()->delete('foo');
        self::assertLastRequest('DELETE', '/api/identifications/foo');
    }

    public function testDiscard(): void
    {
        self::endpoint()->discard('foo');
        self::assertLastRequest('POST', '/api/identifications/foo/discard');
    }

    public function testDiscardWithBody(): void
    {
        self::endpoint()->discard('foo', ['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/identifications/foo/discard', ['foo' => 'bar']);
    }

    public function testRestore(): void
    {
        self::endpoint()->restore('foo');
        self::assertLastRequest('POST', '/api/identifications/foo/restore');
    }

    public function testBankStatement(): void
    {
        self::endpoint()->bankStatement('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/identifications/foo/bank-statement?foo=bar');
    }

    public function testProtocol(): void
    {
        self::endpoint()->protocol('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/identifications/foo/protocol?foo=bar');
    }

    public function testSelfie(): void
    {
        self::endpoint()->selfie('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/identifications/foo/selfie?foo=bar');
    }

    protected static function endpoint(): IdentificationsEndpoint
    {
        return self::dgs()->identifications();
    }
}
