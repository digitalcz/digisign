<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\EnvelopeCategory;

/**
 * @extends ResourceEndpoint<EnvelopeCategory>
 * @method Envelope get(string $id)
 * @method Envelope list(array $query)
 */
class EnvelopeCategoriesEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<EnvelopeCategory> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/envelope-categories', EnvelopeCategory::class);
    }
}
