---
name: laravel
description: >-
  Laravel PHP style for Eloquent models and migrations. Use when creating or
  editing PHP in database/migrations/, seeders, Eloquent models, or when the
  user mentions model TABLE constants or migration stubs. For general PHP
  classes, follow the php skill first.
---

# Laravel

PHP class style: follow [php](../php/SKILL.md) first — regions, PHPDoc, brace style, and [class.stub](../php/templates/class.stub).

Copy [templates/](templates/) into the target project. The stub is the contract — match its `#region` markers, PHPDoc, brace style, and sort order.

| Artifact | Template | Regions |
| -------- | -------- | ------- |
| Model | [model.stub](templates/model.stub) | `USE` → `CONSTRUCTOR` → `CONSTANTS` → `RELATIONSHIPS` |
| Migration | [migration.stub](templates/migration.stub) | `USE` → `PUBLIC METHODS` → `PRIVATE METHODS` |

Use [class.stub](../php/templates/class.stub) for `final` classes in `app/Helpers/`, `app/Services/`, and similar.

Blade View Components (`app/View/Components/` + `.blade.php`): follow [blade](../blade/SKILL.md) (imports `php`, `html`, `tailwind`).

## Laravel class additions

- Helpers: singleton in container + `final` facade in `app/Facades/` — no `app('…')`.
- Queries: `User::EMAIL`, never `'email'`.

## Model

- `TABLE` + columns/relations as `public final const` in `CONSTANTS` (`TABLE` first; nested `#region • COLUMNS` / `• RELATIONS`, alphabetical inside each). Omit `final` on a constant only when a subclass must override it.
- Always PHPDoc on model constants: standard description + `@var string` (e.g. `The name of the "email" column.`) — columns are conventionally commented this way (see [model.stub](templates/model.stub)).
- `$this->table = self::TABLE` in constructor; constants only in queries/relations.

## Migration

- `#region USE` before `return new class extends Migration`.
- `down()` before `up()`; `down()` drops `Model::TABLE`; `up()` guards `hasTable`, delegates to private `create*Table()`.
- One column per `$blueprint` line; `{` on its own line; FKs via column + `User::TABLE` constants.

## Agents

**Do not run Laravel Pint** on skill-styled PHP (`app/Helpers/`, `app/View/Components/`, etc.) — it rewrites `#region`, strips private PHPDoc, and changes braces. If Pint already ran, restore from the stub.
