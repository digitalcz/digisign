<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopeCancelPostRequest;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopeDonwloadGetRequest;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopeEmbedPostRequest;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopeGetRequest;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopePostRequest;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopePutRequest;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopeSendPostRequest;
use DigitalCz\DigiSign\Http\Request\Envelope\EnvelopesGetRequest;
use DigitalCz\DigiSign\Http\Response\Envelope\EnvelopeCancelPostResponse;
use DigitalCz\DigiSign\Http\Response\Envelope\EnvelopeDownloadGetResponse;
use DigitalCz\DigiSign\Http\Response\Envelope\EnvelopeEmbedPostResponse;
use DigitalCz\DigiSign\Http\Response\Envelope\EnvelopeResponse;
use DigitalCz\DigiSign\Http\Response\Envelope\EnvelopeSendPostResponse;
use DigitalCz\DigiSign\Http\Response\Envelope\EnvelopesGetResponse;
use DigitalCz\DigiSign\Model\DTO\EnvelopeData;
use DigitalCz\DigiSign\Model\ValueObject\Envelope;
use DigitalCz\DigiSign\Model\ValueObject\Envelope\EnvelopeEmbed;
use DigitalCz\DigiSign\Model\ValueObject\Envelope\EnvelopeFile;
use DigitalCz\DigiSign\Model\ValueObject\Envelope\EnvelopeList;

class EnvelopeApi extends BaseApi
{
    public function createEnvelope(EnvelopeData $envelopeData): Envelope
    {
        $httpRequest = (new EnvelopePostRequest($this->requestBuilder))($envelopeData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopeResponse())($httpResponse);
    }

    public function updateEnvelope(string $envelopeId, EnvelopeData $envelopeData): Envelope
    {
        $httpRequest = (new EnvelopePutRequest($this->requestBuilder))($envelopeId, $envelopeData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopeResponse())($httpResponse);
    }

    public function getEnvelope(string $envelopeId): Envelope
    {
        $httpRequest = (new EnvelopeGetRequest($this->requestBuilder))($envelopeId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopeResponse())($httpResponse);
    }


    public function getEnvelopes(int $page = 1, int $itemsPerPage = 30): EnvelopeList
    {
        $httpRequest = (new EnvelopesGetRequest($this->requestBuilder))($page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopesGetResponse())($httpResponse);
    }

    public function sendEnvelope(string $envelopeId): int
    {
        $httpRequest = (new EnvelopeSendPostRequest($this->requestBuilder))($envelopeId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopeSendPostResponse())($httpResponse);
    }

    public function cancelEnvelope(string $envelopeId): int
    {
        $httpRequest = (new EnvelopeCancelPostRequest($this->requestBuilder))($envelopeId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopeCancelPostResponse())($httpResponse);
    }

    public function downloadEnvelope(string $envelopeId, ?string $output = null, ?bool $includeLog = null): EnvelopeFile
    {
        $httpRequest = (new EnvelopeDonwloadGetRequest($this->requestBuilder))($envelopeId, $output, $includeLog);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopeDownloadGetResponse())($httpResponse);
    }

    public function embedEnvelope(string $envelopeId): EnvelopeEmbed
    {
        $httpRequest = (new EnvelopeEmbedPostRequest($this->requestBuilder))($envelopeId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new EnvelopeEmbedPostResponse())($httpResponse);
    }
}
