---
name: release
description: Release a new version of the digitalcz/digisign SDK – bump DigiSign::VERSION, cut CHANGELOG, open the [REL] PR, then tag and publish the GitHub release after merge.
argument-hint: "[X.Y.Z | major | minor | patch]"
disable-model-invocation: true
---

# Release digitalcz/digisign

Argument: `$ARGUMENTS` – explicit version (`2.13.0`) or bump type (`major` / `minor` / `patch`). Empty = derive from CHANGELOG.

Process derived from previous releases (#376 2.10.0, #380 2.11.0, #399 2.12.0):
release PR from branch `release` into `2.x` → squash merge → lightweight tag `vX.Y.Z` on the merge commit → GitHub release with auto-generated notes → Packagist picks the tag up.

Stop and report on any failed check. Ask the user before every outward-facing step (push, PR, merge, tag push, GitHub release).

## 1. Preflight

```bash
git fetch origin --tags --prune
git status --porcelain                      # must be empty
git rev-parse --abbrev-ref HEAD
gh run list --branch 2.x --limit 3          # last CI on 2.x must be green
git describe --tags --abbrev=0 origin/2.x   # previous version
git log --oneline <prev-tag>..origin/2.x    # what goes into the release
```

- `CHANGELOG.md` → `## [Unreleased]` must contain entries. If empty, stop – nothing to release.
- Cross-check merged PRs since the previous tag (`gh pr list --base 2.x --state merged --search "merged:>=<prev-tag-date>"`) against the Unreleased lines. Report PRs without a CHANGELOG line; do not invent lines silently – propose them to the user.
- Remote branch `release` usually still holds the previous (squash-merged) release. Check its PR is merged (`gh pr list --head release --state all`); if so, ask the user and overwrite it with `git push --force-with-lease=release:<old-sha> origin HEAD:release`. Never overwrite it when its PR is still open.

## 2. Determine version

Current version = `DigiSign::VERSION` in `src/DigiSign.php` (must equal previous tag without `v`).

If no explicit version given, derive from Unreleased (SemVer, public library):
- any `[BREAKING-CHANGE]`, removed/renamed public property/method/class, changed signature → **major** – but this repo historically ships BC-sensitive fixes in minors (e.g. 2.9.0, unreleased `Remove Limits.envelopesMonthly`). Flag them to the user and let them decide.
- any `Add …` / `Deprecate …` / `Change …` → **minor**
- only `Fix …` → **patch**

Confirm the final version `X.Y.Z` with the user before editing anything.

## 3. Prepare release branch

```bash
git switch -c release origin/2.x
```

### CHANGELOG.md
- Rename `## [Unreleased]` → `## [X.Y.Z] - YYYY-MM-DD` (today's date, ISO).
- Insert a new empty `## [Unreleased]` above it (followed by a blank line).
- Keep entries as they are (flat `- Add …` / `- Deprecate …` / `- Fix …` list, as in 2.12.0). Only fix obvious typos/duplicates; group related lines if the user asks.

### src/DigiSign.php
- `public const VERSION = 'X.Y.Z';`

Nothing else carries the version (composer.json has no `version` / `branch-alias`).

### Verify
```bash
composer checks
git diff --stat   # expect exactly CHANGELOG.md + src/DigiSign.php
```

`composer.lock` is not committed, so local phpcs/phpstan may be newer than CI and report errors outside the release diff. If failures are only in untouched files and CI on `2.x` is green, report them and continue; tests must pass.

## 4. Commit + PR

Commit message (no ticket prefix, matches #399):
```
[REL] X.Y.Z - YYYY-MM-DD
```

After user confirms:
```bash
git push -u origin release
gh pr create --base 2.x --head release --title "[REL] X.Y.Z - YYYY-MM-DD" --body "<body>"
```

PR body: short summary of highlights (new endpoints, deprecations, BC-sensitive fixes) + the X.Y.Z CHANGELOG section verbatim. Highlight anything consumers must act on (deprecations, nullable changes, removals).

Then stop and tell the user: PR needs review + green CI, merge with **squash**. Do not merge yourself unless explicitly asked.

## 5. After merge – tag + GitHub release

Run only when the user says the PR is merged (verify: `gh pr view release --json state,mergeCommit`).

```bash
git fetch origin
MERGE=$(gh pr view <PR#> --json mergeCommit -q .mergeCommit.oid)
git show $MERGE:src/DigiSign.php | grep "VERSION = 'X.Y.Z'"   # sanity check
```

After user confirms:
```bash
git tag vX.Y.Z $MERGE            # lightweight tag, like all previous ones
git push origin vX.Y.Z
gh release create vX.Y.Z --target 2.x --title vX.Y.Z --generate-notes --latest
```

Optionally prepend a short highlights paragraph to the generated notes (as in v2.11.0) via `--notes-start-tag` / editing afterwards with `gh release edit vX.Y.Z --notes-file …`.

Tag must sit on the release merge commit – never tag before the [REL] PR is merged (v2.12.0 was tagged before its release PR; avoid repeating that).

## 6. Post-release

```bash
curl -s https://repo.packagist.org/p2/digitalcz/digisign.json | jq -r '.packages["digitalcz/digisign"][0].version'
```
Expect `vX.Y.Z` (Packagist updates via GitHub hook, may take a few minutes). If it stays stale, tell the user to hit "Update" on packagist.org.

Clean up locally:
```bash
git switch 2.x && git pull --ff-only
git branch -D release
git push origin --delete release   # only if GitHub didn't auto-delete it; ask first
```

Final report: version, PR link, tag, release URL, Packagist status.
