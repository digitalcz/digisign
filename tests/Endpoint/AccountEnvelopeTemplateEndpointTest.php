<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountEnvelopeTemplateEndpoint
 */
class AccountEnvelopeTemplateEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::$digiSign->account()->envelopeTemplate()->get();
        self::assertLastRequest('GET', '/api/account/envelope-template');
    }

    public function testSmsLog(): void
    {
        self::$digiSign->account()->envelopeTemplate()->update(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/envelope-template', ['foo' => 'bar']);
    }
}
