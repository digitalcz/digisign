<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
class EnvelopeDocumentAssignmentsEndpoint extends ResourceEndpoint
{
    public function __construct(EnvelopeDocumentsEndpoint $parent)
    {
        parent::__construct($parent, '/assignments');
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function get(): array
    {
        return $this->parseResponse(
            $this->getRequest('')
        );
    }

    /**
     * @param array<string, array<string, string>> $body
     */
    public function set(array $body): void
    {
        $this->putRequest('', ['json' => $body]);
    }
}
