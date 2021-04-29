<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Resource\Token;

/**
 * @extends ResourceEndpoint<Token>
 */
final class AuthEndpoint extends ResourceEndpoint
{
    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/auth-token', Token::class, ['no_auth' => true]);
    }

    /**
     * @param mixed[] $body
     */
    public function authorize(array $body): Token
    {
        return $this->createResource($this->postRequest('', ['json' => $body]), $this->getResourceClass());
    }
}
