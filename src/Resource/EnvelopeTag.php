<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTag extends BaseResource
{
    use EntityResourceTrait;

    public ?string $placeholder = null;

    public ?int $page = null;

    public ?int $xPosition = null;

    public ?int $yPosition = null;

    public string $positioning;

    public bool $required;

    public string $type;

    public EnvelopeDocument $document;

    public ?EnvelopeRecipient $recipient = null;

    /** @var string|bool */
    public $value; // phpcs:ignore

    public ?string $label = null;

    public bool $readonly;

    public ?string $name = null;

    public string $layout;

    public ?int $width = null;

    public ?int $height = null;

    public int $scale;

    public ?string $bankIdClaim = null;

    public ?string $recipientClaim = null;

    public bool $fromTemplate;

    public string $group;

    public string $choice;

    public string $assignment;

    public bool $renderInteractive;

    public ?string $format;

    public ?DateTime $dateOfSignature;
}
