# Agent skills

Portable [Cursor Agent Skills](https://cursor.com/docs/agent/skills) for Blade, ESLint, HTML, Laravel, PHP, React, Tailwind, and TYPO3. Skill index and consumer wiring: [AGENTS.md](AGENTS.md).

## Install (Composer)

Add the GitLab repository, then require the package as a dev dependency:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@gitlab.rheinschafe.de:nauten/agent-skills.git"
    }
  ],
  "require-dev": {
    "nauten/agent-skills": "^1.0"
  }
}
```

Local development (path repo):

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../agent-skills"
    }
  ],
  "require-dev": {
    "nauten/agent-skills": "@dev"
  }
}
```

```bash
composer update nauten/agent-skills
```

## Deployment / CI

`nauten/agent-skills` is **require-dev only** — production and deploy pipelines must use:

```bash
composer install --no-dev --optimize-autoloader
```

Deploy servers do not need GitLab SSH access to `nauten/agent-skills`. Local dev: `composer install` (with dev dependencies).

## Install globally (optional)

```bash
cp -R vendor/nauten/agent-skills/skills/blade ~/.cursor/skills/blade
cp -R vendor/nauten/agent-skills/skills/eslint ~/.cursor/skills/eslint
cp -R vendor/nauten/agent-skills/skills/laravel ~/.cursor/skills/laravel
cp -R vendor/nauten/agent-skills/skills/php ~/.cursor/skills/php
cp -R vendor/nauten/agent-skills/skills/react ~/.cursor/skills/react
cp -R vendor/nauten/agent-skills/skills/tailwind ~/.cursor/skills/tailwind
cp -R vendor/nauten/agent-skills/skills/typo3 ~/.cursor/skills/typo3
```
