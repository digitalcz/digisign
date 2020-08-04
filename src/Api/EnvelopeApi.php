<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Request\Envelope\EnvelopeCancelPostRequest;
use DigitalCz\DigiSign\Request\Envelope\EnvelopeGetRequest;
use DigitalCz\DigiSign\Request\Envelope\EnvelopePostRequest;
use DigitalCz\DigiSign\Request\Envelope\EnvelopePutRequest;
use DigitalCz\DigiSign\Request\Envelope\EnvelopeSendPostRequest;
use DigitalCz\DigiSign\Request\Envelope\EnvelopesGetRequest;
use DigitalCz\DigiSign\Response\Envelope\EnvelopeCancelPostResponse;
use DigitalCz\DigiSign\Response\Envelope\EnvelopeResponse;
use DigitalCz\DigiSign\Response\Envelope\EnvelopeSendPostResponse;
use DigitalCz\DigiSign\Response\Envelope\EnvelopesGetResponse;
use DigitalCz\DigiSign\ValueObject\Request\Envelope as RequestEnvelope;
use DigitalCz\DigiSign\ValueObject\Response\Envelope as ResponseEnvelope;

class EnvelopeApi extends BaseApi
{
    public function createEnvelope(RequestEnvelope $object): ResponseEnvelope
    {
        $httpRequest = (new EnvelopePostRequest($this->httpRequestFactory, $this->httpStreamFactory, $object))();
        $httpResponse = $this->client->request($httpRequest);

        return (new EnvelopeResponse($httpResponse))();
    }

    public function updateEnvelope(string $envelopeId, RequestEnvelope $object): ResponseEnvelope
    {
        $httpRequest =
            (new EnvelopePutRequest($this->httpRequestFactory, $this->httpStreamFactory, $object, $envelopeId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new EnvelopeResponse($httpResponse))();
    }


    public function getEnvelope(string $envelopeId): ResponseEnvelope
    {
        $httpRequest = (new EnvelopeGetRequest($this->httpRequestFactory, $this->httpStreamFactory, $envelopeId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new EnvelopeResponse($httpResponse))();
    }

    /**
     * @return array<ResponseEnvelope>|ResponseEnvelope[]
     */
    public function getEnvelopes(int $page = 1, int $itemsPerPage = 30): array
    {
        $httpRequest =
            (new EnvelopesGetRequest($this->httpRequestFactory, $this->httpStreamFactory, $page, $itemsPerPage))();
        $httpResponse = $this->client->request($httpRequest);

        return (new EnvelopesGetResponse($httpResponse))();
    }

    public function sendEnvelope(string $envelopeId): int
    {
        $httpRequest =
            (new EnvelopeSendPostRequest($this->httpRequestFactory, $this->httpStreamFactory, $envelopeId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new EnvelopeSendPostResponse($httpResponse))();
    }

    public function cancelEnvelope(string $envelopeId): int
    {
        $httpRequest =
            (new EnvelopeCancelPostRequest($this->httpRequestFactory, $this->httpStreamFactory, $envelopeId))();
        $httpResponse = $this->client->request($httpRequest);

        return (new EnvelopeCancelPostResponse($httpResponse))();
    }
}
