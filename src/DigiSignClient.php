<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DateTimeInterface;
use DigitalCz\DigiSign\Exception\BadRequestException;
use DigitalCz\DigiSign\Exception\ClientException;
use DigitalCz\DigiSign\Exception\NotFoundException;
use DigitalCz\DigiSign\Exception\RuntimeException;
use DigitalCz\DigiSign\Exception\ServerException;
use DigitalCz\DigiSign\Resource\ResourceInterface;
use DigitalCz\DigiSign\Stream\FileStream;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use InvalidArgumentException;
use JsonException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

use const JSON_THROW_ON_ERROR;

final class DigiSignClient
{
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private UriFactoryInterface $uriFactory;

    public function __construct(
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
        ?UriFactoryInterface $uriFactory = null
    ) {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
        $this->uriFactory = $uriFactory ?? Psr17FactoryDiscovery::findUriFactory();
    }

    /**
     * @return mixed[]|null
     */
    public static function parseResponse(ResponseInterface $response): ?array
    {
        $body = (string)$response->getBody();

        if ($body === '') {
            if ($response->getStatusCode() === self::HTTP_NO_CONTENT) {
                return null;
            }

            throw new RuntimeException('Empty response body');
        }

        try {
            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException('Unable to parse response', 0, $e);
        }
    }

    /**
     * @param mixed[] $options
     */
    public function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        $psrUri = $this->createUri($uri, $options);
        $request = $this->createRequest($method, $psrUri, $options);
        $response = $this->httpClient->sendRequest($request);

        $this->checkResponse($response);

        return $response;
    }

    /**
     * @param mixed[] $array
     *
     * @throws InvalidArgumentException When the value cannot be json-encoded
     */
    private static function jsonEncode(array $array): string
    {
        try {
            return json_encode($array, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new InvalidArgumentException('Invalid value for "json" option: ' . $e->getMessage());
        }
    }

    /**
     * @param mixed[] $options
     */
    private function createUri(string $uri, array $options): UriInterface
    {
        // replace uri parameters with its values
        preg_match_all('/{(\w+)}/', $uri, $matches);
        $searches = $matches[1] ?? [];
        $replaces = [];

        foreach ($searches as $search) {
            if (!isset($options[$search])) {
                throw new RuntimeException(sprintf('Cannot resolve uri parameter %s', $search));
            }

            $replaces[] = (string)$options[$search];
        }

        $searches = array_map(static fn (string $search) => sprintf("{%s}", $search), $searches);

        $uri = str_replace($searches, $replaces, $uri);

        // create PSR Uri
        $psrUri = $this->uriFactory->createUri($uri);

        if (isset($options['query'])) {
            $psrUri = $psrUri->withQuery(http_build_query($options['query']));
        }

        return $psrUri;
    }

    /**
     * @param mixed[] $options
     */
    private function createRequest(string $method, UriInterface $uri, array $options): RequestInterface
    {
        $request = $this->requestFactory->createRequest($method, $uri);
        $headers = $options['headers'] ?? [];

        if (!is_array($headers)) {
            throw new InvalidArgumentException('Invalid value for "headers" option');
        }

        // default headers
        $headers['Accept'] ??= 'application/json';

        if (isset($options['user-agent'])) {
            $headers['User-Agent'] = (string)$options['user-agent'];
        }

        if (isset($options['auth_basic'])) {
            if (is_array($options['auth_basic'])) {
                $options['auth_basic'] = implode(':', $options['auth_basic']);
            }

            if (!is_string($options['auth_basic'])) {
                throw new InvalidArgumentException('Invalid value for "auth_basic" option');
            }

            $headers['Authorization'] = 'Basic ' . base64_encode($options['auth_basic']);
        }

        if (isset($options['auth_bearer'])) {
            if (!is_string($options['auth_bearer'])) {
                throw new InvalidArgumentException('Invalid value for "auth_bearer" option');
            }

            $headers['Authorization'] = 'Bearer ' . $options['auth_bearer'];
        }

        if (isset($options['multipart'])) {
            if (!is_array($options['multipart'])) {
                throw new InvalidArgumentException('Invalid value for "multipart" option');
            }

            $multipartBuilder = new MultipartStreamBuilder($this->streamFactory);
            foreach ($options['multipart'] as $name => $resource) {
                $resourceOptions = [];

                if ($resource instanceof FileStream) {
                    $resourceOptions['filename'] = $resource->getFilename();
                    $resource = $resource->getHandle();
                }

                $multipartBuilder->addResource($name, $resource, $resourceOptions);
                $headers['Content-Type'] = sprintf(
                    'multipart/form-data; boundary="%s"',
                    $multipartBuilder->getBoundary(),
                );
                $options['body'] = $multipartBuilder->build();
            }
        }

        if (isset($options['json'])) {
            if (!is_array($options['json'])) {
                throw new InvalidArgumentException('Invalid value for "json" option');
            }

            $headers['Content-Type'] = 'application/json';
            $json = self::normalizeJson($options['json']);
            $options['body'] = self::jsonEncode($json);
        }

        if (isset($options['body'])) {
            if (is_resource($options['body'])) {
                $body = $this->streamFactory->createStreamFromResource($options['body']);
            } elseif (is_string($options['body'])) {
                $body = $this->streamFactory->createStream($options['body']);
            } elseif ($options['body'] instanceof StreamInterface) {
                $body = $options['body'];
            } else {
                throw new InvalidArgumentException('Invalid value for "body" option');
            }

            $request = $request->withBody($body);
        }

        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }

    private function checkResponse(ResponseInterface $response): void
    {
        $code = $response->getStatusCode();

        if ($code >= self::HTTP_INTERNAL_SERVER_ERROR) {
            throw new ServerException($response);
        }

        if ($code >= self::HTTP_BAD_REQUEST) {
            if ($code === self::HTTP_BAD_REQUEST) {
                throw new BadRequestException($response);
            }

            if ($code === self::HTTP_NOT_FOUND) {
                throw new NotFoundException($response);
            }

            throw new ClientException($response);
        }
    }

    /**
     * @param mixed[] $json
     * @return mixed[]
     */
    protected static function normalizeJson(array $json): array
    {
        $normalize = static function ($value) {
            if (is_array($value)) {
                return self::normalizeJson($value);
            }

            if ($value instanceof DateTimeInterface) {
                return $value->format(DateTimeInterface::ATOM);
            }

            if ($value instanceof ResourceInterface) {
                return $value->self();
            }

            return $value;
        };

        return array_map($normalize, $json);
    }
}
