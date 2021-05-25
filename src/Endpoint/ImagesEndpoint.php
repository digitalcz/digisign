<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Image;
use DigitalCz\DigiSign\Stream\FileResponse;
use DigitalCz\DigiSign\Stream\FileStream;

/**
 * @extends ResourceEndpoint<Image>
 * @method Image get(string $id)
 */
class ImagesEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<Image> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/images', Image::class);
    }

    public function upload(FileStream $image, bool $public = false): Image
    {
        $multipart = ['image' => $image, 'public' => ($public ? 'true' : 'false')];

        return $this->makeResource($this->postRequest('', ['multipart' => $multipart]));
    }

    public function content(string $id): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/content', ['id' => $id]);
    }
}
