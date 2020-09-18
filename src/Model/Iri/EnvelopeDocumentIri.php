<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

class EnvelopeDocumentIri extends Iri
{
    public const TEMPLATE = EnvelopeIri::TEMPLATE . '/documents/{document}';

    public function __construct(string $envelope, string $document)
    {
        parent::__construct(new IriTemplate(self::TEMPLATE), compact('envelope', 'document'));
    }

    public static function parse(string $iri): self
    {
        $template = new IriTemplate(self::TEMPLATE);
        ['envelope' => $envelope, 'document' => $document] = $template->extract($iri);

        return new self($envelope, $document);
    }
}
