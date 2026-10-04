---
name: blade
description: >-
  Laravel Blade views and components — Narsil component structure, View Component
  classes for logic, inline PHP in Blade for Tailwind classes/variants, and twMerge via
  gehrisandro/tailwind-merge-laravel. Use when creating or editing
  .blade.php, app/View/Components/, resources/views/, or Blade UI/block
  components, or their Alpine controllers.
---

# Blade

HTML / markup spacing: follow [html](../html/SKILL.md).
PHP class style: follow [php](../php/SKILL.md) — regions (omit empty ones), PHPDoc, brace style, [class.stub](../php/templates/class.stub).
Tailwind tokens: follow [tailwind](../tailwind/SKILL.md).

Copy [templates/](templates/) into the target project. The stubs are the contract.

| Artifact             | Template                                               | Role                       |
| -------------------- | ------------------------------------------------------ | -------------------------- |
| View Component class | [component.stub](templates/component.stub)             | Logic and public props     |
| UI Blade             | [component.blade.stub](templates/component.blade.stub) | Markup, classes, and slots |

## Component structure

Use class-based components for `ui/`, `blocks/`, `contents/`, and `layout/`. Keep their PHP classes and Blade views in matching folders under `app/View/Components/` and `resources/views/components/`:

| Kind | View | Class | Tag |
| --- | --- | --- | --- |
| UI part | `ui/{group}/{group-part}.blade.php` | `Ui\{Group}\{GroupPart}` | `<x-ui.{group}.{group-part}>` |
| Block | `blocks/{group}/{group-part}.blade.php` | `Blocks\{Group}\{GroupPart}` | `<x-blocks.{group}.{group-part}>` |
| CMS content | `contents/{group}/{group-part}.blade.php` | `Contents\{Group}\{GroupPart}` | `<x-contents.{group}.{group-part}>` |
| App layout | `layout/{group}/{group-part}.blade.php` | `Layout\{Group}\{GroupPart}` | `<x-layout.{group}.{group-part}>` |

Use singular group names. Each group has a `{group}-root.blade.php` entry point and may have sibling parts such as `{group}-address.blade.php`. Match each part's view basename, PHP class suffix, tag leaf, and `data-slot`. For example, `ui/footer/footer-address.blade.php` maps to `Ui\Footer\FooterAddress`, `<x-ui.footer.footer-address>`, and `data-slot="footer-address"`.

- `ui/` contains reusable atomic parts. `blocks/` composes UI parts and content into a feature. `contents/` contains class-based roots dispatched from CMS content handles. Keep handle dispatch in the content renderer.
- `layout/` contains app-shell components such as headers and footers; `layouts/` contains full-page layouts.
- Keep page-owned lists and `@foreach` loops in the page. Extract reusable leaf markup into UI components; keep page-only subblocks under `components/{page}/`.
- Switch and Tooltip are the reference compositions in Narsil Base: the Switch block composes `ui.switch.switch-root`, `switch-track`, and `switch-thumb`; the Tooltip block composes the UI provider, trigger, portal, positioner, popup, and arrow.
- Each component part renders a matching `data-slot`; blocks without their own element forward attributes to the composed root. Only icon-only SVG views in `icons/` may be anonymous.

## Alpine structure

- Put controllers in `resources/js/alpine/{group}/{group-part}.ts`, with singular feature groups and prefixed filenames. Use `{group}-root.ts` for the main controller, for example `rich-text-editor/rich-text-editor-root.ts`.
- Give each controller its own file. Group by its feature; a resource modal belongs in `resource-modal/`, and a relation editor belongs in `relation/`.
- Keep stores and shared controller factories in their feature group as `{group}-store.ts` and `{group}-controller.ts`. Only shared registration entry points belong at the Alpine root: `register-components.ts` and `register-stores.ts`.
- Preserve existing Alpine registration names when reorganizing files.

## Install tailwind-merge

Runtime dependency (not `--dev`):

```bash
composer require gehrisandro/tailwind-merge-laravel
```

Use everywhere classes are merged:

| Context                | API                                                                                       |
| ---------------------- | ----------------------------------------------------------------------------------------- |
| Blade attributes bag   | `$attributes->twMerge(…)`                                                                 |
| Nested element classes | `$attributes->withoutTwMergeClasses()->twMerge(…)` + `$attributes->twMergeFor('icon', …)` |
| Inline / `@php`        | `twMerge(…)` helper                                                                       |
| PHP (non-Blade)        | `twMerge(…)` or `TailwindMerge::merge(…)`                                                 |

Do **not** use `$attributes->merge(['class' => '…'])` for Tailwind — it does not resolve conflicts.

## Separation of concerns

| Place                                       | Owns                                              |
| ------------------------------------------- | ------------------------------------------------- |
| `app/View/Components/**/*.php`              | Logic, props, defaults, computed data, `render()` |
| `resources/views/components/**/*.blade.php` | Markup, **classes**, **variants** (inline `@php`) |

- Keep variant maps and class strings out of the PHP class.
- Keep all computed values, defaults, normalization, route resolution, active state, and persistence out of Blade. Put them in the View Component class as properties or private methods.
- Inline `@php` is only for local class/variant assembly; do not use it to calculate values consumed by the markup.
- Keep business / presentation logic out of the Blade (no queries, route checks, or heavy branching beyond class/`match` for variants).

## Component class

- Follow [php](../php/SKILL.md): no constructor property promotion; typed props in `PROPERTIES`; assign in `__construct`.
- Keep constructors focused on assigning state. Delegate non-trivial normalization, derived values, route resolution, and conditional setup to private methods.
- Public props for anything the view needs (`$variant`, `$size`, …).
- `render()` returns the view whose path mirrors the component class.

## Component Blade — classes & variants

Put base classes and variant maps in `@php`. Make a component wrapper accept caller classes with `twMerge`, and set its root slot through the same attribute bag:

```blade
<span
	{{ $attributes->twMerge('pointer-events-none size-4 rounded-full')->merge([
	    'data-slot' => 'switch-thumb',
	]) }}
>
    {{ $slot }}
</span>
```

- Prefer `match` for variant → class maps (same as [php](../php/SKILL.md) — no ternaries).
- Canonical Tailwind tokens only — see [tailwind](../tailwind/SKILL.md).
- Markup spacing: see [html](../html/SKILL.md).

## File names

- Blade: kebab-case and prefixed by the group and part.
- PHP class: PascalCase and matches the full view path.
- The root `data-slot` matches the part name and is set through the same attribute bag as merged classes.
