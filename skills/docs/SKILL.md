---
name: docs
description: >-
  Documentation structure and writing conventions for project and package docs.
  Use when creating, editing, moving, or reviewing README files, agent
  instructions, or Markdown documentation.
---

# Documentation

- Keep docs short and consistent: use a brief introduction, predictable headings, explanations before commands, no duplicated content, and update the relevant `index.md`.
- Keep project-wide docs in `docs/` and package-specific docs in the owning package's `docs/` folder.
- Use the nearest `index.md` as the documentation entry point. The root index may link to package indexes, but should not list package documents individually.
- Keep documentation indexes focused on documentation. `README.md` and `AGENTS.md` may link to the docs index; the docs index should not link back to them.
- Keep topic overviews at the package `docs/` root (for example, `footer.md`). Use topic subfolders for related documents; their `index.md` files provide structure and navigation only, while the overview remains in the parent document.
- Keep `README.md` and `agents.md` concise; link to the documentation index instead of duplicating documentation lists or instructions.
- Match each document's first heading to its filename (`# Commands`, `# Structure`, `# Seeding`, and so on). Use `# Documentation` for index pages.
- Use the same document shape where applicable: a short introduction, ordered `##` sections, and `###` command groups. Put explanations before code blocks and avoid trailing prose after commands.
- When adding or moving a document, update the nearest index, relevant structure tree, and all links to its old location.

## Structure documents

- Use the [Narsil Skills index](../../docs/index.md) and [structure](../../docs/structure.md) as examples.
- Show a recursive directory tree with a short, useful comment on each listed directory. Prefer precise descriptions such as `Eloquent model factories` and `Element contract implementations`; omit filler such as `code` or `package` when the directory context is already clear.
- List directories that help readers understand the repository. Omit generated, runtime, or tool-managed folders when they add no navigation value.
- For large `Blocks/` and `Components/` trees, list the category folder without enumerating every component or block subfolder.
