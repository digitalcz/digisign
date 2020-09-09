<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\EnvelopeRecipient\RecipientDeleteRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeRecipient\RecipientGetRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeRecipient\RecipientPostRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeRecipient\RecipientPutRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeRecipient\RecipientsGetRequest;
use DigitalCz\DigiSign\Http\Response\EnvelopeRecipient\RecipientDeleteResponse;
use DigitalCz\DigiSign\Http\Response\EnvelopeRecipient\RecipientResponse;
use DigitalCz\DigiSign\Http\Response\EnvelopeRecipient\RecipientsGetResponse;
use DigitalCz\DigiSign\Model\DTO\EnvelopeRecipientData;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeRecipient;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeRecipient\EnvelopeRecipientList;

class EnvelopeRecipientApi extends BaseApi
{

    public function createRecipient(string $envelopeId, EnvelopeRecipientData $data): EnvelopeRecipient
    {
        $httpRequest = (new RecipientPostRequest($this->requestBuilder))($envelopeId, $data);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new RecipientResponse())($httpResponse);
    }

    public function updateRecipient(
        string $envelopeId,
        string $recipientId,
        EnvelopeRecipientData $recipientData
    ): EnvelopeRecipient {
        $httpRequest = (new RecipientPutRequest($this->requestBuilder))($envelopeId, $recipientId, $recipientData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new RecipientResponse())($httpResponse);
    }

    public function getRecipients(string $envelopeId, int $page = 1, int $itemsPerPage = 30): EnvelopeRecipientList
    {
        $httpRequest = (new RecipientsGetRequest($this->requestBuilder))($envelopeId, $page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new RecipientsGetResponse())($httpResponse);
    }

    public function getRecipient(string $envelopeId, string $recipientId): EnvelopeRecipient
    {
        $httpRequest = (new RecipientGetRequest($this->requestBuilder))($envelopeId, $recipientId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new RecipientResponse())($httpResponse);
    }

    public function deleteRecipient(string $envelopeId, string $recipientId): int
    {
        $httpRequest = (new RecipientDeleteRequest($this->requestBuilder))($envelopeId, $recipientId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new RecipientDeleteResponse())($httpResponse);
    }
}
