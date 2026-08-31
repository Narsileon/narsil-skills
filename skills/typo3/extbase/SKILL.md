---
name: extbase
description: >-
  TYPO3 Extbase Domain models and QueryBuilder conventions. Use when creating or
  editing Extbase models, repositories, or when the user mentions model TABLE
  constants. PHP style follows the php skill; included by the typo3 skill.
---

# Extbase

PHP style: follow [php](../../php/SKILL.md).

Copy [templates/](templates/) into the target project when scaffolding Extbase models. The stub is the contract — match its `#region` names, PHPDoc, brace style, and sort order. Never write empty regions (see [php](../../php/SKILL.md)).

| Artifact | Template | Regions |
| -------- | -------- | ------- |
| Extbase model | [model.stub](templates/model.stub) | `USE` → `CONSTANTS` → `PROPERTIES` → `PUBLIC METHODS` |

Use [class.stub](../../php/templates/class.stub) for services, utilities, commands, and similar `final` classes.

## Model

- `TABLE` as `public final const` in `CONSTANTS` (first constant). PHPDoc: `@var string` only (skill style). Value = DB table name (`tx_<extkey>_domain_model_<name>`).
- Omit `final` on the constant only when a subclass must override it.
- Extbase still maps the table via naming convention; `TABLE` is for **code** (QueryBuilder, commands), not a replacement for TCA/`ext_tables.sql`.
- Define constants for extension database column names as well as the table name, and use those constants in QueryBuilder calls. TYPO3 core table/column identifiers may remain literals when no project model or table class owns them.

## QueryBuilder

- Never hardcode extension table names as string literals in PHP.
- Use `Model::TABLE` with `ConnectionPool` / `QueryBuilder` (`getConnectionForTable`, `from`, `update`, `join`, `tablenames`, …).
- TYPO3 core tables (`pages`, `tt_content`, `sys_file`, `sys_file_reference`, …) may stay as string literals.
- Extbase repository APIs (`findAll()`, `findByUid()`, `$this->createQuery()`) do not need `TABLE`.

```php
$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
    ->getConnectionForTable(Example::TABLE)
    ->createQueryBuilder();

$queryBuilder->select('uid', 'title')->from(Example::TABLE);
```
