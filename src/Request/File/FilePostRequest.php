<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\File;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Stream;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class FilePostRequest extends BaseHttpRequest
{
    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;
    /**
     * @var Stream
     */
    private $stream;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Stream $stream
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->stream = $stream;
    }

    public function __invoke(): RequestInterface
    {
        $builder = new MultipartStreamBuilder($this->streamFactory);
        $builder->addResource(
            'file',
            $this->stream->getHandle()
        );

        return $this->requestFactory->createRequest('POST', 'https://digisign.digital.cz/api/files')
            ->withHeader(
                'Content-Type',
                'multipart/form-data; boundary="' . $builder->getBoundary() . '"'
            )->withBody($builder->build());
    }
}
