# AGENTS.md

Instructions for AI coding agents (Claude Code, Codex, Cursor, Copilot, ...) working in this repository.
This file is the single source of truth. Tool-specific files (e.g. `CLAUDE.md`) only point here.

## What this is

`digitalcz/digisign` – PHP SDK for the DigiSign API (https://api.digisign.org, docs: https://api.digisign.org/api/docs).
Built on PSR-18 (HTTP client), PSR-17 (HTTP factories) and PSR-16 (simple cache). Public library published on Packagist; follow SemVer.

- PHP `^8.0`, `declare(strict_types=1)` everywhere. CI matrix: PHP 8.1, 8.2, 8.3 with `prefer-lowest` and `prefer-stable`.
- Default branch: `2.x`. Legacy branches `1.x`, `0.x` – do not touch unless asked.
- Namespace `DigitalCz\DigiSign\` maps to `src/` (and `tests/` for tests).

## Commands

```bash
composer install          # deps (vendor/ is gitignored)
composer checks           # cs + phpstan + tests – run before finishing ANY change
composer cs               # phpcs (digitalcz/coding-standard, PSR-12 based)
composer csfix            # phpcbf auto-fix
composer phpstan          # phpstan level max, strict rules, paths: src, tests, examples
composer tests            # phpunit 9.5
vendor/bin/phpunit --filter EnvelopeLabelsEndpointTest   # single test class
```

`composer checks` must be green before you report work as done. CI runs the same three tools.

## Layout

```
src/DigiSign.php            entry point / facade; one method per top-level endpoint (envelopes(), account(), files(), ...)
src/DigiSignClient.php      PSR-18 wrapper, JSON encode/decode, error -> exception mapping
src/Auth/                   ApiKeyCredentials, TokenCredentials, CachedCredentials, Token
src/Endpoint/               one class per API endpoint, all extend ResourceEndpoint
src/Endpoint/Traits/        CRUD/Create/Get/List/Update/Delete EndpointTrait – compose, don't reimplement
src/Resource/               API response models, all extend BaseResource; Collection, ListResource, Period, ...
src/Exception/              HTTP-status exception hierarchy (BadRequest, Unauthorized, Forbidden, NotFound, Server, ...)
src/Stream/                 FileStream, FileResponse (uploads/downloads)
tests/                      mirrors src/; tests/Endpoint/EndpointTestCase.php is the base for endpoint tests
examples/                   runnable usage examples; also linted by phpcs + phpstan
```

## Conventions

### Endpoints
- `final class XxxEndpoint extends ResourceEndpoint`, with `/** @extends ResourceEndpoint<Resource> */`.
- Constructor takes parent endpoint + path params, calls `parent::__construct($parent, '/{envelope}/labels', Label::class, ['envelope' => $envelope])`.
- Path params accept `Resource|string` (an instance or its id).
- Standard operations come from traits (`use CRUDEndpointTrait;` or individual ones). Custom actions use `getRequest()`, `postRequest()`, `putRequest()`, `deleteRequest()` + `createResource()` / `createCollectionResource()`.
- Nested endpoints are exposed as methods on the parent (e.g. `EnvelopesEndpoint::labels()`); top-level ones as methods on `DigiSign`.

### Resources
- `class Xxx extends BaseResource` with public typed properties; nullable ones default to `= null`.
- Hydration is reflection-driven: native type wins; otherwise the `@var` docblock is parsed.
  - Nested resource: `public ?Address $address = null;`
  - Collections: `/** @var Collection<EnvelopeRecipient> */ public Collection $recipients;`
  - Dates: `DateTime` or `PreciseDateTime` (millis).
  - Arrays: annotate precisely, e.g. `/** @var array<string>|null */`.
- Entity-like resources (`id`, `_links`, timestamps) use `Traits\EntityResourceTrait`.
- Deprecations: keep the property, add `/** @deprecated Use $x instead */`, add a `Deprecate ...` CHANGELOG line. Never silently remove or rename public properties/methods in a minor release.

### Tests
- Endpoint tests extend `EndpointTestCase`, use the mock HTTP client, and assert the request: `self::assertLastRequest('PUT', '/api/envelopes/bar/labels', $body)`.
- Every test class needs `@covers` (phpunit runs with `forceCoversAnnotation`).
- New endpoint / new method => new test method. No PR is accepted without tests (see CONTRIBUTING.md).

### Style
- phpcs ruleset: `vendor/digitalcz/coding-standard` (slevomat). Let `composer csfix` fix formatting; fix remaining errors by hand.
- phpstan level max + strict rules. No `@phpstan-ignore` without a comment saying why.
- Keep classes `final` unless designed for extension. Prefer constructor promotion. Stay PHP 8.0 compatible in `src/` – no 8.1+-only syntax (enums, `readonly` properties, `never`, first-class callable syntax).

## Workflow for a typical change ("API added field X to resource Y")

1. Add property to `src/Resource/Y.php` with correct type/docblock.
2. If it is a new endpoint or endpoint method: add class/method in `src/Endpoint/`, wire it on the parent, add test in `tests/Endpoint/`.
3. Add a line under `## [Unreleased]` in `CHANGELOG.md`, format: `- Add \`Y.x\` property` / `- Add \`YEndpoint.method\` method` / `- Deprecate ... in favor of ...` / `- Fix ...`.
4. Update `README.md` / `examples/` if behaviour or public usage changed.
5. `composer checks`.

## Git

- Branch from `2.x`. Branch names: `feature/short-description`, `fix/short-description`.
- Commit messages follow GitHub conventions, no ticket prefixes:
  - Subject in imperative mood, capitalized, max 72 chars, no trailing period: `Add EnvelopeCategory endpoint and resource`.
  - Blank line, then optional body explaining *why* (wrap at 72). Reference issues/PRs as `#123`; use `Fixes #123` / `Closes #123` to auto-close.
  - Release commits are `[REL] x.y.z - YYYY-MM-DD` and are done by maintainers only.
- One PR per feature; squash noisy intermediate commits.
- Do not commit `vendor/`, `composer.lock`, `.phpcs.cache`, `.phpunit.result.cache`, `.idea/` (all gitignored).
- Never push, tag or release unless explicitly asked.

## Don'ts

- Don't edit `vendor/`.
- Don't bump versions or move the `[Unreleased]` CHANGELOG section – that's part of the release process.
- Don't change `composer.json` `require` constraints without asking; this is a library, constraints affect every consumer.
- Don't call the real API from tests; use the mock client from `EndpointTestCase`.
- Don't add new runtime dependencies.
