---
name: general
description: >-
  Cross-stack coding practices: bug fixes, comments, and single-return methods.
  Use when fixing bugs, refactoring for clarity, writing or reviewing methods,
  or when the user mentions root cause, workarounds, comments, early returns,
  or self-describing code.
---

# General

## Bug fixes

Find the root cause; fix with the smallest change that solves it — not the shallowest workaround. If a small refactor simplifies an overcomplicated path (e.g. website ↔ API), prefer that over patching both ends.

## Comments

Avoid comments. Names and structure should make intent obvious. If a method is hard to name or needs a comment because it does too much, split it.

## Methods

Prefer **one `return` per method** (single exit). Guard clauses with early returns are discouraged when they create multiple exits — rewrite with `if` / `else`, extract helpers, or split the method so each function has a single return. Apply when writing or editing methods across stacks (PHP, TypeScript, etc.).
