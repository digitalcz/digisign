<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\Envelope;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class MyEnvelopeRecipientsEndpoint extends ResourceEndpoint
{
    public function __construct(MyEnvelopesEndpoint $parent, string|Envelope $envelope)
    {
        parent::__construct($parent, '/{envelope}/recipients', resourceOptions: ['envelope' => $envelope]);
    }

    /**
     * @param mixed[] $body
     */
    public function embed(string $recipient, array $body): void
    {
        $this->postRequest('/{recipient}/embed', ['recipient' => $recipient, 'json' => $body]);
    }
}
