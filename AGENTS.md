# AGENTS.md

Portable agent skills for Laravel/PHP and React/TypeScript.

| Path              | Role                            |
| ----------------- | ------------------------------- |
| `skills/laravel/` | PHP services, models, migrations |
| `skills/react/`   | React components, hooks, types  |
| `skills/eslint/`  | ESLint flat config + lint rules |

PHP style: follow the [laravel](skills/laravel/SKILL.md) skill — full rules (regions, PHPDoc, Pint, facades) live there; consumer `AGENTS.md` files only link to it.
React style: follow the [react](skills/react/SKILL.md) skill.
ESLint: follow the [eslint](skills/eslint/SKILL.md) skill.

## Consumer projects

After `composer require --dev nauten/agent-skills`, add **one line per stack** to the project `AGENTS.md`. Do not copy skill rules into the project.

```markdown
PHP style: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.
React style: follow the [react](vendor/nauten/agent-skills/skills/react/SKILL.md) skill.
ESLint: follow the [eslint](vendor/nauten/agent-skills/skills/eslint/SKILL.md) skill.
```
