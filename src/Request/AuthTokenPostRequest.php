<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request;

use DigitalCz\DigiSign\ValueObject\Credentials;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class AuthTokenPostRequest extends BaseHttpRequest
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
     * @var Credentials
     */
    private $credentials;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Credentials $credentials
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->credentials = $credentials;
    }

    public function __invoke(): RequestInterface
    {
        return $this->requestFactory->createRequest('POST', 'https://digisign.digital.cz/api/auth-token')
            ->withBody($this->streamFactory->createStream($this->encodeJsonBody($this->credentials->toArray())))
            ->withHeader('Content-Type', 'application/json');
    }
}
