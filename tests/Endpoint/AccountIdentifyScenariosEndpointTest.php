<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountIdentifyScenariosEndpoint
 */
class AccountIdentifyScenariosEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(
            self::endpoint()->versions('foo'),
            '/api/account/identify-scenarios/foo/versions',
        );
    }

    public function testCRU(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "/api/account/identify-scenarios?foo=bar");

        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/account/identify-scenarios", ['foo' => 'bar']);

        self::endpoint()->get('foo');
        self::assertLastRequest('GET', "/api/account/identify-scenarios/foo");

        self::endpoint()->update('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', "/api/account/identify-scenarios/foo", ['foo' => 'bar']);
    }

    public function testInfo(): void
    {
        self::endpoint()->info();
        self::assertLastRequest('GET', "/api/account/identify-scenarios/info");
    }

    protected static function endpoint(): AccountIdentifyScenariosEndpoint
    {
        return self::dgs()->account()->identifyScenarios();
    }
}
