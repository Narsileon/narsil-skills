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
- Keep topic overviews at the package `docs/` root (for example, `footer.md`). Use topic subfolders for related documents; their `index.md` files provide structure and navigation only, while the overview remains in the parent document.
- Keep `README.md` and `agents.md` concise; link to the documentation index instead of duplicating documentation lists or instructions.
- Match each document's first heading to its filename (`# Commands`, `# Structure`, `# Seeding`, and so on). Use `# Documentation` for index pages.
- Use the same document shape where applicable: a short introduction, ordered `##` sections, and `###` command groups. Put explanations before code blocks and avoid trailing prose after commands.
- When adding or moving a document, update the nearest index, relevant structure tree, and all links to its old location.
