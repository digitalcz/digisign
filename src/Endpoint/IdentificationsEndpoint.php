<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Identification;

/**
 * @extends ResourceEndpoint<Identification>
 */
final class IdentificationsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Identification> */
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/identifications', Identification::class);
    }
}
