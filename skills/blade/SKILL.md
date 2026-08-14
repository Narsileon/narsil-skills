---
name: blade
description: >-
  Laravel Blade views and components — folder layout (ui, icons, blocks,
  subblocks, layouts, mail, pages), View Component classes for logic, inline PHP in Blade
  for Tailwind classes/variants, and twMerge via
  gehrisandro/tailwind-merge-laravel. Use when creating or editing
  .blade.php, app/View/Components/, resources/views/, or Blade UI/block
  components.
---

# Blade

HTML / markup spacing: follow [html](../html/SKILL.md).
PHP class style: follow [php](../php/SKILL.md) — regions (omit empty ones), PHPDoc, brace style, [class.stub](../php/templates/class.stub).
Tailwind tokens: follow [tailwind](../tailwind/SKILL.md).

Copy [templates/](templates/) into the target project. The stubs are the contract.

| Artifact | Template | Role |
| -------- | -------- | ---- |
| View Component class | [component.stub](templates/component.stub) | Logic + public props (`Ui\Button`) |
| UI Blade | [component.blade.stub](templates/component.blade.stub) | Classes + variants (`@php` + `twMerge`) |

## Folder layout

Under `resources/views/`:

```
components/
  ui/{component-name}.blade.php
  icons/{icon-name}.blade.php
  {block-name}.blade.php
  {block-name}/{subblock-name}.blade.php
layouts/
mail/
pages/
```

| Path | Role | Builds with |
| ---- | ---- | ----------- |
| `components/ui/{name}.blade.php` | Primitive UI | Markup and icons (no blocks / subblocks) |
| `components/icons/{name}.blade.php` | Icon | SVG markup only |
| `components/{block}.blade.php` | Block | UI and subblocks |
| `components/{block}/{subblock}.blade.php` | Subblock | UI |
| `layouts/` | Page layouts | |
| `mail/` | Mail templates | |
| `pages/` | Pages | Layouts + blocks |

```blade
{{-- components/hero.blade.php → <x-hero> --}}
<section {{ $attributes }}>
    <x-hero.heading>{{ $heading }}</x-hero.heading>
    <x-ui.button :href="$ctaUrl">{{ $ctaLabel }}</x-ui.button>
</section>
```

Do not nest deeper than `{block}/{subblock}`. Do not put blocks in `ui/` or `icons/`.

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
| `app/View/Components/**/*.php` | Logic, props, defaults, computed data, `render()` |
| `resources/views/components/**/*.blade.php` | Markup, **classes**, **variants** (inline `@php`) |

- Keep variant maps and class strings out of the PHP class.
- Keep business / presentation logic out of the Blade (no queries, no heavy branching beyond class/`match` for variants).

## Component class

- `final class` matching the view path: `App\View\Components\Ui\Button`, `App\View\Components\Icons\Check`, `App\View\Components\Hero`, `App\View\Components\Hero\Cta` (or package namespace). Icons may be anonymous Blade (no class) when they are SVG-only.
- Follow [php](../php/SKILL.md): no constructor property promotion; typed props in `PROPERTIES`; assign in `__construct`.
- Public props for anything the view needs (`$variant`, `$size`, …).
- `render(): View` returns the matching view (`view('components.ui.button')`, `view('components.icons.check')`, `view('components.hero')`, `view('components.hero.cta')`).

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
<button data-slot="button" {{ $attributes->twMerge($class) }} type="button">
    {{ $slot }}
</button>
```

- Prefer `match` for variant → class maps (same as [php](../php/SKILL.md) — no ternaries).
- Canonical Tailwind tokens only — see [tailwind](../tailwind/SKILL.md).
- Markup spacing: see [html](../html/SKILL.md).

## File names

- Blade: kebab-case (`button.blade.php`, `alert-dialog.blade.php`).
- PHP class: PascalCase matching the path (`Ui/Button.php` → `<x-ui.button>`, `Icons/Check.php` → `<x-icons.check>`, `Hero.php` → `<x-hero>`, `Hero/Cta.php` → `<x-hero.cta>`).
