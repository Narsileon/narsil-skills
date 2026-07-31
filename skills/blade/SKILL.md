---
name: blade
description: >-
  Laravel Blade components — View Component classes for logic, inline PHP in
  Blade for Tailwind classes/variants, and twMerge via
  gehrisandro/tailwind-merge-laravel. Use when creating or editing
  .blade.php, app/View/Components/, or Blade UI components.
---

# Blade

HTML / markup spacing: follow [html](../html/SKILL.md).
PHP class style: follow [php](../php/SKILL.md) — regions, PHPDoc, brace style, [class.stub](../php/templates/class.stub).
Tailwind tokens: follow [tailwind](../tailwind/SKILL.md).

Copy [templates/](templates/) into the target project. The stubs are the contract.

| Artifact | Template | Role |
| -------- | -------- | ---- |
| View Component class | [component.stub](templates/component.stub) | Logic + public props |
| Component Blade view | [component.blade.stub](templates/component.blade.stub) | Classes + variants (`@php` + `twMerge`) |

## Install tailwind-merge

Runtime dependency (not `--dev`):

```bash
composer require gehrisandro/tailwind-merge-laravel
```

Use everywhere classes are merged:

| Context | API |
| ------- | --- |
| Blade attributes bag | `$attributes->twMerge(…)` |
| Nested element classes | `$attributes->withoutTwMergeClasses()->twMerge(…)` + `$attributes->twMergeFor('icon', …)` |
| Inline / `@php` | `twMerge(…)` helper |
| PHP (non-Blade) | `twMerge(…)` or `TailwindMerge::merge(…)` |

Do **not** use `$attributes->merge(['class' => '…'])` for Tailwind — it does not resolve conflicts.

## Separation of concerns

| Place | Owns |
| ----- | ---- |
| `app/View/Components/*.php` | Logic, props, defaults, computed data, `render()` |
| `resources/views/components/*.blade.php` | Markup, **classes**, **variants** (inline `@php`) |

- Keep variant maps and class strings out of the PHP class.
- Keep business / presentation logic out of the Blade (no queries, no heavy branching beyond class/`match` for variants).

## Component class

- `final class` under `App\View\Components` (or package namespace).
- Follow [php](../php/SKILL.md): no constructor property promotion; typed props in `PROPERTIES`; assign in `__construct`.
- Public props for anything the view needs (`$variant`, `$size`, …).
- `render(): View` returns `view('components.…')`.

## Component Blade — classes & variants

Put base classes and variant maps in `@php`, merge with `twMerge`, apply via `$attributes->twMerge(…)`:

```blade
@php
    $class = twMerge(
        'inline-flex items-center',
        match ($size) {
            'sm' => 'h-8 px-3',
            default => 'h-9 px-4',
        },
        match ($variant) {
            'secondary' => 'bg-secondary text-secondary-foreground',
            default => 'bg-primary text-primary-foreground',
        },
    );
@endphp
<button {{ $attributes->twMerge($class) }} data-slot="button" type="button">
    {{ $slot }}
</button>
```

- Prefer `match` for variant → class maps (same as [php](../php/SKILL.md) — no ternaries).
- Canonical Tailwind tokens only — see [tailwind](../tailwind/SKILL.md).
- Markup spacing: see [html](../html/SKILL.md).

## File names

- Blade: kebab-case (`button.blade.php`, `alert-dialog.blade.php`).
- PHP class: PascalCase matching the component (`Button.php` → `<x-button>`).
