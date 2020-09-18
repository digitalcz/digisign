<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IriTemplateTest extends TestCase
{
    /**
     * @dataProvider provideForTestExpand
     * @param string $template
     * @param array<string, string> $params
     * @param string $expected
     */
    public function testExpand(string $template, array $params, string $expected): void
    {
        $template = new IriTemplate($template);
        self::assertEquals($expected, $template->expand($params));
    }

    /**
     * @return iterable<mixed[]>
     */
    public function provideForTestExpand(): iterable
    {
        yield ['/api/envelopes/{envelope}', ['envelope' => '123'], '/api/envelopes/123'];
        yield ['/api/envelopes', ['envelope' => '123'], '/api/envelopes'];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            ['envelope' => '123', 'tag' => '456'],
            '/api/envelopes/123/tags/456'
        ];
    }

    /**
     * @dataProvider provideForTestMatch
     */
    public function testMatch(string $template, string $iri, bool $expected): void
    {
        $template = new IriTemplate($template);
        self::assertSame($expected, $template->match($iri));
    }

    /**
     * @return iterable<mixed[]>
     */
    public function provideForTestMatch(): iterable
    {
        yield ['/api/envelopes/{envelope}', '/api/envelopes/123', true];
        yield ['/api/envelopes/{envelope}', '/api/envelopes/123/foo', false];
        yield ['/api/envelopes/{envelope}', '/api/envelopes', false];
        yield ['/api/envelopes/{envelope}', '/api/envelopes/', false];
        yield ['/api/envelopes/{envelope}', '/api', false];
        yield ['/api/envelopes', '/api/envelopes', true];
        yield ['/api/envelopes', '/api/envelopes/foo', false];
        yield ['/api/envelopes', '/api', false];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes/123/tags/456', true];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes/123/tags/456/foo', false];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes/123/tags/456/', false];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes/123/tags', false];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes/123/tags/', false];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes/123', false];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes', false];
    }

    /**
     * @dataProvider provideForTestExtract
     * @param string $template
     * @param string $iri
     * @param array<string, string> $expected
     */
    public function testExtract(string $template, string $iri, array $expected): void
    {
        $template = new IriTemplate($template);
        self::assertSame($expected, $template->extract($iri));
    }

    /**
     * @return iterable<mixed[]>
     */
    public function provideForTestExtract(): iterable
    {
        yield ['/api/envelopes', '/api/envelopes', []];
        yield ['/api/envelopes/{envelope}', '/api/envelopes/123', ['envelope' => '123']];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            '/api/envelopes/123/tags/456',
            ['envelope' => '123', 'tag' => '456']
        ];
    }

    public function testExtractNotMatchingIri(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('IRI does not match template');

        $template = new IriTemplate('/api/envelopes/{envelope}/tags/{tag}');
        $template->extract('/api/envelopes/123/recipients/456');
    }
}
