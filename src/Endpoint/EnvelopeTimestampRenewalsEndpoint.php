<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\TimestampRenewal;

/**
 * @extends ResourceEndpoint<TimestampRenewal>
 */
final class EnvelopeTimestampRenewalsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<TimestampRenewal> */
    use ListEndpointTrait;

    public function __construct(EnvelopesEndpoint $parent, Envelope|string $envelope)
    {
        parent::__construct(
            $parent,
            '/{envelope}/timestamp-renewals',
            TimestampRenewal::class,
            ['envelope' => $envelope],
        );
    }
}
