---
name: general
description: >-
  Cross-stack coding practices: bug fixes and comments. Use when fixing bugs,
  refactoring for clarity, writing or reviewing methods, or when the user
  mentions root cause, workarounds, comments, or self-describing code.
---

# General

## Bug fixes

Find the root cause; fix with the smallest change that solves it — not the shallowest workaround. If a small refactor simplifies an overcomplicated path (e.g. website ↔ API), prefer that over patching both ends.

## Comments

Avoid comments. Names and structure should make intent obvious. If a method is hard to name or needs a comment because it does too much, split it.
