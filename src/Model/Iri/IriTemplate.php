<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use InvalidArgumentException;

/**
 * Object representing IRI template, it provides expanding and extracting of path params
 */
class IriTemplate
{
    /**
     * @var string IRI template path eg: "/api/envelopes/{envelope}/tags/{tag}"
     */
    private $template;

    /**
     * @var string Regex of IRI template eg: "~^/api/envelopes/(?<envelope>\w+)/tags/(?<tag>\w+)$~"
     */
    private $templateRegex;

    /**
     * @var string[] Placeholders parsed from $template, key is name, value is placeholder
     */
    private $placeholders;

    /**
     * @param string $template IRI template path eg: "/api/envelopes/{envelope}/tags/{tag}"
     */
    public function __construct(string $template)
    {
        preg_match_all('~{([a-z0-9-]+)}~', $template, $matches);
        $placeholders = array_combine($matches[1] ?? [], $matches[0] ?? []);

        if ($placeholders === false) {
            throw new InvalidArgumentException(sprintf("Unable to parse IRI template '%s'", $template));
        }

        $this->template = $template;
        $this->placeholders = $placeholders;
        $this->templateRegex = $this->prepareTemplateRegex($template);
    }

    /**
     * Prepares templateRegex from template
     *
     * @param string $template
     * @return string
     */
    private function prepareTemplateRegex(string $template): string
    {
        $replaces = array_map(
            static function (string $param) {
                return "(?<{$param}>[a-z0-9-]+)";
            },
            array_keys($this->placeholders)
        );

        $regex = str_replace($this->placeholders, $replaces, $template);

        return "~^$regex$~";
    }

    /**
     * Expands provided parameters into template returning IRI
     *
     * @param array<string, string> $params Name-Value array of values to be expanded into IRI template
     * @return string Resulting IRI path
     * @throws InvalidArgumentException If params do not contain all needed values
     */
    public function expand(array $params): string
    {
        foreach ($this->placeholders as $name => $placeholder) {
            if (!isset($params[$name])) {
                throw new InvalidArgumentException(sprintf("Unable to expand IRI placeholder '%s'", $placeholder));
            }
        }

        return str_replace($this->placeholders, $params, $this->template);
    }

    /**
     * Extract parameters from IRI
     *
     * @param string $iri
     * @return array<string, string>
     * @throws InvalidArgumentException If IRI provided does not match template
     */
    public function extract(string $iri): array
    {
        if (!$this->match($iri)) {
            throw new InvalidArgumentException('IRI does not match template');
        }

        preg_match($this->templateRegex, $iri, $matches);

        return array_intersect_key($matches, $this->placeholders);
    }

    /**
     * Checks whether provided IRI matches the Template
     *
     * @param string $iri The IRI to be checked
     * @return bool Whether the IRI matches template or not
     */
    public function match(string $iri): bool
    {
        return preg_match($this->templateRegex, $iri) === 1;
    }

    /**
     * Returns placeholders parsed from $template, key is name, value is placeholder
     *
     * @return array<string, string>
     */
    public function getPlaceholders(): array
    {
        return $this->placeholders;
    }
}
