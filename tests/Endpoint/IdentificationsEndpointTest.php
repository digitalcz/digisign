<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\IdentificationsEndpoint
 */
class IdentificationsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/identifications');
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

    protected static function endpoint(): IdentificationsEndpoint
    {
        return self::dgs()->identifications();
    }
}
