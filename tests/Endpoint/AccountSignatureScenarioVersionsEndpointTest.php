<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountSignatureScenarioVersionsEndpoint
 */
class AccountSignatureScenarioVersionsEndpointTest extends EndpointTestCase
{
    public function testEndpoints(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "/api/account/signature-scenarios/foo/versions?foo=bar");

        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/account/signature-scenarios/foo/versions", ['foo' => 'bar']);

        self::endpoint()->get('bar');
        self::assertLastRequest('GET', "/api/account/signature-scenarios/foo/versions/bar");

        self::endpoint()->latest();
        self::assertLastRequest('GET', "/api/account/signature-scenarios/foo/versions/latest");
    }

    protected static function endpoint(): AccountSignatureScenarioVersionsEndpoint
    {
        return self::dgs()->account()->signatureScenarios()->versions('foo');
    }
}
