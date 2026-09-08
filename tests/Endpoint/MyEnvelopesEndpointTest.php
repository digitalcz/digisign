<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(MyEnvelopesEndpoint::class)]
class MyEnvelopesEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/my/envelopes?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/my/envelopes/foo');
    }

    public function testListToSign(): void
    {
        self::endpoint()->listToSign(['page' => 3, 'itemsPerPage' => 10]);
        self::assertLastRequest('GET', '/api/my/envelopes/to-sign?page=3&itemsPerPage=10');
    }

    public function testListWaitingForOthers(): void
    {
        self::endpoint()->listWaitingForOthers(['page' => 3, 'itemsPerPage' => 10]);
        self::assertLastRequest('GET', '/api/my/envelopes/waiting-for-others?page=3&itemsPerPage=10');
    }

    public function testInfo(): void
    {
        self::endpoint()->info('foo');
        self::assertLastRequest('GET', '/api/my/envelopes/foo/info');
    }

    public function testBulkSign(): void
    {
        self::endpoint()->bulkSign(['envelopeRecipients' => ['foo', 'bar']]);
        self::assertLastRequest('POST', '/api/my/envelopes/bulk-sign', ['envelopeRecipients' => ['foo', 'bar']]);
    }

    protected static function endpoint(): MyEnvelopesEndpoint
    {
        return self::dgs()->my()->envelopes();
    }
}
