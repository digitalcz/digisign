<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Delivery;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\DeliveryDocument\DeliveryDocumentDeleteRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryDocument\DeliveryDocumentGetRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryDocument\DeliveryDocumentPostRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryDocument\DeliveryDocumentPutRequest;
use DigitalCz\DigiSign\Http\Request\DeliveryDocument\DeliveryDocumentsGetRequest;
use DigitalCz\DigiSign\Http\Response\DeliveryDocument\DeliveryDocumentDeleteResponse;
use DigitalCz\DigiSign\Http\Response\DeliveryDocument\DeliveryDocumentResponse;
use DigitalCz\DigiSign\Http\Response\DeliveryDocument\DeliveryDocumentsGetResponse;
use DigitalCz\DigiSign\Model\DTO\DeliveryDocumentData;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryDocument;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryDocument\DeliveryDocumentList;

class DeliveryDocumentApi extends BaseApi
{
    public function createDocument(string $deliveryId, DeliveryDocumentData $documentData): DeliveryDocument
    {
        $httpRequest = (new DeliveryDocumentPostRequest($this->requestBuilder))($deliveryId, $documentData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryDocumentResponse())($httpResponse);
    }

    public function updateDocument(
        string $deliveryId,
        string $documentId,
        DeliveryDocumentData $documentData
    ): DeliveryDocument {
        $httpRequest = (new DeliveryDocumentPutRequest($this->requestBuilder))($deliveryId, $documentId, $documentData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryDocumentResponse())($httpResponse);
    }

    public function getDocument(string $deliveryId, string $documentId): DeliveryDocument
    {
        $httpRequest = (new DeliveryDocumentGetRequest($this->requestBuilder))($deliveryId, $documentId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryDocumentResponse())($httpResponse);
    }

    public function getDocuments(
        string $deliveryId,
        int $page = 1,
        int $itemsPerPage = 30
    ): DeliveryDocumentList {
        $httpRequest = (new DeliveryDocumentsGetRequest($this->requestBuilder))($deliveryId, $page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryDocumentsGetResponse())($httpResponse);
    }

    public function deleteDocument(string $deliveryId, string $documentId): int
    {
        $httpRequest = (new DeliveryDocumentDeleteRequest($this->requestBuilder))($deliveryId, $documentId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryDocumentDeleteResponse())($httpResponse);
    }
}
