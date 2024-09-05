<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeDocumentsEndpoint
 */
class EnvelopeDocumentsEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->assignments(), '/api/envelopes/bar/documents/assignments');
    }

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

    public function testTagsByAutoplacement(): void
    {
        self::endpoint()->createTagsByAutoplacement('foo');
        self::assertLastRequest('POST', '/api/envelopes/bar/documents/foo/tags/by-autoplacement');
    }

    public function testReplaceFile(): void
    {
        self::endpoint()->replaceFile('foo', ['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/envelopes/bar/documents/foo/replace-file', ['foo' => 'bar']);
    }

    public function testInvalidate(): void
    {
        self::endpoint()->invalidate('foo');
        self::assertLastRequest('POST', '/api/envelopes/bar/documents/foo/invalidate');
    }

    public function testRestore(): void
    {
        self::endpoint()->restore('foo');
        self::assertLastRequest('POST', '/api/envelopes/bar/documents/foo/restore');
    }

    public function testSignatureSheets(): void
    {
        self::endpoint()->signatureSheets();
        self::assertLastRequest('GET', '/api/envelopes/bar/documents/signature-sheets');
    }

    protected static function endpoint(): EnvelopeDocumentsEndpoint
    {
        return self::dgs()->envelopes()->documents('bar');
    }
}
