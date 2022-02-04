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
        self::assertDefaultEndpointPath(self::endpoint()->labels('foo'), '/api/envelopes/foo/labels');
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
        self::endpoint()->embedEdit('foo', ['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/envelopes/foo/embed/edit', ['foo' => 'bar']);
    }

    public function testEmbedSigning(): void
    {
        self::endpoint()->embedSigning('foo', ['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/envelopes/foo/embed/signing', ['foo' => 'bar']);
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

    public function testResend(): void
    {
        self::endpoint()->resend('foo');
        self::assertLastRequest('POST', '/api/envelopes/foo/resend');
    }

    public function testTemplate(): void
    {
        self::endpoint()->template('foo');
        self::assertLastRequest('GET', '/api/envelopes/foo/template');
    }

    public function testClone(): void
    {
        self::endpoint()->clone('foo');
        self::assertLastRequest('POST', '/api/envelopes/foo/clone');
    }

    public function testDiscard(): void
    {
        self::endpoint()->discard('foo');
        self::assertLastRequest('POST', '/api/envelopes/foo/discard');
    }

    public function testRestore(): void
    {
        self::endpoint()->restore('foo');
        self::assertLastRequest('POST', '/api/envelopes/foo/restore');
    }

    protected static function endpoint(): EnvelopesEndpoint
    {
        return self::dgs()->envelopes();
    }
}
