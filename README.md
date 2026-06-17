# Agent skills

Portable [Cursor Agent Skills](https://cursor.com/docs/agent/skills) for Laravel and React projects. Distributed as a Composer package — skills live in `vendor/nauten/agent-skills/skills/` after install.

## Skills

| Skill                              | Use for                                    |
| ---------------------------------- | ------------------------------------------ |
| [laravel](skills/laravel/SKILL.md) | PHP services, Eloquent models, migrations  |
| [react](skills/react/SKILL.md)     | React/TSX components, hooks, stores, types |

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

## Wire into AGENTS.md

Add to the consuming project's `AGENTS.md`:

```markdown
| `vendor/nauten/agent-skills/skills/` | Agent skills + templates (exception to vendor skip) |

PHP style: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.
React style: follow the [react](vendor/nauten/agent-skills/skills/react/SKILL.md) skill.
```

If your `AGENTS.md` tells the agent to skip `vendor/`, add an explicit exception for `vendor/nauten/agent-skills/`.

## Install globally (optional)

```bash
cp -R vendor/nauten/agent-skills/skills/laravel ~/.cursor/skills/laravel-php
cp -R vendor/nauten/agent-skills/skills/react ~/.cursor/skills/react
```

## Path aliases (React)

Configure aliases in `tsconfig.json` and `vite.config.js` per project:

| Alias   | Typical path                                                   |
| ------- | -------------------------------------------------------------- |
| `@/*`   | `./resources/js/*`                                             |
| `@ui/*` | shared UI package (e.g. `./vendor/your-org/ui/resources/js/*`) |

The skill rules apply regardless of the alias prefix — match what the project already uses.
