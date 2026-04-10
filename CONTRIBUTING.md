# Contributing to Replicator

## Core Rules

All work after the repository bootstrap follows this flow:

1. Create or refine a GitHub issue with a narrow scope.
2. Create a branch from `main` named `codex/<issue-number>-<slug>`.
3. Implement only the work required for that issue.
4. Use conventional commits.
5. Open a pull request that references the issue.
6. Merge to `main` only through the pull request.

Direct pushes to `main` are not part of normal delivery.

## Issue Requirements

Every issue must stay small enough to be reviewed comfortably in one pull request.

Each issue should define:

- goal
- scope
- out of scope
- acceptance criteria
- dependencies
- test plan

If the issue cannot be implemented and reviewed as a focused change, split it.

## Branch Naming

Use this branch format:

```text
codex/<issue-number>-<short-slug>
```

Example:

```text
codex/12-install-livewire
```

## Commit Format

Use conventional commits:

```text
type(scope): summary
```

Examples:

```text
chore(repo): add issue templates
feat(auth): install fortify backend flows
fix(admin): stop impersonation after logout
```

Preferred types:

- `feat`
- `fix`
- `chore`
- `refactor`
- `test`
- `docs`
- `ci`

Keep each commit atomic. If a commit message cannot describe one clear change, the change is probably too large.

## Pull Request Expectations

Every pull request must:

- reference its issue
- stay within the issue scope
- describe user-facing or developer-facing impact
- list tests run
- note any follow-up work explicitly

PRs should avoid unrelated cleanup or opportunistic refactors unless the issue requires them.

## Release Process

`main` is the release branch. Merges to `main` are expected to use conventional commits so automated semantic versioning can infer the next release.

The repository uses Release Please on pushes to `main`. That workflow will:

- inspect merged conventional commits
- create or update a release pull request when needed
- tag releases using semantic versioning

## Definition of Done

A change is done when:

- the implementation matches the issue acceptance criteria
- tests appropriate to the change are added or updated
- local verification has been run
- the PR description is complete
- the change is small enough to review without broad architectural guesswork
