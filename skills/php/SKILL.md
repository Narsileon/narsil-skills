---
name: php
description: >-
  PHP style for service classes and similar artifacts. Use when creating or
  editing PHP classes, when the user mentions PHP regions, PHPDoc, brace style,
  or class stubs.
---

# PHP

Copy [templates/class.stub](templates/class.stub) into the target project. The stub is the contract — match its `#region` markers, PHPDoc, brace style, and sort order.

| Artifact | Template | Regions |
| -------- | -------- | ------- |
| Class (service, helper, component) | [class.stub](templates/class.stub) | `USE` → `CONSTRUCTOR` → `CONSTANTS` → `PROPERTIES` → `PUBLIC METHODS` → `PRIVATE METHODS` |

## Class

- `final` (or `abstract` base).
- No constructor property promotion — never declare properties on `__construct` parameters (e.g. `__construct(private CacheRepository $cache)`). Declare every property in `PROPERTIES` (typed + `@var`), then assign in `__construct` with `$this->property = $value`.
- `final` on constants by default (`private final const`, `public final const`) — even when the class is `final`; omit only when a subclass must override the constant.
- Do not mark methods `final` when the class is already `final` (redundant).
- `#region` / `#endregion` only — never `// region`.
- Constants, properties, and methods sorted alphabetically within each region (`__construct` in `CONSTRUCTOR`).
- PHPDoc: `boolean`, `integer`, `double`; `string[]` not `list<string>`; `array<string,mixed>` for maps (no space after `,` — VS Code resolves generics better). Every method gets `@param` / `@return` (including `private`). Constructor: all `@param` + `@return void`. Properties/constants: `@var` only. Avoid prose summaries (e.g. `Language column keys matching the TCA fields.`) — not forbidden, but methods and vars should already be self-descriptive.
- Overrides (Laravel, TYPO3, etc.): if the parent already has PHPDoc, use only `{@inheritDoc}` — do not restate `@param` / `@return`. Use `{@inheritDoc}` only when the parent PHPDoc exists; otherwise write full PHPDoc. Match the parent's native parameter/return types — do not add types the parent left untyped.
- `{` on its own line after `if`, `foreach`, closures. Always braces — never `if ($lang === 'zh') return $this->getZh();`. Prefer `match` or `switch` when branching on one value fits better.
- Import every type with `use` in the `USE` region — never inline FQCNs (e.g. `\TYPO3\CMS\Extbase\Persistence\QueryInterface`).
- No arrow functions (`fn () =>`); use named methods or `function () { … }` closures.
- No ternary (`$x ? $y : $z`); use `if` / `else` blocks — easier to breakpoint while debugging.
- Name variables clearly — never `$e`, `$ex`, `$err`, `$i`, `$j`, `$k`. Prefer `$exception`, `$error`, `$throwable`, `$index`, `$key`, etc.

Consumer `AGENTS.md`: `PHP style: follow the [php](vendor/nauten/agent-skills/skills/php/SKILL.md) skill.`

Install: `composer require --dev nauten/agent-skills`
