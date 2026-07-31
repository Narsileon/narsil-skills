---
name: html
description: >-
  HTML and markup spacing conventions. Use when editing HTML, Fluid, Blade, or
  JSX markup, or when React/TYPO3 skills import this skill.
---

# HTML

Applies to HTML, Fluid, Blade, and JSX markup.

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
