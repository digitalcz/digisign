<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\DigiSignClient;
use DigitalCz\DigiSign\Exception\RuntimeException;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Resource\Collection
 */
final class CollectionTest extends TestCase
{
    public function testGetResponseNotFromApi(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $collection = new Collection($parsedResponse, DummyResource::class);
        $this->expectException(RuntimeException::class);
        $collection->getResponse();
    }

    public function testGetResponseFromApi(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $collection = new Collection($parsedResponse, DummyResource::class);
        $collection->setResponse($expectedResponse);

        self::assertSame($expectedResponse, $collection->getResponse());
    }

    public function testGetResult(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $dr0 = new DummyResource(DummyResource::EXAMPLE); // phpcs:ignore
        $dr1 = new DummyResource(DummyResource::EXAMPLE); // phpcs:ignore
        $dr2 = new DummyResource(DummyResource::EXAMPLE); // phpcs:ignore

        $collection = new Collection($parsedResponse, DummyResource::class);
        $collectionResults = $collection->getResult();

        for ($i = 0; $i < 3; $i++) {
            /* @phpstan-ignore-next-line */
            self::assertSame($collectionResults[$i]->toArray(), ${'dr' . $i}->toArray());
        }
    }

    public function testToArray(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $collection = new Collection($parsedResponse, DummyResource::class);

        self::assertSame(DummyResource::COLLECTION_EXAMPLE, $collection->toArray());
    }

    public function testJsonSerialize(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $collection = new Collection($parsedResponse, DummyResource::class);

        self::assertSame(DummyResource::COLLECTION_EXAMPLE, $collection->jsonSerialize());
    }

    public function testGetSelf(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $collection = new Collection($parsedResponse, DummyResource::class);
        $this->expectException(RuntimeException::class);
        $collection->self();
    }

    public function testId(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $collection = new Collection($parsedResponse, DummyResource::class);
        $this->expectException(RuntimeException::class);
        $collection->id();
    }

    public function testGetResourceClass(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parsedResponse = DigiSignClient::parseResponse($expectedResponse);
        self::assertNotNull($parsedResponse);

        $collection = new Collection($parsedResponse, DummyResource::class);
        self::assertSame(DummyResource::class, $collection->getResourceClass());
    }
}
