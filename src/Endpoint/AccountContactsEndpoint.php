<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Contact;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<Contact>
 * @method ListResource<Contact> list(array $query = [])
 * @method Contact get(string $id)
 * @method Contact create(array $body)
 * @method Contact update(string $id, array $body)
 */
final class AccountContactsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Contact> */
    use CRUDEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/contacts', Contact::class);
    }

    public function import(): ContactImportsEndpoint
    {
        return new ContactImportsEndpoint($this);
    }
}
