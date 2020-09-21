<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApiTestCase;
use DigitalCz\DigiSign\Model\DTO\EnvelopeTagData;
use Psr\Http\Message\ResponseInterface;

class EnvelopeTagApiTest extends BaseApiTestCase
{
    public function testDeleteTag(): void
    {
        $httpClient = $this->httpClient;

//        //auth token get response
//        $httpResponse = $this->createMock(ResponseInterface::class);
//        $httpResponse
//            ->method('getStatusCode')
//            ->willReturn(200);
//        $httpResponse
//            ->method('getBody')
//            ->willReturn(file_get_contents(__DIR__ . '/../../Dummy/Responses/auth_token.json'));
//
//        $httpClient->addResponse($httpResponse);

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(204);
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeTagApi($this->httpClient, $this->requestBuilder);

        $deleteCode = $api->deleteTag('1', '1');

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals(204, $deleteCode);
    }

    public function testCreateTag(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_tag.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeTagApi($this->httpClient, $this->requestBuilder);

        $tag = $api->createTag('0211f410-268a-4ac3-ac40-b41ee7647092', new EnvelopeTagData(
            'signature',
            '/api/envelopes/85c412fc-ee02-4220-ac79-8b0a721ceb88/recipients/78bd8c9b-6e36-44f7-a103-41c963cf3f03',
            '/api/envelopes/819c8aa2-3871-4a0d-950f-2b45d2c6f8fc/documents/3fbf6b5d-ea56-49fd-bf6b-0107d32bf4d7',
            1,
            1,
            1
        ));

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals('1dae4051-8ea7-4267-b12d-566a3e767d2a', $tag->getId());
    }

    public function testUpdateTag(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_tag.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeTagApi($this->httpClient, $this->requestBuilder);

        $tag = $api->updateTag(
            '0211f410-268a-4ac3-ac40-b41ee7647092',
            '0211f410-268a-4ac3-ac40-b41ee7647092',
            new EnvelopeTagData(
                'signature',
                '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/recipients/0b635f61-245a-4e67-a3c0-af73e63d81dc',
                '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/documents/71b06fec-60e5-4f4c-9ead-09aa8992da4b',
                1,
                1,
                1
            )
        );

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals('1dae4051-8ea7-4267-b12d-566a3e767d2a', $tag->getId());
    }

    public function testGetTag(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_tag.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeTagApi($this->httpClient, $this->requestBuilder);

        $tag = $api->getTag(
            '0211f410-268a-4ac3-ac40-b41ee7647092',
            '0211f410-268a-4ac3-ac40-b41ee7647092'
        );

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals('1dae4051-8ea7-4267-b12d-566a3e767d2a', $tag->getId());
    }

    public function testGetTags(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_tags.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeTagApi($this->httpClient, $this->requestBuilder);

        $tagList = $api->getTags(
            '0211f410-268a-4ac3-ac40-b41ee7647092'
        );

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals(1, $tagList->getPage());
        self::assertEquals(3, $tagList->getCount());
        self::assertEquals(30, $tagList->getItemsPerPage());
        self::assertEquals(3, count($tagList->getItems()));
    }
}
