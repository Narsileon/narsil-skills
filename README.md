# Agent skills

Portable [Cursor Agent Skills](https://cursor.com/docs/agent/skills) for ESLint, HTML, Laravel, PHP, React, and TYPO3 projects. Distributed as a Composer package — skills live in `vendor/nauten/agent-skills/skills/` after install.

## Skills

| Skill                              | Use for                                              |
| ---------------------------------- | ---------------------------------------------------- |
| [eslint](skills/eslint/SKILL.md)   | ESLint flat config, import sort, lint CI             |
| [html](skills/html/SKILL.md)       | HTML / Fluid / Blade / JSX markup spacing            |
| [laravel](skills/laravel/SKILL.md) | Eloquent models, migrations (imports `php`)          |
| [php](skills/php/SKILL.md)         | PHP classes — regions, PHPDoc, brace style           |
| [react](skills/react/SKILL.md)     | React/TSX components, hooks, stores (imports `html`) |
| [typo3](skills/typo3/SKILL.md)     | TYPO3 projects (imports `php`, `html`)               |

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

## Wire into AGENTS.md

Add to the consuming project's `AGENTS.md`:

```markdown
| `vendor/nauten/agent-skills/skills/` | Agent skills + templates (exception to vendor skip) |

ESLint: follow the [eslint](vendor/nauten/agent-skills/skills/eslint/SKILL.md) skill (when the project uses ESLint).
HTML: follow the [html](vendor/nauten/agent-skills/skills/html/SKILL.md) skill.
Laravel: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.
PHP style: follow the [php](vendor/nauten/agent-skills/skills/php/SKILL.md) skill.
React style: follow the [react](vendor/nauten/agent-skills/skills/react/SKILL.md) skill.
TYPO3: follow the [typo3](vendor/nauten/agent-skills/skills/typo3/SKILL.md) skill.
```

Pick the stack links that apply (Laravel: `php` + `laravel`; TYPO3: `php` + `html` + `typo3`; React: `html` + `react`).

If your `AGENTS.md` tells the agent to skip `vendor/`, add an explicit exception for `vendor/nauten/agent-skills/`.

## Install globally (optional)

```bash
cp -R vendor/nauten/agent-skills/skills/eslint ~/.cursor/skills/eslint
cp -R vendor/nauten/agent-skills/skills/laravel ~/.cursor/skills/laravel
cp -R vendor/nauten/agent-skills/skills/php ~/.cursor/skills/php
cp -R vendor/nauten/agent-skills/skills/react ~/.cursor/skills/react
cp -R vendor/nauten/agent-skills/skills/typo3 ~/.cursor/skills/typo3
```

## Path aliases (React)

Configure aliases in `tsconfig.json` and `vite.config.js` per project:

| Alias   | Typical path                                                   |
| ------- | -------------------------------------------------------------- |
| `@/*`   | `./resources/js/*`                                             |
| `@ui/*` | shared UI package (e.g. `./vendor/your-org/ui/resources/js/*`) |

The skill rules apply regardless of the alias prefix — match what the project already uses.
