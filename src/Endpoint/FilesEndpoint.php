<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\File;
use DigitalCz\DigiSign\Stream;
use DigitalCz\DigiSign\StreamResponse;

/**
 * @extends ResourceEndpoint<File>
 * @method File get(string $id)
 */
final class FilesEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    use ListEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/files', File::class);
    }

    public function upload(Stream $file): File
    {
        return $this->createResource(
            $this->postRequest('', ['multipart' => ['file' => $file]]),
            $this->getResourceClass(),
        );
    }

    public function content(string $id): StreamResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/content', ['id' => $id]);
    }
}
