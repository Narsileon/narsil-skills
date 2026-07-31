# AGENTS.md

## Bug fixes

Find the root cause; fix with the smallest change that solves it — not the shallowest workaround. If a small refactor simplifies an overcomplicated path (e.g. website ↔ API), prefer that over patching both ends.

| Path | Role |
|------|------|
| `skills/blade/` | Blade — [SKILL.md](skills/blade/SKILL.md) + [templates/](skills/blade/templates/) (imports [php](skills/php/SKILL.md), [html](skills/html/SKILL.md), [tailwind](skills/tailwind/SKILL.md)) |
| `skills/eslint/` | ESLint — [SKILL.md](skills/eslint/SKILL.md) |
| `skills/html/` | HTML — [SKILL.md](skills/html/SKILL.md) |
| `skills/laravel/` | Laravel — [SKILL.md](skills/laravel/SKILL.md) + [templates/](skills/laravel/templates/) (imports [php](skills/php/SKILL.md)) |
| `skills/php/` | PHP — [SKILL.md](skills/php/SKILL.md) + [templates/](skills/php/templates/) |
| `skills/react/` | React — [SKILL.md](skills/react/SKILL.md) (imports [html](skills/html/SKILL.md), [tailwind](skills/tailwind/SKILL.md)) |
| `skills/tailwind/` | Tailwind — [SKILL.md](skills/tailwind/SKILL.md) |
| `skills/typo3/` | TYPO3 — [SKILL.md](skills/typo3/SKILL.md) (imports [php](skills/php/SKILL.md), [html](skills/html/SKILL.md), [extbase](skills/typo3/extbase/SKILL.md)) |
| `skills/typo3/extbase/` | Extbase — [SKILL.md](skills/typo3/extbase/SKILL.md) + [templates/](skills/typo3/extbase/templates/) (subskill of typo3) |

**Consumer project** (`composer require --dev nauten/agent-skills`): add one link per stack to that project's `AGENTS.md`. Do not copy rules here. If the project skips `vendor/`, add an exception for `vendor/nauten/agent-skills/`.

```markdown
| `vendor/nauten/agent-skills/skills/` | Agent skills + templates (exception to vendor skip) |

Bug fixes: follow [AGENTS.md](vendor/nauten/agent-skills/AGENTS.md) (Bug fixes).

Blade: follow the [blade](vendor/nauten/agent-skills/skills/blade/SKILL.md) skill.
ESLint: follow the [eslint](vendor/nauten/agent-skills/skills/eslint/SKILL.md) skill.
HTML: follow the [html](vendor/nauten/agent-skills/skills/html/SKILL.md) skill.
Laravel: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.
PHP style: follow the [php](vendor/nauten/agent-skills/skills/php/SKILL.md) skill.
React style: follow the [react](vendor/nauten/agent-skills/skills/react/SKILL.md) skill.
Tailwind: follow the [tailwind](vendor/nauten/agent-skills/skills/tailwind/SKILL.md) skill.
TYPO3: follow the [typo3](vendor/nauten/agent-skills/skills/typo3/SKILL.md) skill.
```

Pick the stack links that apply (e.g. Laravel + Blade: `php` + `laravel` + `html` + `blade` + `tailwind`; TYPO3: `php` + `html` + `typo3`; React: `html` + `react` + `tailwind`).
