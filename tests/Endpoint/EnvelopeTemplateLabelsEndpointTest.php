<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeTemplateLabelsEndpoint
 */
class EnvelopeTemplateLabelsEndpointTest extends EndpointTestCase
{
    public function testAll(): void
    {
        self::endpoint()->all();
        self::assertLastRequest('GET', '/api/envelope-templates/bar/labels');
    }

    public function testSet(): void
    {
        self::endpoint()->set(['foo', 'moo']);
        self::assertLastRequest('PUT', '/api/envelope-templates/bar/labels', ['foo', 'moo']);
    }

    public function testAdd(): void
    {
        self::endpoint()->add('moo');
        self::assertLastRequest('PUT', '/api/envelope-templates/bar/labels/moo');
    }

    public function testRemove(): void
    {
        self::endpoint()->remove('moo');
        self::assertLastRequest('DELETE', '/api/envelope-templates/bar/labels/moo');
    }

    protected static function endpoint(): EnvelopeTemplateLabelsEndpoint
    {
        return self::dgs()->envelopeTemplates()->labels('bar');
    }
}
