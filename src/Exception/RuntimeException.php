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
    protected $type;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $detail;

    /**
     * @var array
     */
    protected $violations = [];

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $decodedMessage = json_decode($message, true);
        $this->type = $decodedMessage['type'];
        $this->title = $decodedMessage['title'];
        $this->detail = $decodedMessage['detail'];

        if ($decodedMessage['violations']) {
            $this->violations = $decodedMessage['violations'];
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

    public function getViolations(): array
    {
        return $this->violations;
    }
}
