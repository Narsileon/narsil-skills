# AGENTS.md

| Path | Role |
|------|------|
| `skills/eslint/` | ESLint — [SKILL.md](skills/eslint/SKILL.md) |
| `skills/html/` | HTML — [SKILL.md](skills/html/SKILL.md) |
| `skills/laravel/` | Laravel — [SKILL.md](skills/laravel/SKILL.md) + [templates/](skills/laravel/templates/) (imports [php](skills/php/SKILL.md)) |
| `skills/php/` | PHP — [SKILL.md](skills/php/SKILL.md) + [templates/](skills/php/templates/) |
| `skills/react/` | React — [SKILL.md](skills/react/SKILL.md) (imports [html](skills/html/SKILL.md)) |
| `skills/typo3/` | TYPO3 — [SKILL.md](skills/typo3/SKILL.md) (imports [php](skills/php/SKILL.md), [html](skills/html/SKILL.md)) |

**Consumer project** (`composer require --dev nauten/agent-skills`): add one link per stack to that project's `AGENTS.md`. Do not copy rules here.

```markdown
ESLint: follow the [eslint](vendor/nauten/agent-skills/skills/eslint/SKILL.md) skill.
HTML: follow the [html](vendor/nauten/agent-skills/skills/html/SKILL.md) skill.
Laravel: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.
PHP style: follow the [php](vendor/nauten/agent-skills/skills/php/SKILL.md) skill.
React style: follow the [react](vendor/nauten/agent-skills/skills/react/SKILL.md) skill.
TYPO3: follow the [typo3](vendor/nauten/agent-skills/skills/typo3/SKILL.md) skill.
```

Pick the stack links that apply (e.g. Laravel projects: `php` + `laravel`; TYPO3 projects: `php` + `html` + `typo3`; React projects: `html` + `react`).
