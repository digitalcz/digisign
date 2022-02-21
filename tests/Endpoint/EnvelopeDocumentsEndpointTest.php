<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeDocumentsEndpoint
 */
class EnvelopeDocumentsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelopes/bar/documents');
    }

    public function testPositions(): void
    {
        self::endpoint()->positions(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/envelopes/bar/documents/positions');
    }

    public function testMerge(): void
    {
        self::endpoint()->merge();
        self::assertLastRequest('POST', '/api/envelopes/bar/documents/merge');
    }

    public function testDownload(): void
    {
        self::endpoint()->download('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/envelopes/bar/documents/foo/download?foo=bar');
    }

    public function testTags(): void
    {
        self::endpoint()->tags('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/envelopes/bar/documents/foo/tags?foo=bar');
    }

    public function testReplaceFile(): void
    {
        self::endpoint()->replaceFile('foo', ['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/envelopes/bar/documents/foo/replace-file', ['foo' => 'bar']);
    }

    protected static function endpoint(): EnvelopeDocumentsEndpoint
    {
        return self::dgs()->envelopes()->documents('bar');
    }
}
