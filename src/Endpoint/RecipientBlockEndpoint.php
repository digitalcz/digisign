<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\DeliveryRecipient;
use DigitalCz\DigiSign\Resource\EnvelopeRecipient;
use DigitalCz\DigiSign\Resource\RecipientBlock;

/**
 * @extends ResourceEndpoint<RecipientBlock>
 */
final class RecipientBlockEndpoint extends ResourceEndpoint
{
    /**
     * @param EnvelopeRecipientsEndpoint|DeliveryRecipientsEndpoint $parent
     * @param EnvelopeRecipient|DeliveryRecipient|string $recipient
     */
    public function __construct(EndpointInterface $parent, $recipient)
    {
        parent::__construct($parent, '/{recipient}/block', RecipientBlock::class, ['recipient' => $recipient]);
    }

    public function get(): RecipientBlock
    {
        return $this->createResource($this->getRequest(), $this->getResourceClass());
    }

    public function delete(): void
    {
        $this->deleteRequest();
    }
}
