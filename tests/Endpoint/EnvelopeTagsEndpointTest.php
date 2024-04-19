<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeTagsEndpoint
 */
class EnvelopeTagsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelopes/bar/tags');
    }

    public function testUpdateValues(): void
    {
        self::endpoint()->updateValues(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/envelopes/bar/tags/values',  ['foo' => 'bar']);
    }

    protected static function endpoint(): EnvelopeTagsEndpoint
    {
        return self::dgs()->envelopes()->tags('bar');
    }
}
