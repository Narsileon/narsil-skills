---
name: react
description: >-
  React/TypeScript style for components, hooks, stores, and types. Use when
  creating or editing .tsx/.ts in resources/js/, when the user mentions import
  order, JSX prop order, path aliases, kebab-case file names, object types,
  component templates, or ESLint setup. JSX markup follows the html skill.
---

# React

HTML / JSX markup: follow [html](../html/SKILL.md).

Read templates from [templates/](templates/) in this folder. Generated code goes in `resources/js/` (or package `resources/js/`).

| Artifact  | Template                                                               | Notes                                  |
| --------- | ---------------------------------------------------------------------- | -------------------------------------- |
| Component | [templates/component.stub](templates/component.stub)                   | `Button` — default export; `function` declaration |
| Variants  | [templates/component-variants.stub](templates/component-variants.stub) | `buttonVariants` — CVA + `VariantProps` |
| Barrel    | [templates/component-index.stub](templates/component-index.stub)       | `Button` barrel — named exports + `export type` |
| Page      | [templates/page.stub](templates/page.stub)                             | `UsersIndex` — Inertia page |
| Hook      | [templates/hook.stub](templates/hook.stub)                             | `useFetchForm` — default export |
| Store     | [templates/store.stub](templates/store.stub)                           | `useCartStore` — Zustand |
| Types     | [templates/types.stub](templates/types.stub)                           | Shared `type` definitions              |

## Imports

**Never use parent-relative imports** (`../`, `../../`). Use path aliases (`@ui/…`, `@/…`) for anything outside the current folder.

`./` is allowed only for siblings in the same directory (e.g. `./button-variants`).

### Sort order (top to bottom)

1. `@inertiajs/*`
2. `@dnd-kit/*` (when used)
3. Package aliases — alphabetically (`@ui/*`, then `@/*`, then other project aliases)
4. Other npm packages — alphabetically (`@base-ui/*`, `@tanstack/*`, `class-variance-authority`, `lodash-es`, `ziggy-js`, …)
5. `react` (type imports inline: `import { useState, type ComponentProps } from "react"`)
6. Same-folder `./` siblings (implementation files only; barrel `index.ts` lists locals last)

Within a multiline import, sort bindings alphabetically. Use trailing commas. Prefer `import type { … }` or inline `type` keyword for type-only imports.

When the project uses ESLint, [eslint](../eslint/SKILL.md) enforces import order (`simple-import-sort`), explicit object keys (`object-shorthand: never`), and related rules — run `yarn lint:fix` after edits.

## Types

- Use `type`, not `interface`.
- Object shapes always use explicit key / value form:

```ts
type UserData = {
  id: string;
  name: string;
  email: string;
};
```

- Split props: `type ButtonProps = ComponentProps<"button"> & { … }` or `Pick` / `Omit` from existing components.
- Export types from barrel files: `export type { ButtonVariantProps, CartItem };`
- Prefer `Record<string, T>` over index signatures when the map is dynamic.

## Components

- `function ComponentName(…)` — not `const ComponentName = () =>`.
- Default export from the implementation file (`button.tsx`).
- Named re-exports from `index.ts` (`export { ComponentName }`).
- Destructure props in the signature; put defaults on destructured params (`variant = "primary"`).
- Pass object arguments with explicit keys: `cn({ className: className })`, `variants({ size: size, variant: variant })`.
- Merge classes with `cn()` from the project's UI utils (e.g. `@ui/lib/utils`).
- Set `data-slot="…"` on primitive wrappers where the design system expects it.
- Handlers: `function handleClick() { … }` inside the component — not arrow functions or inline callbacks in JSX.
- Prefer `function name() { … }` over arrow functions (`() =>`, `(x) =>`) for methods, handlers, and callbacks.
- Prefer `if` / `else` over ternary (`x ? y : z`) and logical branching (`x && y`) — easier to breakpoint while debugging.
- Name variables clearly — never `e`, `ex`, `err`, `i`, `j`, `k` for errors or indexes. Prefer `error`, `exception`, `index`, `key`, etc.
- Function types in `type` definitions may still use `=>` (e.g. `(id: string) => void`).
- No empty line right after `{` or right before `}` in function/block bodies.

### JSX prop order

On JSX elements, sort props in this order:

1. `ref`
2. `data-*` (e.g. `data-slot`)
3. `className`
4. Rest (other props, then `{...spread}` if any)
5. `key` (always last)

```tsx
<button
  ref={ref}
  data-slot="button"
  className={className}
  onClick={handleClick}
  type={type}
  {...props}
  key={id}
>
```

## File names

- Use **kebab-case** for file and folder names (e.g. `button.tsx`, `button-variants.ts`, `use-fetch-form.ts`, `users-index.tsx`).
- Identifiers inside files keep their usual casing: PascalCase for components (`Button`), camelCase for hooks and utilities (`useFetchForm`).

## Folder layout

```
components/button/
  button.tsx           # default export
  button-variants.ts   # optional CVA variants
  index.ts             # barrel
```

Blocks/pages follow the same pattern under `blocks/` or `pages/`.

## Hooks & stores

- Hooks: `function useFetchForm(…)`, default export, return a plain object `{ form, loading, fetchForm }`.
- Stores: Zustand `create<State & Actions>()`, separate `type` for state, actions, and combined store; named export `useCartStore`; export data types when reused.

## Install in a project

```bash
composer require --dev nauten/agent-skills
```

In `AGENTS.md`:

```markdown
React style: follow the [react](vendor/nauten/agent-skills/skills/react/SKILL.md) skill.
HTML: follow the [html](vendor/nauten/agent-skills/skills/html/SKILL.md) skill.
```

Ensure `tsconfig.json` `paths` and Vite `resolve.alias` match the project's aliases.
