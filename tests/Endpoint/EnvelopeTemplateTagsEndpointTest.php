<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EnvelopeTemplateTagsEndpoint::class)]
class EnvelopeTemplateTagsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelope-templates/bar/tags');
    }

    protected static function endpoint(): EnvelopeTemplateTagsEndpoint
    {
        return self::dgs()->envelopeTemplates()->tags('bar');
    }
}
