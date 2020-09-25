<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use InvalidArgumentException;

/**
 * Class that represents IRI
 */
class Iri
{
    /**
     * @var IriTemplate
     */
    private $template;

    /**
     * @var string[]
     */
    private $params;

    /**
     * @param IriTemplate $template Template or IRI path
     * @param string[] $params Path parameters for IRI, these will be used to replace placeholders in Path
     */
    public function __construct(IriTemplate $template, array $params = [])
    {
        $this->template = $template;
        $this->params = $params;
    }

    public function __toString(): string
    {
        try {
            return $this->toString();
        } catch (InvalidArgumentException $e) {
            return '';
        }
    }

    /**
     * Return string representation of IRI
     *
     * @return string Expanded IRI
     */
    public function toString(): string
    {
        return $this->template->expand($this->params);
    }

    /**
     * Return params of IRI
     *
     * @return array<string, string>
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
