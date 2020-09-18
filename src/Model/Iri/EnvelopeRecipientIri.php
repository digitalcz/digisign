<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

class EnvelopeRecipientIri extends Iri
{
    public const TEMPLATE = EnvelopeIri::TEMPLATE . '/recipients/{recipient}';

    public function __construct(string $envelope, string $recipient)
    {
        parent::__construct(new IriTemplate(self::TEMPLATE), compact('envelope', 'recipient'));
    }

    public static function parse(string $iri): self
    {
        $template = new IriTemplate(self::TEMPLATE);
        ['envelope' => $envelope, 'recipient' => $recipient] = $template->extract($iri);

        return new self($envelope, $recipient);
    }
}
