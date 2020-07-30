<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Account;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class AccountGetRequest
{

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    public function __invoke(): RequestInterface
    {
        return $this->requestFactory->createRequest('GET', 'https://digisign.digital.cz/api/account')
            ->withHeader('Content-Type', 'application/json');
    }
}
