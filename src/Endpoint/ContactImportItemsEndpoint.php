<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\ContactImport;
use DigitalCz\DigiSign\Resource\ContactImportItem;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<ContactImportItem>
 * @method ListResource<ContactImportItem> list(mixed[] $query = [])
 */
final class ContactImportItemsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<ContactImportItem> */
    use ListEndpointTrait;

    public function __construct(ContactImportsEndpoint $parent, ContactImport|string $contactImport)
    {
        parent::__construct(
            $parent,
            '/{contactImport}/items',
            ContactImportItem::class,
            ['contactImport' => $contactImport],
        );
    }

    /**
     * @param array<mixed> $body
     */
    public function upload(array $body): void
    {
        $this->postRequest('/upload', ['json' => $body]);
    }
}
