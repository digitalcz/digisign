<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AccountIdentifyScenariosInspectionChecksEndpoint::class)]
class AccountIdentifyScenariosInspectionChecksEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(
            self::endpoint(),
            '/api/account/identify-scenarios/inspection-checks',
        );
    }

    public function testDefaults(): void
    {
        self::endpoint()->defaults();
        self::assertLastRequest('GET', "/api/account/identify-scenarios/inspection-checks/defaults");
    }

    protected static function endpoint(): AccountIdentifyScenariosInspectionChecksEndpoint
    {
        return self::dgs()->account()->identifyScenarios()->inspectionChecks();
    }
}
