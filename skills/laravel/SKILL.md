---
name: laravel
description: >-
  Laravel PHP style for service classes, Eloquent models, and migrations. Use
  when creating or editing PHP in app/, database/migrations/, seeders, or when
  the user mentions PHP regions, model TABLE constants, or migration stubs.
---

# Laravel

Read templates from [templates/](templates/) in this folder. Generated code goes in `app/`, `database/migrations/`, etc.

| Artifact | Template | Example |
| -------- | -------- | ------- |
| Service class | [templates/class.stub](templates/class.stub) | `UserService` — `USE` → `CONSTRUCTOR` → `CONSTANTS` → `PROPERTIES` → `PUBLIC METHODS` → `PRIVATE METHODS` |
| Eloquent model | [templates/model.stub](templates/model.stub) | `User` with `posts` `HasMany` |
| Migration | [templates/migration.stub](templates/migration.stub) | `posts` table with `foreignId` → `User::TABLE` |

## Service class

- `final` when the class is not extended; `abstract` for shared base services.
- No constructor property promotion — inject dependencies via constructor only when needed.
- Constants in `CONSTANTS` only; each with description + `@var`.
- Properties in `PROPERTIES` only when used; each with `@var`; assign in constructor or methods.
- PHPDoc: `boolean`, `integer`, `double` (not `bool`, `int`, `float`). Constructors: `@param` + `@return void`. Methods: `@param` / `@return` only; blank line before `@return` when `@param` exists.
- Opening brace on its own line after `if`, `foreach`, closures.
- Methods in `PUBLIC METHODS` and `PRIVATE METHODS` are sorted alphabetically by method name (case-sensitive). `__construct` stays in `CONSTRUCTOR`; migration `down()` still precedes `up()` in `PUBLIC METHODS`.
- Query code uses model constants — `User::EMAIL`, never `'email'`.

## Eloquent model

- `TABLE` and every column/relation as `public final const` in `CONSTANTS`.
- Group constants with nested regions: `#region • COLUMNS`, `#region • RELATIONS` inside `CONSTANTS`.
- Constructor: `$this->table = self::TABLE` (or `static::TABLE` when abstract); set `$this->primaryKey`, `$this->guarded`, `$this->translatable` in constructor when needed.
- Constant PHPDoc: description + `@var string`.
- Query and relationship code uses model constants only — `Model::COLUMN`, `Model::RELATION_*`, `Post::USER_ID` — never raw strings.
- Related models (e.g. `Post` for `User::posts()`) follow the same constant pattern in their own model class.
- Methods in `RELATIONSHIPS`, `SCOPES`, and `PUBLIC METHODS` are sorted alphabetically by method name.

## Migration

- Import every model referenced; use `Model::TABLE` and column constants everywhere.
- `#region USE` before `return new class extends Migration`.
- `down()` before `up()`; `down()` → `Schema::dropIfExists(Model::TABLE)`.
- `up()` guards `Schema::hasTable(Model::TABLE)`, delegates to private `create*Table()`.
- Closure param `$blueprint`; one column per `$blueprint` statement; `{` on its own line.
- Foreign keys: `Post::USER_ID` + `->constrained(User::TABLE)` — never hard-code `user_id` or `users`.
- `@return void` on `up()`, `down()`, and private table methods.
- Private migration helpers in `PRIVATE METHODS` are sorted alphabetically by method name.

## Install in a project

```bash
composer require --dev nauten/agent-skills
```

In `AGENTS.md`:

```markdown
PHP style: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.
```
