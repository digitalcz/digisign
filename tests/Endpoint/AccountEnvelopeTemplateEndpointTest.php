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
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account/envelope-template');
    }

    public function testSmsLog(): void
    {
        self::endpoint()->update(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/envelope-template', ['foo' => 'bar']);
    }

    protected static function endpoint(): AccountEnvelopeTemplateEndpoint
    {
        return self::dgs()->account()->envelopeTemplate();
    }
}
