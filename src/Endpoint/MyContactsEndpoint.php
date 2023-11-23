<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\Contact;

/**
 * @extends ResourceEndpoint<Contact>
 */
final class MyContactsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Contact> */
    use CRUDEndpointTrait;

    public function __construct(MyEndpoint $parent)
    {
        parent::__construct($parent, '/contacts', Contact::class);
    }

    /**
     * @return Collection<Contact>
     */
    public function suggest(string $search = '', int $limit = 30): Collection
    {
        $response = $this->getRequest('/suggest', ['query' => ['search' => $search, 'limit' => $limit]]);

        return $this->createCollectionResource($response, Contact::class);
    }
}
