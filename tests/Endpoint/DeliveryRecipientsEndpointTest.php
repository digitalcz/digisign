<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeliveryRecipientsEndpoint::class)]
class DeliveryRecipientsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/deliveries/bar/recipients');
    }

    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->block('foo'), '/api/deliveries/bar/recipients/foo/block');
    }

    public function testResend(): void
    {
        self::endpoint()->resend('foo');
        self::assertLastRequest('POST', '/api/deliveries/bar/recipients/foo/resend');
    }

    protected static function endpoint(): DeliveryRecipientsEndpoint
    {
        return self::dgs()->deliveries()->recipients('bar');
    }
}
