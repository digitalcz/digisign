<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\File;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\Stream;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Psr\Http\Message\RequestInterface;

class FilePostRequest extends BaseHttpRequest
{

    public const URI = '/api/files';

    public function __invoke(Stream $stream): RequestInterface
    {
        $builder = new MultipartStreamBuilder($this->requestBuilder->getStreamFactory());
        $builder->addResource('file', $stream->getHandle());

        return $this->createRequestToken('POST', self::URI)
            ->withHeader(
                'Content-Type',
                'multipart/form-data; boundary="' . $builder->getBoundary() . '"'
            )->withBody($builder->build());
    }
}
