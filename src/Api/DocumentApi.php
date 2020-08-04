<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Request\Document\DocumentDeleteRequest;
use DigitalCz\DigiSign\Request\Document\DocumentGetRequest;
use DigitalCz\DigiSign\Request\Document\DocumentPostRequest;
use DigitalCz\DigiSign\Request\Document\DocumentPutRequest;
use DigitalCz\DigiSign\Request\Document\DocumentsGetRequest;
use DigitalCz\DigiSign\Response\Document\DocumentDeleteResponse;
use DigitalCz\DigiSign\Response\Document\DocumentResponse;
use DigitalCz\DigiSign\Response\Document\DocumentsGetResponse;
use DigitalCz\DigiSign\ValueObject\Request\Document as RequestDocument;
use DigitalCz\DigiSign\ValueObject\Response\Document as ResponseDocument;

class DocumentApi extends BaseApi
{
    public function createDocument(RequestDocument $document): ResponseDocument
    {
        $httpRequest = (new DocumentPostRequest($this->httpRequestFactory, $this->httpStreamFactory, $document))();
        $httpResponse = $this->client->request($httpRequest);

        return (new DocumentResponse($httpResponse))();
    }

    public function updateDocument(string $documentId, RequestDocument $document): ResponseDocument
    {
        $httpRequest =
            (new DocumentPutRequest($this->httpRequestFactory, $this->httpStreamFactory, $document, $documentId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new DocumentResponse($httpResponse))();
    }

    public function getDocument(string $documentId): ResponseDocument
    {
        $httpRequest = (new DocumentGetRequest($this->httpRequestFactory, $this->httpStreamFactory, $documentId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new DocumentResponse($httpResponse))();
    }

    public function deleteDocument(string $documentId): int
    {
        $httpRequest = (new DocumentDeleteRequest($this->httpRequestFactory, $this->httpStreamFactory, $documentId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new DocumentDeleteResponse($httpResponse))();
    }

    /**
     * @return array<ResponseDocument>|ResponseDocument[]
     */
    public function getDocuments(int $page = 1, int $itemsPerPage = 30): array
    {
        $httpRequest =
            (new DocumentsGetRequest($this->httpRequestFactory, $this->httpStreamFactory, $page, $itemsPerPage))();
        $httpResponse = $this->client->request($httpRequest);

        return (new DocumentsGetResponse($httpResponse))();
    }
}
