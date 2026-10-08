---
name: react
description: >-
  React/TypeScript style for components, hooks, stores, and types. Use when
  creating or editing .tsx/.ts in resources/js/, when the user mentions import
  order, JSX prop order, path aliases, kebab-case file names, object types,
  component templates, ESLint setup, performance, or dynamic/lazy loading.
  JSX markup follows the html skill; Tailwind classes follow the tailwind skill.
---

# React

HTML / JSX markup: follow [html](../html/SKILL.md).
Tailwind tokens: follow [tailwind](../tailwind/SKILL.md).

Read templates from [templates/](templates/) in this folder. Generated code goes in `resources/js/` (or package `resources/js/`).

| Artifact          | Template                                                                                 | Notes                                                      |
| ----------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------- |
| UI root atom      | [templates/component.stub](templates/component.stub)                                     | `CardRoot` — default export; private props type            |
| UI content atom   | [templates/card-content.stub](templates/card-content.stub)                              | `CardContent` — default export                             |
| UI icon atom      | [templates/card-icon.stub](templates/card-icon.stub)                                    | `CardIcon` — props derived from its variant function      |
| Root variants     | [templates/component-variants.stub](templates/component-variants.stub)                  | `cardRootVariants` — default CVA export                    |
| Icon variants     | [templates/card-icon-variants.stub](templates/card-icon-variants.stub)                  | `cardIconVariants` — atom-specific CVA export              |
| UI barrel         | [templates/component-index.stub](templates/component-index.stub)                        | Import defaults, then export named atoms and variants      |
| Block card        | [templates/block-card.stub](templates/block-card.stub)                                  | Compose `CardRoot` and `CardContent`; derive props          |
| Block barrel      | [templates/block-card-index.stub](templates/block-card-index.stub)                      | Import default block, then export it by name               |
| Component spacing | [templates/component-spacing.stub](templates/component-spacing.stub)                    | Declaration order + blank lines between logic blocks       |
| Page              | [templates/page.stub](templates/page.stub)                                              | `UsersIndex` — Inertia page                                 |
| Hook              | [templates/hook.stub](templates/hook.stub)                                              | `useFetchForm` — default export                             |
| Store             | [templates/store.stub](templates/store.stub)                                            | `useCartStore` — Zustand                                    |

## Imports

**Never use parent-relative imports** (`../`, `../../`). Use path aliases (`@ui/…`, `@/…`) for anything outside the current folder. Ensure `tsconfig.json` `paths` and Vite `resolve.alias` match the project's aliases.

`./` is allowed only for siblings in the same directory (e.g. `./card-root-variants`).

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
- Object shapes always use explicit key / value form.
- Define component prop types next to the component and keep them private: `type CardRootProps = ComponentProps<"div"> & { … }` or use `Pick` / `Omit` from another type.
- Do not export component prop types from implementation files or barrels. Keep them private beside their component. Consumers can read or extend a component's props with `ComponentProps<typeof Component>`; see [templates/block-card.stub](templates/block-card.stub).
- Shared domain/data types that are not component prop types may be exported from a barrel when other modules need them.
- Prefer `Record<string, T>` over index signatures when the map is dynamic.

## Components

- `function ComponentName(…)` — not `const ComponentName = () =>`.
- Default export from the implementation file (`card-root.tsx`).
- Named re-exports from `index.ts` (`export { ComponentName }`).
- Destructure props in the signature; put defaults on destructured params (`variant = "default"`).
- Pass object arguments with explicit keys: `cn({ className: className })`, `cardRootVariants({ variant: variant })`.
- Merge classes with `cn()` from the project's UI utils (e.g. `@ui/lib/utils`).
- Set `data-slot="…"` on primitive wrappers where the design system expects it.
- Handlers: `function handleClick() { … }` inside the component — not arrow functions or inline callbacks in JSX.
- Prefer `function name() { … }` over arrow functions (`() =>`, `(x) =>`) for methods, handlers, and callbacks.
- Prefer `if` / `else` over ternary (`x ? y : z`) and logical branching (`x && y`) — easier to breakpoint while debugging.
- Name variables clearly — never `e`, `ex`, `err`, `i`, `j`, `k` for errors or indexes. Prefer `error`, `exception`, `index`, `key`, etc.
- Function types in `type` definitions may still use `=>` (e.g. `(id: string) => void`).
- No empty line right after `{` or right before `}` in function/block bodies.
- Blank line between logic blocks (refs, hooks, state, derived, effects, handlers — also inside effects; blank after a method call before calculations). See [templates/component-spacing.stub](templates/component-spacing.stub):

  1. Refs → 2. External hooks → 3. State → 4. Derived → 5. Value hooks → 6. Effects → 7. Handlers → 8. Return

### JSX prop order

Same order as [html](../html/SKILL.md) attributes, with JSX names:

1. `ref`
2. `id`
3. `data-*` (e.g. `data-slot`)
4. `className`
5. Rest — other props alphabetically, then `{...spread}` if any
6. `key` (always last)

Follow this order in the `CardRoot` implementation shown in [templates/component.stub](templates/component.stub).

## File names

- Use **kebab-case** for file and folder names (e.g. `card-root.tsx`, `card-root-variants.ts`, `use-fetch-form.ts`, `users-index.tsx`).
- Identifiers inside files keep their usual casing: PascalCase for components (`CardRoot`), camelCase for hooks and utilities (`useFetchForm`).

## Folder layout

Prefer two component layers: reusable atoms in `components/ui/` and composed, product-specific blocks in `components/blocks/`. The card example is in [templates/component.stub](templates/component.stub), [templates/component-index.stub](templates/component-index.stub), [templates/block-card.stub](templates/block-card.stub), and [templates/block-card-index.stub](templates/block-card-index.stub). Keep atom variants beside the atom (for example, `card-root-variants.ts` and `card-icon-variants.ts`). Each barrel imports defaults from its sibling files and exports named values; never export component prop types. Blocks/pages follow this pattern under `components/blocks/` or `components/pages/`.

## Performance

Split static vs dynamic imports by content role — not by whole block:

- **Eager (no dynamic):** SEO-critical copy, headings, text, and any content that must ship in the initial render.
- **Dynamic (lazy):** Images, video, animation, and other heavy media — especially when outside the first viewport.
- **Mixed blocks** (e.g. text + media): keep the text/SEO part eager; load the media or animated part dynamically. Never lazy-load an entire text+media block just because it includes media.

## Hooks & stores

- Hooks: `function useFetchForm(…)`, default export, return a plain object `{ form, loading, fetchForm }`.
- Stores: Zustand `create<State & Actions>()`, separate `type` for state, actions, and combined store; named export `useCartStore`; export data types when reused.
