<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

use PHPUnit\Framework\TestCase;

class UriResolverTest extends TestCase
{

    public function testGetBaseUri(): void
    {
        $uriResolver = new UriResolver(false);

        $this->assertEquals(UriResolver::URI, $uriResolver->getBaseUri());

        $uriResolver = new UriResolver(true);

        $this->assertEquals(UriResolver::URI_SANDBOX, $uriResolver->getBaseUri());
    }
}
