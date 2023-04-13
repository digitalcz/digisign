<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountSignatureScenariosEndpoint
 */
class AccountSignatureScenariosEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(
            self::endpoint()->versions('foo'),
            '/api/account/signature-scenarios/foo/versions',
        );
    }

    public function testCRU(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "/api/account/signature-scenarios?foo=bar");

        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/account/signature-scenarios", ['foo' => 'bar']);

        self::endpoint()->get('foo');
        self::assertLastRequest('GET', "/api/account/signature-scenarios/foo");

        self::endpoint()->update('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', "/api/account/signature-scenarios/foo", ['foo' => 'bar']);
    }

    protected static function endpoint(): AccountSignatureScenariosEndpoint
    {
        return self::dgs()->account()->signatureScenarios();
    }
}
