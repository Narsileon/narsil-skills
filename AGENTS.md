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
**Consumer project** (`composer require --dev narsileon/narsil-skills`): add one link per stack to that project's `AGENTS.md`. Do not copy rules here. If the project skips `vendor/`, add an exception for `vendor/narsileon/narsil-skills/`.

```markdown
| `vendor/narsileon/narsil-skills/skills/` | Agent skills + templates (exception to vendor skip) |

General: follow the [general](vendor/narsileon/narsil-skills/skills/general/SKILL.md) skill.
Blade: follow the [blade](vendor/narsileon/narsil-skills/skills/blade/SKILL.md) skill.
ESLint: follow the [eslint](vendor/narsileon/narsil-skills/skills/eslint/SKILL.md) skill.
HTML: follow the [html](vendor/narsileon/narsil-skills/skills/html/SKILL.md) skill.
Laravel: follow the [laravel](vendor/narsileon/narsil-skills/skills/laravel/SKILL.md) skill.
PHP style: follow the [php](vendor/narsileon/narsil-skills/skills/php/SKILL.md) skill.
React style: follow the [react](vendor/narsileon/narsil-skills/skills/react/SKILL.md) skill.
Tailwind: follow the [tailwind](vendor/narsileon/narsil-skills/skills/tailwind/SKILL.md) skill.
```

Pick the stack links that apply (e.g. always `general`; Laravel + Blade: `php` + `laravel` + `html` + `blade` + `tailwind`; React: `html` + `react` + `tailwind`).
