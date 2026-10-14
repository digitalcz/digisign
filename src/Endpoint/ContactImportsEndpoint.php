<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\ContactImport;
use DigitalCz\DigiSign\Resource\ContactImportProgress;

/**
 * @extends ResourceEndpoint<ContactImport>
 * @method ContactImport get(string $id)
 * @method ContactImport create(mixed[] $body)
 * @method ContactImport update(string $id, mixed[] $body)
 * @method void delete(string $id)
 */
final class ContactImportsEndpoint extends ResourceEndpoint
{
    use CreateEndpointTrait;
    use DeleteEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;

    public function __construct(AccountContactsEndpoint $parent)
    {
        parent::__construct($parent, '/imports', ContactImport::class);
    }

    public function items(ContactImport|string $id): ContactImportItemsEndpoint
    {
        return new ContactImportItemsEndpoint($this, $id);
    }

    public function progress(ContactImport|string $id): ContactImportProgress
    {
        return $this->createResource(
            $this->getRequest('/{id}/progress', ['id' => $id]),
            ContactImportProgress::class,
        );
    }

    public function start(ContactImport|string $id): ContactImportProgress
    {
        return $this->createResource(
            $this->postRequest('/{id}/start', ['id' => $id]),
            ContactImportProgress::class,
        );
    }
}
