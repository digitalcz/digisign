<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Delivery;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\DeliveryRecipient\DeliveryRecipientDeleteRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryRecipient\DeliveryRecipientGetRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryRecipient\DeliveryRecipientPostRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryRecipient\DeliveryRecipientPutRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryRecipient\DeliveryRecipientsGetRequest;
use DigitalCz\DigiSign\Http\Response\DeliveryRecipient\DeliveryRecipientDeleteResponse;
use DigitalCz\DigiSign\Http\Response\DeliveryRecipient\DeliveryRecipientResponse;
use DigitalCz\DigiSign\Http\Response\DeliveryRecipient\DeliveryRecipientsGetResponse;
use DigitalCz\DigiSign\Model\DTO\DeliveryRecipientData;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryRecipient;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryRecipient\DeliveryRecipientList;

class DeliveryRecipientApi extends BaseApi
{
    public function createRecipient(string $deliveryId, DeliveryRecipientData $data): DeliveryRecipient
    {
        $httpRequest = (new DeliveryRecipientPostRequest($this->requestBuilder))($deliveryId, $data);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryRecipientResponse())($httpResponse);
    }

    public function updateRecipient(
        string $deliveryId,
        string $recipientId,
        DeliveryRecipientData $recipientData
    ): DeliveryRecipient {
        $httpRequest =
            (new DeliveryRecipientPutRequest($this->requestBuilder))($deliveryId, $recipientId, $recipientData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryRecipientResponse())($httpResponse);
    }

    public function getRecipients(string $deliveryId, int $page = 1, int $itemsPerPage = 30): DeliveryRecipientList
    {
        $httpRequest = (new DeliveryRecipientsGetRequest($this->requestBuilder))($deliveryId, $page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryRecipientsGetResponse())($httpResponse);
    }

    public function getRecipient(string $deliveryId, string $recipientId): DeliveryRecipient
    {
        $httpRequest = (new DeliveryRecipientGetRequest($this->requestBuilder))($deliveryId, $recipientId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryRecipientResponse())($httpResponse);
    }

    public function deleteRecipient(string $deliveryId, string $recipientId): int
    {
        $httpRequest = (new DeliveryRecipientDeleteRequest($this->requestBuilder))($deliveryId, $recipientId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryRecipientDeleteResponse())($httpResponse);
    }
}
