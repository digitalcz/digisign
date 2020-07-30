<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request;

use DigitalCz\DigiSign\Exception\RuntimeException;

abstract class BaseHttpRequest
{

    /**
     * @param array<mixed> $data
     */
    protected function encodeJsonBody(array $data): string
    {
        $content = json_encode($data);

        if ($content === false) {
            throw new RuntimeException('Json encoding failure');
        }

        return $content;
    }

    /**
     * @param array<mixed> $data
     */
    protected function encodeHttpBody(array $data): string
    {
        return http_build_query($data);
    }
}
