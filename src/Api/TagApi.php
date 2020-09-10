<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\Request\Tag\TagDeleteRequest;
use DigitalCz\DigiSign\Http\Request\Tag\TagGetRequest;
use DigitalCz\DigiSign\Http\Request\Tag\TagPostRequest;
use DigitalCz\DigiSign\Http\Request\Tag\TagPutRequest;
use DigitalCz\DigiSign\Http\Response\Tag\TagDeleteResponse;
use DigitalCz\DigiSign\Http\Response\Tag\TagResponse;
use DigitalCz\DigiSign\Model\DTO\TagData;
use DigitalCz\DigiSign\Model\ValueObject\Tag;

class TagApi extends BaseApi
{
    public function createTag(TagData $object): Tag
    {
        $httpRequest = (new TagPostRequest($this->requestBuilder))($object);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagResponse())($httpResponse);
    }

    public function updateTag(string $tagId, TagData $object): Tag
    {
        $httpRequest = (new TagPutRequest($this->requestBuilder))($tagId, $object);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagResponse())($httpResponse);
    }

    public function getTag(string $tagId): Tag
    {
        $httpRequest = (new TagGetRequest($this->requestBuilder))($tagId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagResponse())($httpResponse);
    }

    public function deleteTag(string $tagId): int
    {
        $httpRequest = (new TagDeleteRequest($this->requestBuilder))($tagId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new TagDeleteResponse())($httpResponse);
    }
}
