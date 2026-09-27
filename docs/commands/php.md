# PHP

Check and fix PHP files with the Narsil Skills scripts. Run commands from the project root.

Directory scans skip `.ddev/`, `.git/`, `bootstrap/cache/`, `node_modules/`, `public/build/`, `storage/`, and `vendor/`.

## Check

Check all PHP files, or pass a PHP file or directory:

```sh
vendor/narsil/skills/scripts/php/check
vendor/narsil/skills/scripts/php/check app/Models/User.php
vendor/narsil/skills/scripts/php/check src
```

Run an individual check against a PHP file or directory:

```sh
vendor/narsil/skills/scripts/php/checks/check-phpdoc app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-style app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-method-return app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-region-order app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-region-hierarchy app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-method-order app/Models/User.php
vendor/narsil/skills/scripts/php/checks/check-enum-regions app/Enums/UserRole.php
```

## Fix

Fix all PHP files, or pass a PHP file or directory:

```sh
vendor/narsil/skills/scripts/php/fix app/Models/User.php
vendor/narsil/skills/scripts/php/fix app/Domain/Model
```

Run an individual fixer against a PHP file or directory:

```sh
vendor/narsil/skills/scripts/php/fixes/fix-arrow-functions app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-phpdoc app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-region-hierarchy app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-regions app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-member-order app/Models/User.php
vendor/narsil/skills/scripts/php/fixes/fix-method-order app/Models/User.php
```
