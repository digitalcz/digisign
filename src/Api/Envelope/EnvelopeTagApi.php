<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\EnvelopeTag\TagDeleteRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeTag\TagGetRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeTag\TagPostRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeTag\TagPutRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeTag\TagsGetRequest;
use DigitalCz\DigiSign\Http\Response\EnvelopeTag\TagDeleteResponse;
use DigitalCz\DigiSign\Http\Response\EnvelopeTag\TagResponse;
use DigitalCz\DigiSign\Http\Response\EnvelopeTag\TagsGetResponse;
use DigitalCz\DigiSign\Model\DTO\EnvelopeTagData;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeTag;

class EnvelopeTagApi extends BaseApi
{
    public function createTag(string $envelopeId, EnvelopeTagData $object): EnvelopeTag
    {
        $httpRequest = (new TagPostRequest($this->requestBuilder))($envelopeId, $object);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagResponse())($httpResponse);
    }

    public function updateTag(string $envelopeId, string $tagId, EnvelopeTagData $object): EnvelopeTag
    {
        $httpRequest = (new TagPutRequest($this->requestBuilder))($envelopeId, $tagId, $object);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagResponse())($httpResponse);
    }

    public function getTag(string $envelopeId, string $tagId): EnvelopeTag
    {
        $httpRequest = (new TagGetRequest($this->requestBuilder))($envelopeId, $tagId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagResponse())($httpResponse);
    }

    public function getTags(string $envelopeId, int $page = 1, int $itemsPerPage = 30): EnvelopeTag\EnvelopeTagList
    {
        $httpRequest = (new TagsGetRequest($this->requestBuilder))($envelopeId, $page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagsGetResponse())($httpResponse);
    }

    public function deleteTag(string $envelopeId, string $tagId): int
    {
        $httpRequest = (new TagDeleteRequest($this->requestBuilder))($envelopeId, $tagId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagDeleteResponse())($httpResponse);
    }
}
