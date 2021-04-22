<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use InvalidArgumentException;
use LogicException;

abstract class ResourceIri extends Iri
{
    public const TEMPLATE = '';

    final protected function __construct(array $params = [])
    {
        parent::__construct(self::getTemplate(), $params);
    }

    public static function getTemplate(): IriTemplate
    {
        if (static::TEMPLATE === '') {
            throw new LogicException('Define const TEMPLATE when extending ResourceIri');
        }

        return new IriTemplate(static::TEMPLATE);
    }

    /**
     * @param string ...$args
     * @return static
     */
    public static function create(string ...$args): self
    {
        $template = static::getTemplate();
        $placeholders = $template->getPlaceholders();

        if (count($args) !== count($placeholders)) {
            throw new InvalidArgumentException('Invalid number of arguments');
        }

        $params = array_combine(array_keys($placeholders), $args);

        if ($params === false) { // @phpstan-ignore-line
            throw new InvalidArgumentException('Failed to combine arguments');
        }

        return new static($params);
    }

    /**
     * @return static
     */
    public static function parse(string $iri): self
    {
        $template = static::getTemplate();
        $params = $template->extract($iri);

        return new static($params);
    }
}
