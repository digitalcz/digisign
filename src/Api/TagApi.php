<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Request\Recipient\RecipientDeleteRequest;
use DigitalCz\DigiSign\Request\Tag\TagDeleteRequest;
use DigitalCz\DigiSign\Request\Tag\TagGetRequest;
use DigitalCz\DigiSign\Request\Tag\TagPostRequest;
use DigitalCz\DigiSign\Request\Tag\TagPutRequest;
use DigitalCz\DigiSign\Response\Recipient\RecipientDeleteResponse;
use DigitalCz\DigiSign\Response\Tag\TagDeleteResponse;
use DigitalCz\DigiSign\Response\Tag\TagResponse;
use DigitalCz\DigiSign\ValueObject\Request\Tag as RequestTag;
use DigitalCz\DigiSign\ValueObject\Response\Tag as ResponseTag;

class TagApi extends BaseApi
{
    public function createTag(RequestTag $object): ResponseTag
    {
        $httpRequest = (new TagPostRequest($this->httpRequestFactory, $this->httpStreamFactory))($object);
        $httpResponse = $this->client->request($httpRequest);

        return (new TagResponse($httpResponse))();
    }

    public function updateTag(string $tagId, RequestTag $object): ResponseTag
    {
        $httpRequest = (new TagPutRequest($this->httpRequestFactory, $this->httpStreamFactory))($tagId, $object);
        $httpResponse = $this->client->request($httpRequest);

        return (new TagResponse($httpResponse))();
    }

    public function getTag(string $tagId): ResponseTag
    {
        $httpRequest = (new TagGetRequest($this->httpRequestFactory, $this->httpStreamFactory))($tagId);
        $httpResponse = $this->client->request($httpRequest);

        return (new TagResponse($httpResponse))();
    }

    public function deleteTag(string $tagId): int
    {
        $httpRequest =
            (new TagDeleteRequest($this->httpRequestFactory, $this->httpStreamFactory))($tagId);
        $httpResponse = $this->client->request($httpRequest);

        return (new TagDeleteResponse($httpResponse))();
    }
}
