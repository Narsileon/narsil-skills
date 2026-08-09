# Agent skills

Portable [Cursor Agent Skills](https://cursor.com/docs/agent/skills) for Blade, ESLint, HTML, Laravel, PHP, React, and Tailwind. Skill index and consumer wiring: [AGENTS.md](AGENTS.md).

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
    "narsil/narsil-skills": "^1.0"
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
    "narsil/narsil-skills": "@dev"
  }
}
```

```bash
composer update narsil/narsil-skills
```

## Deployment / CI

`narsil/narsil-skills` is **require-dev only** — production and deploy pipelines must use:

```bash
composer install --no-dev --optimize-autoloader
```

Deploy servers do not need repository access to `narsil/narsil-skills`. Local dev: `composer install` (with dev dependencies).

## Install globally (optional)

```bash
cp -R vendor/narsil/narsil-skills/skills/blade ~/.cursor/skills/blade
cp -R vendor/narsil/narsil-skills/skills/eslint ~/.cursor/skills/eslint
cp -R vendor/narsil/narsil-skills/skills/general ~/.cursor/skills/general
cp -R vendor/narsil/narsil-skills/skills/laravel ~/.cursor/skills/laravel
cp -R vendor/narsil/narsil-skills/skills/php ~/.cursor/skills/php
cp -R vendor/narsil/narsil-skills/skills/react ~/.cursor/skills/react
cp -R vendor/narsil/narsil-skills/skills/tailwind ~/.cursor/skills/tailwind
```
