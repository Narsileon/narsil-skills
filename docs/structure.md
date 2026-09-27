# Structure

Narsil Skills provides reusable agent guidance and PHP tooling for Narsil projects.

```text
.  # Narsil Skills root
├── docs/  # Documentation
│   ├── commands/  # Command documentation
│   │   ├── index.md  # Command index
│   │   ├── php.md  # PHP check and fix commands
│   │   └── pint.md  # PHP formatting commands
│   ├── index.md  # Documentation index
│   └── structure.md  # Root structure reference
├── scripts/  # Development scripts
│   └── php/  # PHP tooling
│       ├── checks/  # PHP code checks
│       ├── files.php  # Shared PHP file discovery
│       └── fixes/  # PHP code fixers
├── skills/  # Portable agent skills
│   ├── blade/  # Blade skill
│   │   └── templates/  # Blade templates
│   ├── docs/  # Documentation skill
│   ├── eslint/  # ESLint skill
│   ├── general/  # General development skill
│   ├── html/  # HTML skill
│   ├── laravel/  # Laravel skill
│   │   └── templates/  # Laravel templates
│   ├── php/  # PHP skill
│   │   └── templates/  # PHP templates
│   ├── react/  # React skill
│   │   └── templates/  # React templates
│   ├── tailwind/  # Tailwind skill
│   └── typo3/  # TYPO3 skill
│       └── extbase/  # TYPO3 Extbase skill
│           └── templates/  # Extbase templates
└── src/  # PHP source
    └── Enums/  # PHP enums
```
