<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\Contact;

/**
 * @extends ResourceEndpoint<Contact>
 */
final class ContactsEndpoint extends ResourceEndpoint
{
    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/contacts', Contact::class);
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
