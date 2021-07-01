<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Resource\BaseResource;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class EnumsEndpoint extends ResourceEndpoint
{
    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/enums');
    }

    /**
     * @return array<string>
     */
    public function get(string $enum): array
    {
        return $this->parseResponse($this->getRequest('/{enum}', ['enum' => $enum]));
    }
}
