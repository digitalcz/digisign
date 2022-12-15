<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\EnvelopeRecipient;
use DigitalCz\DigiSign\Resource\EnvelopeRecipientAttachment;
use DigitalCz\DigiSign\Stream\FileResponse;

/**
 * @extends ResourceEndpoint<EnvelopeRecipientAttachment>
 * @method EnvelopeRecipientAttachment get(string $id)
 */
final class EnvelopeRecipientAttachmentsEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;

    public function __construct(EnvelopeRecipientsEndpoint $parent, EnvelopeRecipient|string $recipient)
    {
        parent::__construct(
            $parent,
            '/{recipient}/attachments',
            EnvelopeRecipientAttachment::class,
            ['recipient' => $recipient]
        );
    }

    /**
     * @return Collection<EnvelopeRecipientAttachment>
     */
    public function list(): Collection
    {
        return $this->createCollectionResource($this->getRequest(), $this->getResourceClass());
    }

    /**
     * @param mixed[] $query
     */
    public function download(EnvelopeRecipientAttachment|string $id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/download', ['id' => $id, 'query' => $query]);
    }
}
