<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\DeliveriesEndpoint
 */
class DeliveriesEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->documents('foo'), '/api/deliveries/foo/documents');
        self::assertDefaultEndpointPath(self::endpoint()->recipients('foo'), '/api/deliveries/foo/recipients');
    }

    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/deliveries');
    }

    public function testCancel(): void
    {
        self::endpoint()->cancel('foo');
        self::assertLastRequest('POST', '/api/deliveries/foo/cancel');
    }

    public function testSend(): void
    {
        self::endpoint()->send('foo');
        self::assertLastRequest('POST', '/api/deliveries/foo/send');
    }

    protected static function endpoint(): DeliveriesEndpoint
    {
        return self::digiSign()->deliveries();
    }
}
