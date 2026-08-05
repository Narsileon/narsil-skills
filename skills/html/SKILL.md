---
name: html
description: >-
  HTML and markup spacing and attribute order. Use when editing HTML, Fluid,
  Blade, or JSX markup, or when React/TYPO3 skills import this skill.
---

# HTML

Applies to HTML, Fluid, Blade, and JSX markup.

## Spacing

- No empty lines between adjacent tags when nothing sits between them (opening→opening, opening→closing, closing→closing). Keep markup tight; blank lines only when separating meaningful blocks of content or sections.

Bad — blank line between tags (examples use `text` fences so formatters do not collapse them):

```text
<form>

  <div></div>

</form>
```

Good:

```text
<form>
  <div></div>
</form>
```

## Attribute order

On elements, sort attributes in this order:

1. `data-*` (e.g. `data-slot`)
2. `class` (Blade: `$attributes->twMerge(…)` when that expression owns the class merge)
3. Rest — other attributes alphabetically, then attribute bag if any

```html
<button
  data-slot="button"
  class="inline-flex"
  type="button"
>
```

```blade
<button data-slot="button" {{ $attributes->twMerge($class) }} type="button">
```

JSX maps `class` → `className` and adds `ref` first / `key` last — see [react](../react/SKILL.md).
