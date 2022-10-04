<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTag extends BaseResource
{
    use EntityResourceTrait;

    /** @var string|null */
    public $placeholder;

    /** @var int|null */
    public $page;

    /** @var int|null */
    public $xPosition;

    /** @var int|null */
    public $yPosition;

    /** @var string */
    public $positioning;

    /** @var bool */
    public $required;

    /** @var string */
    public $type;

    /** @var EnvelopeDocument */
    public $document;

    /** @var EnvelopeRecipient|null */
    public $recipient;

    /** @var string|bool */
    public $value; // phpcs:ignore

    /** @var string|null */
    public $label;

    /** @var bool */
    public $readonly;

    /** @var string|null */
    public $name;

    /** @var string */
    public $layout;

    /** @var int|null */
    public $width;

    /** @var int|null */
    public $height;

    /** @var int */
    public $scale;

    /** @var string|null */
    public $bankIdClaim;

    /** @var string|null */
    public $recipientClaim;

    /** @var bool */
    public $fromTemplate;

    /** @var string */
    public $group;

    /** @var string */
    public $choice;

    /** @var string */
    public $assignment;

    /** @var bool */
    public $renderInteractive;
}
