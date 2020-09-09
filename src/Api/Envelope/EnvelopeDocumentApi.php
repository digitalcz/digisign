<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\EnvelopeDocument\DocumentDeleteRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeDocument\DocumentGetRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeDocument\DocumentPostRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeDocument\DocumentPutRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeDocument\DocumentsGetRequest;
use DigitalCz\DigiSign\Http\Response\EnvelopeDocument\DocumentDeleteResponse;
use DigitalCz\DigiSign\Http\Response\EnvelopeDocument\DocumentResponse;
use DigitalCz\DigiSign\Http\Response\EnvelopeDocument\DocumentsGetResponse;
use DigitalCz\DigiSign\Model\DTO\EnvelopeDocumentData;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeDocument;

class EnvelopeDocumentApi extends BaseApi
{
    public function createDocument(string $envelopeId, EnvelopeDocumentData $documentData): EnvelopeDocument
    {
        $httpRequest = (new DocumentPostRequest($this->requestBuilder))($envelopeId, $documentData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DocumentResponse())($httpResponse);
    }

    public function updateDocument(
        string $envelopeId,
        string $documentId,
        EnvelopeDocumentData $documentData
    ): EnvelopeDocument {
        $httpRequest = (new DocumentPutRequest($this->requestBuilder))($envelopeId, $documentId, $documentData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DocumentResponse())($httpResponse);
    }

    public function getDocument(string $envelopeId, string $documentId): EnvelopeDocument
    {
        $httpRequest = (new DocumentGetRequest($this->requestBuilder))($envelopeId, $documentId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DocumentResponse())($httpResponse);
    }

    public function getDocuments(
        string $envelopeId,
        int $page = 1,
        int $itemsPerPage = 30
    ): EnvelopeDocument\EnvelopeDocumentList {
        $httpRequest = (new DocumentsGetRequest($this->requestBuilder))($envelopeId, $page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DocumentsGetResponse())($httpResponse);
    }

    public function deleteDocument(string $envelopeId, string $documentId): int
    {
        $httpRequest = (new DocumentDeleteRequest($this->requestBuilder))($envelopeId, $documentId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DocumentDeleteResponse())($httpResponse);
    }
}
