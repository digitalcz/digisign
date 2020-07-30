<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request;

interface HttpRequestInterface
{

    public function getMethod(): string;

    public function getUri(): string;

    public function getBody(array $data = []): array;

    public function getContentType(): string;
}