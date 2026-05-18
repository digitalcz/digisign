<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeCategoriesEndpoint
 */
final class EnvelopeCategoriesEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "/api/envelope-categories?foo=bar");
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', "/api/envelope-categories/foo");
    }

    protected static function endpoint(): EnvelopeCategoriesEndpoint
    {
        return self::dgs()->envelopeCategories();
    }
}
