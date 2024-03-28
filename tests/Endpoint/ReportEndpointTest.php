<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\ReportEndpoint
 */
class ReportEndpointTest extends EndpointTestCase
{
    public function testSentEnvelopes(): void
    {
        self::endpoint()->sentEnvelopes(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/report/sent-envelopes?foo=bar');
    }

    public function testCompletedIdentifications(): void
    {
        self::endpoint()->completedIdentifications(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/report/completed-identifications?foo=bar');
    }

    protected static function endpoint(): ReportEndpoint
    {
        return self::dgs()->report();
    }
}
