<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\IdentificationDocumentEndpoint
 */
class IdentificationDocumentEndpointTest extends EndpointTestCase
{
    public function testFront(): void
    {
        self::endpoint()->front(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/identifications/foo/primary-document/front?foo=bar');
    }

    public function testBack(): void
    {
        self::endpoint()->back(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/identifications/foo/primary-document/back?foo=bar');
    }

    protected static function endpoint(): IdentificationDocumentEndpoint
    {
        return self::dgs()->identifications()->primaryDocument('foo');
    }
}
