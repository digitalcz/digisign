<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\ReportEndpoint
 */
class ReportEndpointTest extends EndpointTestCase
{
    public function testSuggest(): void
    {
        self::endpoint()->sentEnvelopes(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/report/sent-envelopes?foo=bar');
    }

    protected static function endpoint(): ReportEndpoint
    {
        return self::dgs()->report();
    }
}
