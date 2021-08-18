<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Violations extends BaseResource
{
    /** @var string */
    public $title;

    /** @var string */
    public $detail;

    /** @var Collection<Violation> */
    public $violations;

    /** @param mixed[] $result */
    public function __construct(array $result)
    {
        parent::__construct($result);

        $this->violations = $this->violations ?? new Collection([], Violation::class);
    }
}
