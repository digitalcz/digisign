<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeTemplatesEndpoint
 */
class EnvelopeTemplatesEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(
            self::endpoint()->documents('foo'),
            '/api/envelope-templates/foo/documents'
        );
        self::assertDefaultEndpointPath(
            self::endpoint()->recipients('foo'),
            '/api/envelope-templates/foo/recipients'
        );
        self::assertDefaultEndpointPath(
            self::endpoint()->notifications('foo'),
            '/api/envelope-templates/foo/notifications'
        );
    }

    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelope-templates');
    }

    public function testUse(): void
    {
        self::endpoint()->use('foo');
        self::assertLastRequest('POST', '/api/envelope-templates/foo/use');
    }

    protected static function endpoint(): EnvelopeTemplatesEndpoint
    {
        return self::dgs()->envelopeTemplates();
    }
}
