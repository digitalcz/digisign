<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Tag;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\TagData;
use Psr\Http\Message\RequestInterface;

class TagPostRequest extends BaseHttpRequest
{

    public const URI = '/api/tags';

    public function __invoke(TagData $tagData): RequestInterface
    {
        return $this->createRequestToken('POST', self::URI)
            ->withBody($this->createRequestJsonBody($tagData->toArray()));
    }
}
