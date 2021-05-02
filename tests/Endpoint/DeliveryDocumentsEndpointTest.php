<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\DeliveryDocumentsEndpoint
 */
class DeliveryDocumentsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/deliveries/bar/documents');
    }

    public function testPositions(): void
    {
        self::endpoint()->positions(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/deliveries/bar/documents/positions', ['foo' => 'bar']);
    }

    public function testDownload(): void
    {
        self::endpoint()->download('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/deliveries/bar/documents/foo/download?foo=bar');
    }

    protected static function endpoint(): DeliveryDocumentsEndpoint
    {
        return self::digiSign()->deliveries()->documents('bar');
    }
}
