<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\EnvelopeTemplate;
use DigitalCz\DigiSign\Resource\EnvelopeTemplateDocument;
use DigitalCz\DigiSign\Stream\FileResponse;

/**
 * @extends ResourceEndpoint<EnvelopeTemplateDocument>
 * @method EnvelopeTemplateDocument get(string $id)
 * @method EnvelopeTemplateDocument create(array $body)
 * @method EnvelopeTemplateDocument update(string $id, array $body)
 */
final class EnvelopeTemplateDocumentsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeTemplateDocument> */
    use CRUDEndpointTrait;

    public function __construct(EnvelopeTemplatesEndpoint $parent, EnvelopeTemplate|string $template)
    {
        parent::__construct(
            $parent,
            '/{template}/documents',
            EnvelopeTemplateDocument::class,
            ['template' => $template]
        );
    }

    /**
     * @param mixed[] $query
     */
    public function download(string $id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/download', ['id' => $id, 'query' => $query]);
    }

    /**
     * @param mixed[] $body
     */
    public function positions(array $body): void
    {
        $this->putRequest('/positions', ['json' => $body]);
    }

    /**
     * @param mixed[] $body
     */
    public function replaceFile(EnvelopeTemplateDocument|string $document, array $body): EnvelopeTemplateDocument
    {
        return $this->makeResource(
            $this->postRequest('/{document}/replace-file', ['document' => $document, 'json' => $body])
        );
    }
}
