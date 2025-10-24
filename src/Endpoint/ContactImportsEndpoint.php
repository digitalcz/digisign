<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\ContactImport;

/**
 * @extends ResourceEndpoint<ContactImport>
 * @method ContactImport get(string $id)
 * @method ContactImport create(array $body)
 * @method ContactImport update(string $id, array $body)
 * @method void delete(string $id)
 */
final class ContactImportsEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    use CreateEndpointTrait;
    use UpdateEndpointTrait;
    use DeleteEndpointTrait;

    public function __construct(AccountContactsEndpoint $parent)
    {
        parent::__construct($parent, '/imports', ContactImport::class);
    }

    public function items(ContactImport|string $id): ContactImportItemsEndpoint
    {
        return new ContactImportItemsEndpoint($this, $id);
    }
}
