---
name: tailwind
description: >-
  Tailwind CSS class conventions — prefer canonical theme scale tokens over
  arbitrary values. Use when writing or editing Tailwind classes in Blade,
  React/TSX, HTML, or CSS, or when the user mentions arbitrary values,
  z-[…], w-[…px], or class tokens.
---

# Tailwind

Prefer canonical theme scale classes over arbitrary values (`[…]`).

Examples: `z-1` not `z-[1]`, `w-1` not `w-[4px]`, `p-4` not `p-[16px]`.

Use `[…]` only when no scale token matches.

## Merge helpers

- **Blade / PHP:** `twMerge()` via [gehrisandro/tailwind-merge-laravel](https://github.com/gehrisandro/tailwind-merge-laravel) — see [blade](../blade/SKILL.md).
- **React / TS:** project `cn()` (typically `clsx` + `tailwind-merge`) — see [react](../react/SKILL.md).
