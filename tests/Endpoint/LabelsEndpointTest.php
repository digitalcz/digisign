<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\LabelsEndpoint
 */
class LabelsEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list([]);
        self::assertLastRequest('GET', '/api/labels');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/labels/foo');
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['name' => 'Contracts', 'color' => 'red']);
        self::assertLastRequest('POST', '/api/labels', ['name' => 'Contracts', 'color' => 'red']);
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['color' => 'red']);
        self::assertLastRequest('PUT', '/api/labels/foo', ['color' => 'red']);
    }

    protected static function endpoint(): LabelsEndpoint
    {
        return self::dgs()->labels();
    }
}
