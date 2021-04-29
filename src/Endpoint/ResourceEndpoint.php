<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSignClient;
use DigitalCz\DigiSign\Exception\EmptyResultException;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\ResourceInterface;
use DigitalCz\DigiSign\StreamResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * @template T of ResourceInterface
 */
abstract class ResourceEndpoint implements EndpointInterface
{
    protected EndpointInterface $parent;
    private string $resourcePath;

    /** @var class-string<T> */
    private string $resourceClass;

    /** @var mixed[] */
    private array $resourceOptions;

    /**
     * @param class-string<T> $resourceClass
     * @param mixed[] $resourceOptions
     */
    public function __construct(
        EndpointInterface $parent,
        string $resourcePath,
        string $resourceClass,
        array $resourceOptions = []
    ) {
        $this->parent = $parent;
        $this->resourcePath = $resourcePath;
        $this->resourceClass = $resourceClass;
        $this->resourceOptions = $resourceOptions;
    }

    /**
     * @param mixed[] $options
     */
    public function request(string $method, string $path = '', array $options = []): ResponseInterface
    {
        $path = $this->getResourcePath() . $path;
        $options = array_merge($this->getResourceOptions(), $options);

        return $this->parent->request($method, $path, $options);
    }

    /**
     * @param mixed[] $options
     */
    public function stream(string $method, string $path = '', array $options = []): StreamResponse
    {
        return new StreamResponse($this->request($method, $path, $options));
    }

    /**
     * @return class-string<T>
     */
    protected function getResourceClass(): string
    {
        return $this->resourceClass;
    }

    protected function getResourcePath(): string
    {
        return $this->resourcePath;
    }

    /**
     * @return mixed[]
     */
    protected function getResourceOptions(): array
    {
        return $this->resourceOptions;
    }

    /**
     * @param mixed[] $body
     * @return T&ResourceInterface
     */
    protected function makeCreateRequest(array $body): ResourceInterface
    {
        return $this->createResource($this->postRequest('', ['json' => $body]), $this->getResourceClass());
    }

    /**
     * @param mixed[] $body
     */
    protected function makeUpdateRequest(string $id, array $body): ResourceInterface
    {
        return $this->createResource(
            $this->putRequest('/{id}', ['id' => $id, 'json' => $body]),
            $this->getResourceClass(),
        );
    }

    protected function makeDeleteRequest(string $id): void
    {
        $this->deleteRequest('/{id}', ['id' => $id]);
    }

    protected function makeGetRequest(string $id): ResourceInterface
    {
        return $this->createResource($this->getRequest('/{id}', ['id' => $id]), $this->getResourceClass());
    }

    /**
     * @param mixed[] $query
     */
    protected function makeListRequest(array $query = []): ListResource
    {
        return $this->createListResource($this->getRequest('', ['query' => $query]), $this->getResourceClass());
    }

    /**
     * @param mixed[] $options
     */
    protected function getRequest(string $function = '', array $options = []): ResponseInterface
    {
        return $this->request(self::METHOD_GET, $function, $options);
    }

    /**
     * @param mixed[] $options
     */
    protected function postRequest(string $function = '', array $options = []): ResponseInterface
    {
        return $this->request(self::METHOD_POST, $function, $options);
    }

    /**
     * @param mixed[] $options
     */
    protected function putRequest(string $function = '', array $options = []): ResponseInterface
    {
        return $this->request(self::METHOD_PUT, $function, $options);
    }

    /**
     * @param mixed[] $options
     */
    protected function patchRequest(string $function = '', array $options = []): ResponseInterface
    {
        return $this->request(self::METHOD_PATCH, $function, $options);
    }

    /**
     * @param mixed[] $options
     */
    protected function deleteRequest(string $function = '', array $options = []): ResponseInterface
    {
        return $this->request(self::METHOD_DELETE, $function, $options);
    }

    /**
     * @return mixed[]
     */
    protected function parseResponse(ResponseInterface $response): array
    {
        $result = DigiSignClient::parseResponse($response);

        if ($result === null) {
            throw new EmptyResultException();
        }

        return $result;
    }

    /**
     * @param class-string<U> $resourceClass
     * @return U
     * @template U of ResourceInterface
     */
    protected function createResource(
        ResponseInterface $response,
        string $resourceClass = BaseResource::class
    ): ResourceInterface {
        return new $resourceClass($this->parseResponse($response));
    }

    protected function createListResource(
        ResponseInterface $response,
        string $resourceClass = BaseResource::class
    ): ListResource {
        return new ListResource($this->parseResponse($response), $resourceClass);
    }
}
