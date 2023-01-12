<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\SentEnvelopeReport;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class ReportEndpoint extends ResourceEndpoint
{
    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/report');
    }

    /**
     * @param array<string, mixed> $query
     * @return ListResource<SentEnvelopeReport>
     */
    public function sentEnvelopes(array $query): ListResource
    {
        return $this->createListResource(
            $this->getRequest('/sent-envelopes', ['query' => $query]),
            SentEnvelopeReport::class,
        );
    }
}
