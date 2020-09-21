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
        yield [
            '/api/envelopes/{envelope}',
            ['envelope' => '3ab797be-5bc4-4210-8d1d-9be967f6350f'],
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f'
        ];
        yield ['/api/envelopes', ['envelope' => '3ab797be-5bc4-4210-8d1d-9be967f6350f'], '/api/envelopes'];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            ['envelope' => '3ab797be-5bc4-4210-8d1d-9be967f6350f', 'tag' => '59311a2f-17d9-4485-867c-971e7c2bf5a7'],
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/tags/59311a2f-17d9-4485-867c-971e7c2bf5a7'
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
        yield ['/api/envelopes/{envelope}', '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f', true];
        yield ['/api/envelopes/{envelope}', '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/foo', false];
        yield ['/api/envelopes/{envelope}', '/api/envelopes', false];
        yield ['/api/envelopes/{envelope}', '/api/envelopes/', false];
        yield ['/api/envelopes/{envelope}', '/api', false];
        yield ['/api/envelopes', '/api/envelopes', true];
        yield ['/api/envelopes', '/api/envelopes/foo', false];
        yield ['/api/envelopes', '/api', false];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/tags/59311a2f-17d9-4485-867c-971e7c2bf5a7',
            true
        ];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/tags/59311a2f-17d9-4485-867c-971e7c2bf5a7/foo',
            false
        ];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/tags/59311a2f-17d9-4485-867c-971e7c2bf5a7/',
            false
        ];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/tags',
            false
        ];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/tags/',
            false
        ];
        yield ['/api/envelopes/{envelope}/tags/{tag}', '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f', false];
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
        yield [
            '/api/envelopes/{envelope}',
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f',
            ['envelope' => '3ab797be-5bc4-4210-8d1d-9be967f6350f']
        ];
        yield [
            '/api/envelopes/{envelope}/tags/{tag}',
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/tags/59311a2f-17d9-4485-867c-971e7c2bf5a7',
            ['envelope' => '3ab797be-5bc4-4210-8d1d-9be967f6350f', 'tag' => '59311a2f-17d9-4485-867c-971e7c2bf5a7']
        ];
    }

    public function testExtractNotMatchingIri(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('IRI does not match template');

        $template = new IriTemplate('/api/envelopes/{envelope}/tags/{tag}');
        $template->extract(
            '/api/envelopes/3ab797be-5bc4-4210-8d1d-9be967f6350f/recipients/59311a2f-17d9-4485-867c-971e7c2bf5a7'
        );
    }
}
