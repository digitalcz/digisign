<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Delivery;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\Delivery\DeliveriesGetRequest;
use DigitalCz\DigiSign\Http\Request\Delivery\DeliveryCancelPostRequest;
use DigitalCz\DigiSign\Http\Request\Delivery\DeliveryGetRequest;
use DigitalCz\DigiSign\Http\Request\Delivery\DeliveryPostRequest;
use DigitalCz\DigiSign\Http\Request\Delivery\DeliveryPutRequest;
use DigitalCz\DigiSign\Http\Request\Delivery\DeliverySendPostRequest;
use DigitalCz\DigiSign\Http\Response\Delivery\DeliveriesGetResponse;
use DigitalCz\DigiSign\Http\Response\Delivery\DeliveryResponse;
use DigitalCz\DigiSign\Http\Response\Delivery\DeliverySendPostResponse;
use DigitalCz\DigiSign\Http\Response\Delivery\DeliveryCancelPostResponse;
use DigitalCz\DigiSign\Model\DTO\DeliveryData;
use DigitalCz\DigiSign\Model\ValueObject\Delivery;

class DeliveryApi extends BaseApi
{
    public function createDelivery(DeliveryData $deliveryData): Delivery
    {
        $httpRequest = (new DeliveryPostRequest($this->requestBuilder))($deliveryData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryResponse())($httpResponse);
    }

    public function updateDelivery(string $deliveryId, DeliveryData $deliveryData): Delivery
    {
        $httpRequest = (new DeliveryPutRequest($this->requestBuilder))($deliveryId, $deliveryData);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryResponse())($httpResponse);
    }

    public function getDelivery(string $deliveryId): Delivery
    {
        $httpRequest = (new DeliveryGetRequest($this->requestBuilder))($deliveryId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryResponse())($httpResponse);
    }

    public function getDeliveries(int $page = 1, int $itemsPerPage = 30): Delivery\DeliveryList
    {
        $httpRequest = (new DeliveriesGetRequest($this->requestBuilder))($page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveriesGetResponse())($httpResponse);
    }

    public function cancelDelivery(string $deliveryId): int
    {
        $httpRequest = (new DeliveryCancelPostRequest($this->requestBuilder))($deliveryId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliveryCancelPostResponse())($httpResponse);
    }

    public function sendDelivery(string $deliveryId): int
    {
        $httpRequest = (new DeliverySendPostRequest($this->requestBuilder))($deliveryId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new DeliverySendPostResponse())($httpResponse);
    }
}
