<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Tag;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\TagData;
use Psr\Http\Message\RequestInterface;

class TagPutRequest extends BaseHttpRequest
{

    public const URI = '/api/tags/%s';

    public function __invoke(string $tagId, TagData $tagData): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $tagId))
            ->withBody(
                $this->createRequestJsonBody($tagData->toArray())
            );
    }
}
