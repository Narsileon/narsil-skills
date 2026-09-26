# Commands

Run commands from the consumer project root unless a section says otherwise.

## PHP checks

Run all PHP checks for the current project, or pass one or more files or directories:

```bash
vendor/narsil/skills/scripts/php/check
vendor/narsil/skills/scripts/php/check src
```

The full check runs Pint for syntax and formatting, then the Narsil-specific checks. Run an individual check against a PHP file or directory:

```bash
vendor/narsil/skills/scripts/php/checks/check-phpdoc app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-style app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-method-return app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-region-order app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-region-hierarchy app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-method-order app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-enum-regions app/Enums/UserRole.php
```

## PHP fixes

Run all PHP fixes for the current project, or pass one or more files or directories. Review the changes, then run checks again:

```bash
vendor/narsil/skills/scripts/php/fix app/Domain/Model
```

Run an individual fixer against a PHP file or directory:

```bash
vendor/narsil/skills/scripts/php/fixes/fix-arrow-functions app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-phpdoc app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-region-hierarchy app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-regions app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-member-order app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-method-order app/Models/User.php
```

The fix pipeline converts arrow functions, repairs PHPDoc and region hierarchy, orders regions, members, and methods, then runs Pint.
