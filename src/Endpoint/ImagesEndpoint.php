<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Image;
use DigitalCz\DigiSign\Stream;
use DigitalCz\DigiSign\StreamResponse;

/**
 * @extends ResourceEndpoint<Image>
 * @method Image get(string $id)
 */
class ImagesEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    use ListEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/images', Image::class);
    }

    public function upload(Stream $image, bool $public): Image
    {
        return $this->createResource(
            $this->postRequest('', ['multipart' => ['images' => $image, 'public' => $public]]),
            $this->getResourceClass(),
        );
    }

    public function content(string $id): StreamResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/content', ['id' => $id]);
    }
}
