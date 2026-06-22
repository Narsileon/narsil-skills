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
| Service / helper class | [templates/class.stub](templates/class.stub) | `UserService`, `TailwindHelper` — `USE` → `CONSTRUCTOR` → `CONSTANTS` → `PROPERTIES` → `PUBLIC METHODS` → `PRIVATE METHODS` |
| Eloquent model | [templates/model.stub](templates/model.stub) | `User` with `posts` `HasMany` |
| Migration | [templates/migration.stub](templates/migration.stub) | `posts` table with `foreignId` → `User::TABLE` |

Apply `class.stub` to any `final` class under `app/Helpers/`, `app/Services/`, `app/View/Components/`, and comparable `app/` code.

## Service class

- `final` when the class is not extended; `abstract` for shared base services.
- Copy structure from [templates/class.stub](templates/class.stub) — regions, PHPDoc, and brace style are part of the contract.
- Region markers: `#region USE`, `#region CONSTRUCTOR`, …, `#endregion` — **never** `// region` (IDE folding + Pint rewrites these; see Tooling).
- No constructor property promotion — inject dependencies via constructor only when needed.
- Constants in `CONSTANTS` only; each with description + `@var`.
- Constants in `CONSTANTS` are sorted alphabetically by constant name (case-sensitive). Associative array values keep ordinal key order when keys are a fixed scale (e.g. `1`–`6`); otherwise sort entries by key.
- Properties in `PROPERTIES` only when used; each with description + `@var`; assign in constructor or methods. Properties are sorted alphabetically by property name.
- PHPDoc: `boolean`, `integer`, `double` (not `bool`, `int`, `float`). Array types: `string[]`, `integer[]` for sequential arrays — not `list<string>` or `array<int, string>`. Associative arrays: `array<string, string>`. Constructors: `@param` + `@return void`. Methods: `@param` / `@return` only; blank line before `@return` when `@param` exists.
- **Every** method in `PUBLIC METHODS` and `PRIVATE METHODS` gets PHPDoc (`@param`, `@return`) — including `private` methods with native types. Match [templates/class.stub](templates/class.stub); do not strip tags because PHP types are obvious.
- Opening brace on its own line after `if`, `foreach`, closures, and before the constructor/method body closing pattern in `class.stub`.
- Methods in `PUBLIC METHODS` and `PRIVATE METHODS` are sorted alphabetically by method name (case-sensitive). `__construct` stays in `CONSTRUCTOR`; migration `down()` still precedes `up()` in `PUBLIC METHODS`.
- Helpers in `app/Helpers/`: register as container singletons; expose via a `final` facade in `app/Facades/` (e.g. `Tailwind::merge()`). Do not call `app('helperName')` from application code.
- Query code uses model constants — `User::EMAIL`, never `'email'`.

## Tooling (agents)

Laravel Pint **breaks** this style. After creating or editing skill-styled PHP, **do not run Pint** on those files or on `app/Helpers/`, `app/View/Components/`, or other paths using `class.stub` — even when the consumer project has no `pint.json` exclude.

| Pint behaviour | Keep per skill |
| -------------- | -------------- |
| Comment style | `#region` / `#endregion` |
| `no_superfluous_phpdoc_tags` | Full `@param` / `@return` on all methods, including `private` |
| Brace position | `{` on its own line after `if`, `foreach`, etc. |

If Pint was run and regions became `// region` or private PHPDoc disappeared, restore from `class.stub` — do not treat Pint output as the source of truth.

Consumer projects need **no** extra `AGENTS.md` rules or `pint.json` entries for this; this skill is the single source of truth.

## Eloquent model

- `TABLE` and every column/relation as `public final const` in `CONSTANTS`.
- Group constants with nested regions: `#region • COLUMNS`, `#region • RELATIONS` inside `CONSTANTS`.
- `TABLE` stays first in `CONSTANTS`, before nested regions; constants inside each nested region are sorted alphabetically by name.
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

In the consumer `AGENTS.md`, one line only — no per-project style duplication:

```markdown
PHP style: follow the [laravel](vendor/nauten/agent-skills/skills/laravel/SKILL.md) skill.
```
