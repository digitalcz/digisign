<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountIdentifyScenarioVersionsEndpoint
 */
class AccountIdentifyScenarioVersionsEndpointTest extends EndpointTestCase
{
    public function testEndpoints(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "/api/account/identify-scenarios/foo/versions?foo=bar");

        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/account/identify-scenarios/foo/versions", ['foo' => 'bar']);

        self::endpoint()->get('bar');
        self::assertLastRequest('GET', "/api/account/identify-scenarios/foo/versions/bar");

        self::endpoint()->latest();
        self::assertLastRequest('GET', "/api/account/identify-scenarios/foo/versions/latest");
    }

    protected static function endpoint(): AccountIdentifyScenarioVersionsEndpoint
    {
        return self::dgs()->account()->identifyScenarios()->versions('foo');
    }
}
