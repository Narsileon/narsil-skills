---
name: eslint
description: >-
  ESLint flat config for TypeScript/React projects. Enforces import sort,
  explicit object keys, unused imports, TypeScript key sorting, and Prettier
  compatibility. Use when setting up linting, editing eslint.config, or when
  the user mentions simple-import-sort, perfectionist, lint scripts, or
  aligning ESLint with team style.
---

# ESLint

Enforces the [react](../react/SKILL.md) skill in the editor and CI. Every React/TypeScript project uses the **same shared rules** below, plus stack-specific presets (Next.js, Vite, Astro).

Use ESLint flat config (`eslint.config.mjs` or `eslint.config.js`). File name is project-specific; the rule set is not.

## Shared rules (required in every project)

These rules mirror the React skill. Copy this block into every `eslint.config` — do not drop or relax rules per repo.

```js
// One inner array = no blank lines between import groups (plugin default uses five).
const simpleImportSortGroups = [['^\\u0000', '^node:', '^@?\\w', '^', '^\\.']];

const sharedRules = {
  curly: ['error', 'all'],
  'object-shorthand': ['error', 'never'],
  'simple-import-sort/imports': ['error', { groups: simpleImportSortGroups }],
  'simple-import-sort/exports': 'error',
  'perfectionist/sort-interfaces': 'error',
  'perfectionist/sort-enums': [
    'error',
    {
      useConfigurationIf: {
        matchesAstSelector: `TSEnumDeclaration:not(:has(TSEnumMember:not([initializer.raw=/^[\"']/])))`,
      },
      type: 'alphabetical',
    },
    { type: 'unsorted' },
  ],
  'no-console': ['warn', { allow: ['info', 'warn', 'error'] }],
  camelcase: 'off',
  'no-unused-vars': 'off',
  'unused-imports/no-unused-imports': 'error',
  'unused-imports/no-unused-vars': [
    'error',
    {
      args: 'after-used',
      argsIgnorePattern: '^_',
      caughtErrors: 'all',
      caughtErrorsIgnorePattern: '^(_|ignore)',
      vars: 'all',
      varsIgnorePattern: '^_',
    },
  ],
};
```

React/JSX files also need:

```js
'react/jsx-boolean-value': ['error', 'always'],
'react/prop-types': 'off',
```

TypeScript files — turn off overlapping core/TS unused-vars rules:

```js
'@typescript-eslint/no-unused-vars': 'off',
'no-unused-vars': 'off',
```

| Rule | Value | React skill |
| ---- | ----- | ----------- |
| `simple-import-sort/imports` | single group, no blank lines | Import sort order |
| `simple-import-sort/exports` | `error` | Barrel exports |
| `object-shorthand` | `never` | Explicit keys in objects and JSX props |
| `curly` | `all` | Braces on all control flow |
| `react/jsx-boolean-value` | `always` | `disabled={true}` not bare `disabled` |
| `unused-imports/no-unused-imports` | `error` | Clean imports |
| `perfectionist/sort-interfaces` | `error` | Sorted interface keys |
| `perfectionist/sort-enums` | `error` | Alphabetical string enums; preserve explicit order for other enums |
| `eslint-config-prettier` | last preset before custom rules | Prettier owns formatting |

Register plugins `simple-import-sort`, `unused-imports`, and `perfectionist` in the flat-config block that spreads `sharedRules`. Use `perfectionist/sort-interfaces` and `perfectionist/sort-enums` instead of the older `eslint-plugin-typescript-sort-keys` rules.

Finer import ordering (`@inertiajs`, `@ui`, `react`, `./` siblings) is documented in the react skill; `simple-import-sort` sorts within the `@?\\w` bucket alphabetically. Run the project's lint-fix script after edits.

## Packages (install in every project)

Core plugins — required regardless of framework:

```bash
pnpm add -D eslint eslint-config-prettier \
  eslint-plugin-simple-import-sort eslint-plugin-perfectionist \
  eslint-plugin-unused-imports
```

## Flat config shape

Apply configs in this order:

1. `globalIgnores([...])` — build output, `node_modules`, generated types, env files
2. Framework presets (Next.js, `typescript-eslint`, React, Astro, …)
3. `eslint-config-prettier` (flat: `eslint-config-prettier/flat`)
4. Custom block: register the three plugins + spread `sharedRules` (+ React rules on `**/*.{jsx,tsx}`)

Typical ignores: `.next/**`, `dist/**`, `node_modules/**`, `**/*.d.ts`, `public/**`, and any generated `*-types.ts` / `importMap.js` in the project.

## Next.js

Additional packages:

```bash
pnpm add -D eslint-config-next
```

Import `defineConfig` and `globalIgnores` from `eslint/config`; spread `eslint-config-next/core-web-vitals` and `eslint-config-next/typescript`; then add `eslint-config-prettier/flat`, followed by a custom block that registers `react`, `simple-import-sort`, `unused-imports`, and `perfectionist` and applies `sharedRules`. Set `settings.react.version` to `"detect"`. Typical ignores include `.next/**`, `.next-*/**`, `dist/**`, `node_modules/**`, `public/**`, generated types, and `vendor/**`. Optional: `eslint-plugin-cypress` + `cypress.configs.globals` when using Cypress.

## Vite + React (Inertia, SPA, UI package)

Additional packages:

```bash
pnpm add -D @eslint/js typescript-eslint globals \
  eslint-plugin-react eslint-plugin-react-hooks eslint-plugin-jsx-a11y
```

Presets: `@eslint/js` recommended, `typescript-eslint` recommended, prettier, then React / React Hooks / jsx-a11y flat configs on `**/*.{jsx,tsx}`, then the shared-rules block. Set `settings.react.version` to `"detect"`. Use `projectService: true` and `tsconfigRootDir: import.meta.dirname` only when enabling type-aware rules.

## Astro

Additional package:

```bash
pnpm add -D eslint-plugin-astro
```

Use the Vite + React setup, then spread `eslintPluginAstro.configs['flat/recommended']`. Ignore `.astro/**` build output. Apply `sharedRules` on `**/*.{ts,astro}` as well as React files.

## Scripts

Add to `package.json`:

```json
{
  "scripts": {
    "lint": "eslint . --max-warnings 0 --report-unused-disable-directives",
    "lint:fix": "eslint . --fix --max-warnings 0 --report-unused-disable-directives"
  }
}
```

## VS Code

```json
{
  "editor.formatOnSave": true,
  "editor.defaultFormatter": "esbenp.prettier-vscode",
  "eslint.useFlatConfig": true,
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": "explicit"
  }
}
```

Prettier formats; ESLint fixes import sort and style rules on save. Do not use Prettier `organizeImports` when `simple-import-sort` is enabled.

## CI

```bash
yarn lint
```

Use `--max-warnings 0` — zero warnings in CI.

## Existing configs

When a project already has ESLint, **merge** the shared packages, plugins, and `sharedRules` into its flat config. Keep framework-specific presets; add anything missing from the shared block. Do not remove team rules to match a minimal template.
