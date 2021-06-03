<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTag extends BaseResource
{
    use EntityResourceTrait;

    public ?string $placeholder;
    public ?int $page;
    public ?int $xPosition;
    public ?int $yPosition;
    public string $positioning;
    public bool $required;
    public string $type;
    public EnvelopeDocument $document;
    public EnvelopeRecipient $recipient;

    // InputTag
    /** @var string|bool */
    public $value; // phpcs:ignore
    public ?string $label;
    public bool $readonly;

    // DocumentTag
    public ?string $name;
    public string $layout;
}
