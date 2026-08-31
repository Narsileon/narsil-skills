# Agent skills

Portable [Cursor Agent Skills](https://cursor.com/docs/agent/skills) for Blade, ESLint, HTML, Laravel, PHP, React, Tailwind, and TYPO3. Skill index and consumer wiring: [AGENTS.md](AGENTS.md).

## Install (Composer)

Add the GitHub repository, then require the package as a dev dependency:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/Narsileon/narsil-skills.git"
    }
  ],
  "require-dev": {
    "narsil/skills": "^1.0"
  }
}
```

Local development (path repo):

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../narsil-skills"
    }
  ],
  "require-dev": {
    "narsil/skills": "@dev"
  }
}
```

```bash
composer update narsil/skills
```

## PHP checks

Run the executable checker from a consumer project after creating or editing PHP:

```bash
vendor/narsil/skills/scripts/php/check
vendor/narsil/skills/scripts/php/check app/Domain/Model
```

It runs `php -l`, checks the PHP rules that can be verified safely without a project-specific formatter or static-analysis configuration, and automatically runs `composer dump-autoload --no-interaction`.

## Deployment / CI

`narsil/skills` is **require-dev only** — production and deploy pipelines must use:

```bash
composer install --no-dev --optimize-autoloader
```

Deploy servers do not need repository access to `narsil/skills`. Local dev: `composer install` (with dev dependencies).

## Install globally (optional)

```bash
cp -R vendor/narsil/skills/skills/blade ~/.cursor/skills/blade
cp -R vendor/narsil/skills/skills/eslint ~/.cursor/skills/eslint
cp -R vendor/narsil/skills/skills/general ~/.cursor/skills/general
cp -R vendor/narsil/skills/skills/laravel ~/.cursor/skills/laravel
cp -R vendor/narsil/skills/skills/php ~/.cursor/skills/php
cp -R vendor/narsil/skills/skills/react ~/.cursor/skills/react
cp -R vendor/narsil/skills/skills/tailwind ~/.cursor/skills/tailwind
cp -R vendor/narsil/skills/skills/typo3 ~/.cursor/skills/typo3
```
