---
name: typo3
description: >-
  TYPO3 project conventions. Use when working on TYPO3 extensions, Fluid/HTML
  templates, XLF locallang files, or PHP in TYPO3 projects. Includes the
  extbase subskill for Domain models. PHP and HTML style follow the php and
  html skills.
---

# TYPO3

PHP style: follow [php](../php/SKILL.md).
HTML / Fluid markup: follow [html](../html/SKILL.md).
Extbase Domain models / QueryBuilder: follow [extbase](extbase/SKILL.md).

## XLF

- XLF: sort by id the translations

## Agents

Consumer `AGENTS.md`:

```markdown
PHP style: follow the [php](vendor/nauten/agent-skills/skills/php/SKILL.md) skill.
HTML: follow the [html](vendor/nauten/agent-skills/skills/html/SKILL.md) skill.
TYPO3: follow the [typo3](vendor/nauten/agent-skills/skills/typo3/SKILL.md) skill.
```

Install: `composer require --dev nauten/agent-skills`
