<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeLabelsEndpoint
 */
class EnvelopeLabelsEndpointTest extends EndpointTestCase
{
    public function testAll(): void
    {
        self::endpoint()->all();
        self::assertLastRequest('GET', '/api/envelopes/bar/labels');
    }

    public function testSet(): void
    {
        self::endpoint()->set(['foo', 'moo']);
        self::assertLastRequest('PUT', '/api/envelopes/bar/labels', ['foo', 'moo']);
    }

    public function testAdd(): void
    {
        self::endpoint()->add('moo');
        self::assertLastRequest('PUT', '/api/envelopes/bar/labels/moo');
    }

    public function testRemove(): void
    {
        self::endpoint()->remove('moo');
        self::assertLastRequest('DELETE', '/api/envelopes/bar/labels/moo');
    }

    protected static function endpoint(): EnvelopeLabelsEndpoint
    {
        return self::dgs()->envelopes()->labels('bar');
    }
}
