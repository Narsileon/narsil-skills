---
name: laravel
description: >-
  Laravel PHP style for service classes, Eloquent models, and migrations. Use
  when creating or editing PHP in app/, database/migrations/, seeders, or when
  the user mentions PHP regions, model TABLE constants, or migration stubs.
---

# Laravel

Copy [templates/](templates/) into the target project. The stub is the contract — match its `#region` markers, PHPDoc, brace style, and sort order.

| Artifact | Template | Regions |
| -------- | -------- | ------- |
| Class (service, helper, component) | [class.stub](templates/class.stub) | `USE` → `CONSTRUCTOR` → `CONSTANTS` → `PROPERTIES` → `PUBLIC METHODS` → `PRIVATE METHODS` |
| Model | [model.stub](templates/model.stub) | `USE` → `CONSTRUCTOR` → `CONSTANTS` → `RELATIONSHIPS` |
| Migration | [migration.stub](templates/migration.stub) | `USE` → `PUBLIC METHODS` → `PRIVATE METHODS` |

Use `class.stub` for `final` classes in `app/Helpers/`, `app/Services/`, `app/View/Components/`, and similar.

## Class

- `final` (or `abstract` base); no constructor property promotion.
- `#region` / `#endregion` only — never `// region`.
- Constants, properties, and methods sorted alphabetically within each region (`down()` before `up()` in migrations; `__construct` in `CONSTRUCTOR`).
- PHPDoc: `boolean`, `integer`, `double`; `string[]` not `list<string>`; `array<string, string>` for maps. Every method gets `@param` / `@return` (including `private`). Constructor: all `@param` + `@return void`.
- `{` on its own line after `if`, `foreach`, closures.
- Helpers: singleton in container + `final` facade in `app/Facades/` — no `app('…')`.
- Queries: `User::EMAIL`, never `'email'`.

## Model

- `TABLE` + columns/relations as `public final const` in `CONSTANTS` (`TABLE` first; nested `#region • COLUMNS` / `• RELATIONS`, alphabetical inside each).
- `$this->table = self::TABLE` in constructor; constants only in queries/relations.

## Migration

- `#region USE` before `return new class extends Migration`.
- `down()` before `up()`; `down()` drops `Model::TABLE`; `up()` guards `hasTable`, delegates to private `create*Table()`.
- One column per `$blueprint` line; `{` on its own line; FKs via column + `User::TABLE` constants.

## Agents

**Do not run Laravel Pint** on skill-styled PHP (`app/Helpers/`, `app/View/Components/`, etc.) — it rewrites `#region`, strips private PHPDoc, and changes braces. If Pint already ran, restore from the stub.

Consumer `AGENTS.md`: one link only — `PHP style: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.`

Install: `composer require --dev nauten/agent-skills`
