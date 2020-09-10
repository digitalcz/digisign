<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Envelope;

use DigitalCz\DigiSign\Exception\RuntimeException;
use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\Stream;
use DigitalCz\DigiSign\Model\ValueObject\Envelope\EnvelopeFile;
use Psr\Http\Message\ResponseInterface;

class EnvelopeDownloadGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeFile
    {
        $this->handleResponseCode($response);

        $contentDisposition = $response->getHeaderLine('content-disposition');
        $contentLength = $response->getHeaderLine('content-length');
        $contentType = $response->getHeaderLine('content-type');

        $resource = $response->getBody()->detach();

        if ($resource === null) {
            throw new RuntimeException('Response body is not valid resource.');
        }

        $stream = Stream::fromHandle($resource);

        return new EnvelopeFile($contentDisposition, $contentType, (int)$contentLength, $stream);
    }
}
