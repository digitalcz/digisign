<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use RuntimeException as BaseRuntimeException;
use Throwable;

class RuntimeException extends BaseRuntimeException
{
    /**
     * @var string
     */
    protected $type = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $detail = '';

    /**
     * @var array<mixed>
     */
    protected $violations = [];

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $jsonBody = json_decode($message, true);

        if (is_array($jsonBody)) {
            $this->type = $jsonBody['type'] ?? '';
            $this->title = $jsonBody['title'] ?? '';
            $this->detail = $jsonBody['detail'] ?? '';
            $this->violations = $jsonBody['violations'] ?? [];
        }

        parent::__construct($message, $code, $previous);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @return mixed[]
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
