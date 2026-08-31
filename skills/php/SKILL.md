---
name: php
description: >-
  PHP style for service classes, enums, and similar artifacts. Use when creating
  or editing PHP classes or enums, when the user mentions PHP regions, PHPDoc,
  brace style, or class/enum stubs.
---

# PHP

Copy templates into the target project. The stub is the contract — match its `#region` names, PHPDoc, brace style, and sort order. Region lists below are order when present, not a checklist of empty shells.

| Artifact                                      | Template                           | Regions                                                                                   |
| --------------------------------------------- | ---------------------------------- | ----------------------------------------------------------------------------------------- |
| Class (service, helper, component, widget, …) | [class.stub](templates/class.stub) | `USE` → `CONSTRUCTOR` → `CONSTANTS` → `PROPERTIES` → `PUBLIC METHODS` → `PROTECTED METHODS` → `PRIVATE METHODS` |
| Enum (backed string/int)                      | [enum.stub](templates/enum.stub)   | `USE` (if needed) → `CASES` → methods regions as needed                                   |

## Class

- Every PHP file starts with `<?php` then `declare(strict_types=1);` (blank line after each).
- `final` (or `abstract` base).
- No constructor property promotion — never declare properties on `__construct` parameters (e.g. `__construct(private CacheRepository $cache)`). Declare every property in `PROPERTIES` (typed + `@var`), then assign in `__construct` with `$this->property = $value`.
- `final` on `public` / `protected` constants by default (`public final const`, `protected final const`) — even when the class is `final`; omit only when a subclass must override the constant. **Never `private final const`** — PHP fatal: private constants cannot be `final` (use `private const` only).
- Never mark `private` methods or properties `final` — they are not visible to subclasses (`private final` on methods warns; on properties/constants is invalid). Do not copy Java’s `private final` field pattern.
- Do not mark methods `final` when the class is already `final` (redundant). Use `final` on methods only for `public` / `protected` methods on a non-`final` class that must not be overridden.
- `#region` / `#endregion` only — never `// region`.
- **Never write an empty region** — omit `#region` / `#endregion` entirely when that section has no members (no empty `CONSTRUCTOR`, `CONSTANTS`, `PROPERTIES`, `PRIVATE METHODS`, or `USE`). Only emit a region that contains at least one `use`, constant, property, or method. Keep relative order from the table above for regions that do exist.
- `use` statements sorted alphabetically in the `USE` region.
- Constants, properties, and methods sorted alphabetically within each region (`__construct` in `CONSTRUCTOR`).
- Use constants for database table and column names. Never hardcode database identifiers as string literals in application queries, relationships, repositories, or migrations; define a descriptive constant on the relevant model or table class first.
- Use named arguments for calls with multiple arguments when the called function or method has at least one optional parameter, especially when skipping optional parameters or when the argument meaning is unclear. Sort named arguments alphabetically by parameter name.
- Associative arrays in `return` / response payloads sorted alphabetically by key.
- PHPDoc: `boolean`, `integer`, `double`; `string[]` not `list<string>`; `array<string,mixed>` for maps (no space after `,` — VS Code resolves generics better). Every method gets `@param` / `@return` (including `private`). Properties/constants: `@var` only. Avoid prose summaries (e.g. `Language column keys matching the TCA fields.`) — not forbidden, but methods and vars should already be self-descriptive.
- **Constructors always get PHPDoc** — prefer `{@inheritDoc}` when overriding a parent constructor that already has PHPDoc (see [model.stub](../laravel/templates/model.stub)). Otherwise document every `@param` (match the parent’s native types when overriding, e.g. `Store $store`) and always `@return void`, even if the body only calls `parent::__construct(…)`. See [class.stub](templates/class.stub).
- **When modifying a function, re-check types that are already written** — native parameter/return types and existing `@param` / `@return` / `@var`. Verify they still match the implementation after your change (e.g. do not keep `@return string|View` if the method now only returns a `View`). Do not invent looser unions “just in case”; narrow or update types to what the code actually returns/accepts. Prefer keeping accurate existing types over dropping them during a reformat.
- Overrides in inherited code: if the parent already has PHPDoc, use only `{@inheritDoc}` — do not restate `@param` / `@return`. Use `{@inheritDoc}` only when the parent PHPDoc exists; otherwise write full PHPDoc. Match the parent's native parameter/return types — do not leave overrides as `mixed`/`$args` when the parent declares a concrete type. Do not add types the parent left untyped, unless you are also correcting an inaccurate documented type to match the real implementation (see above).
- `{` on its own line after `if`, `foreach`, closures. Always braces — never `if ($lang === 'zh') return $this->getZh();`. Prefer `match` or `switch` when branching on one value fits better. No empty line right after `{` or right before `}`.
- Blank line **before** a control structure (`if`, `else if`, `foreach`, `for`, `while`, `switch`, `try`) when it follows a statement (e.g. assignment/`return` prep). No blank line when it immediately follows `{`, `else`, or `else if {`. Example: `$ids = [];` then blank line then `foreach (...)`.
- Import every type with `use` in the `USE` region
- No arrow functions (`fn () =>`); use named methods or `function () { … }` closures.
- No ternary (`$x ? $y : $z`); use `if` / `else` blocks — easier to breakpoint while debugging.
- No space after unary `!` (or `@`, `~`, `++`, `--`): `!is_array($value)`, never `! is_array($value)`.
- Name variables clearly — never `$e`, `$ex`, `$err`, `$i`, `$j`, `$k`. Prefer `$exception`, `$error`, `$throwable`, `$index`, `$key`, etc.

## Enum

- Backed enums (`string` / `integer`) unless a pure unit enum is clearly better.
- Cases in a `CASES` region, sorted alphabetically; each case has `@var` PHPDoc matching the backing type.
- No blank line between cases — only the PHPDoc block directly above each `case` (see [enum.stub](templates/enum.stub)).
- Methods (if any) follow the same region/PHPDoc/brace rules as classes; keep cases before methods.

## Validation

After creating or editing PHP classes, run `vendor/narsil/skills/scripts/php/check` from the project root. It validates PHP syntax, regions, and mechanically verifiable PHP rules, including PHPDoc on every method, property, constant, and enum case. Methods with parameters require one `@param` per parameter, `@return` (including `@return void`), and a blank line between the `@param` block and `@return`. Docblocks must be multiline; inherited methods may use `{@inheritDoc}`. The check then confirms Composer/autoload still resolves. Fix every failure before finishing.
