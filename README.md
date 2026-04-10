# Replicator

Replicator is an AI-powered SDLC platform in its earliest stage of development.

The repository is intentionally being built with a strict delivery workflow:

- one GitHub issue per change
- one branch per issue
- one pull request per branch
- small, reviewable PRs only
- conventional commits only
- `main` is updated by pull request only after the initial governance bootstrap

## Delivery Workflow

See [CONTRIBUTING.md](CONTRIBUTING.md) for the required issue, branch, commit, PR, and release workflow.

## Current Direction

The first product areas are:

- shared Blade and Livewire UI foundation
- authentication and authorization
- admin tools for user and notification management
- the `ideas` app for private idea development and proposal creation

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

Or use the bundled project bootstrap:

```bash
composer run setup
composer run dev
```
