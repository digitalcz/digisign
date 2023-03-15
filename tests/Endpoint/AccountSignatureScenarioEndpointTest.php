<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountSignatureScenariosEndpoint
 */
class AccountSignatureScenarioEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/account/signature-scenarios');
    }

    protected static function endpoint(): AccountSignatureScenariosEndpoint
    {
        return self::dgs()->account()->signatureScenarios();
    }
}
