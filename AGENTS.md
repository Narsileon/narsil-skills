# AGENTS.md

| Path | Role |
|------|------|
| `skills/general/` | General — [SKILL.md](skills/general/SKILL.md) (bug fixes, comments) |
| `skills/blade/` | Blade — [SKILL.md](skills/blade/SKILL.md) + [templates/](skills/blade/templates/) (imports [php](skills/php/SKILL.md), [html](skills/html/SKILL.md), [tailwind](skills/tailwind/SKILL.md)) |
| `skills/eslint/` | ESLint — [SKILL.md](skills/eslint/SKILL.md) |
| `skills/html/` | HTML — [SKILL.md](skills/html/SKILL.md) |
| `skills/laravel/` | Laravel — [SKILL.md](skills/laravel/SKILL.md) + [templates/](skills/laravel/templates/) (imports [php](skills/php/SKILL.md)) |
| `skills/php/` | PHP — [SKILL.md](skills/php/SKILL.md) + [templates/](skills/php/templates/) |
| `skills/react/` | React — [SKILL.md](skills/react/SKILL.md) (imports [html](skills/html/SKILL.md), [tailwind](skills/tailwind/SKILL.md)) |
| `skills/tailwind/` | Tailwind — [SKILL.md](skills/tailwind/SKILL.md) |
| `skills/typo3/` | TYPO3 — [SKILL.md](skills/typo3/SKILL.md) (imports [php](skills/php/SKILL.md), [html](skills/html/SKILL.md), [extbase](skills/typo3/extbase/SKILL.md)) |
| `skills/typo3/extbase/` | Extbase — [SKILL.md](skills/typo3/extbase/SKILL.md) + [templates/](skills/typo3/extbase/templates/) (subskill of typo3) |
**Consumer project** (`composer require --dev narsil/skills`): add one link per stack to that project's `AGENTS.md`. Do not copy rules here. If the project skips `vendor/`, add an exception for `vendor/narsil/skills/`.

```markdown
| `vendor/narsil/skills/skills/` | Agent skills + templates (exception to vendor skip) |

General: follow the [general](vendor/narsil/skills/skills/general/SKILL.md) skill.
Blade: follow the [blade](vendor/narsil/skills/skills/blade/SKILL.md) skill.
ESLint: follow the [eslint](vendor/narsil/skills/skills/eslint/SKILL.md) skill.
HTML: follow the [html](vendor/narsil/skills/skills/html/SKILL.md) skill.
Laravel: follow the [laravel](vendor/narsil/skills/skills/laravel/SKILL.md) skill.
PHP style: follow the [php](vendor/narsil/skills/skills/php/SKILL.md) skill.
React style: follow the [react](vendor/narsil/skills/skills/react/SKILL.md) skill.
Tailwind: follow the [tailwind](vendor/narsil/skills/skills/tailwind/SKILL.md) skill.
TYPO3: follow the [typo3](vendor/narsil/skills/skills/typo3/SKILL.md) skill.
```

Pick the stack links that apply (e.g. always `general`; Laravel + Blade: `php` + `laravel` + `html` + `blade` + `tailwind`; TYPO3: `php` + `html` + `typo3`; React: `html` + `react` + `tailwind`).
