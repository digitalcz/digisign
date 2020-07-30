<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Request\Recipient\RecipientDeleteRequest;
use DigitalCz\DigiSign\Request\Recipient\RecipientGetRequest;
use DigitalCz\DigiSign\Request\Recipient\RecipientPostRequest;
use DigitalCz\DigiSign\Request\Recipient\RecipientPutRequest;
use DigitalCz\DigiSign\Request\Recipient\RecipientsGetRequest;
use DigitalCz\DigiSign\Response\Recipient\RecipientDeleteResponse;
use DigitalCz\DigiSign\Response\Recipient\RecipientResponse;
use DigitalCz\DigiSign\Response\Recipient\RecipientsGetResponse;
use DigitalCz\DigiSign\ValueObject\Request\Recipient as RequestRecipient;
use DigitalCz\DigiSign\ValueObject\Response\Recipient as ResponseRecipient;

class RecipientApi extends BaseApi
{

    public function createRecipient(RequestRecipient $object): ResponseRecipient
    {
        $httpRequest = (new RecipientPostRequest($this->httpRequestFactory, $this->httpStreamFactory, $object))();
        $httpResponse = $this->client->request($httpRequest);

        return (new RecipientResponse($httpResponse))();
    }

    public function updateRecipient(string $recipientId, RequestRecipient $object): ResponseRecipient
    {
        $httpRequest =
            (new RecipientPutRequest($this->httpRequestFactory, $this->httpStreamFactory, $object, $recipientId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new RecipientResponse($httpResponse))();
    }

    /**
     * @return array<ResponseRecipient>|ResponseRecipient[]
     */
    public function getRecipients(int $page = 1, int $itemsPerPage = 30): array
    {
        $httpRequest =
            (new RecipientsGetRequest($this->httpRequestFactory, $this->httpStreamFactory, $page, $itemsPerPage))();
        $httpResponse = $this->client->request($httpRequest);

        return (new RecipientsGetResponse($httpResponse))();
    }


    public function getRecipient(string $recipientId): ResponseRecipient
    {
        $httpRequest = (new RecipientGetRequest($this->httpRequestFactory, $this->httpStreamFactory, $recipientId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new RecipientResponse($httpResponse))();
    }

    public function deleteRecipient(string $recipientId): int
    {
        $httpRequest =
            (new RecipientDeleteRequest($this->httpRequestFactory, $this->httpStreamFactory, $recipientId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new RecipientDeleteResponse($httpResponse))();
    }
}
