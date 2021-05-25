<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopesEndpoint
 */
class EnvelopesEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->documents('foo'), '/api/envelopes/foo/documents');
        self::assertDefaultEndpointPath(self::endpoint()->recipients('foo'), '/api/envelopes/foo/recipients');
        self::assertDefaultEndpointPath(self::endpoint()->tags('foo'), '/api/envelopes/foo/tags');
        self::assertDefaultEndpointPath(self::endpoint()->notifications('foo'), '/api/envelopes/foo/notifications');
    }

    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelopes');
    }

    public function testCancel(): void
    {
        self::endpoint()->cancel('foo');
        self::assertLastRequest('POST', '/api/envelopes/foo/cancel');
    }

    public function testCount(): void
    {
        self::endpoint()->count();
        self::assertLastRequest('GET', '/api/envelopes/count');
    }

    public function testDownload(): void
    {
        self::endpoint()->download('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/envelopes/foo/download?foo=bar');
    }

    public function testEmbedEdit(): void
    {
        self::endpoint()->embedEdit('foo');
        self::assertLastRequest('POST', '/api/envelopes/foo/embed/edit');
    }

    public function testExtend(): void
    {
        self::endpoint()->extend('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/envelopes/foo/extend', ['foo' => 'bar']);
    }

    public function testSend(): void
    {
        self::endpoint()->send('foo');
        self::assertLastRequest('POST', '/api/envelopes/foo/send');
    }

    protected static function endpoint(): EnvelopesEndpoint
    {
        return self::dgs()->envelopes();
    }
}
