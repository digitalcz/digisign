<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyEnvelopesEndpoint
 */
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

    protected static function endpoint(): MyEnvelopesEndpoint
    {
        return self::dgs()->my()->envelopes();
    }
}
