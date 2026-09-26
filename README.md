# Agent skills

Portable [Cursor Agent Skills](https://cursor.com/docs/agent/skills) for documentation, Blade, ESLint, HTML, Laravel, PHP, React, Tailwind, and TYPO3. See the [documentation index](docs/index.md) for the repository structure and [AGENTS.md](AGENTS.md) for skill wiring.

## Install (Composer)

Add the GitHub repository, then require the package as a dev dependency:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/Narsileon/narsil-skills.git"
    }
  ],
  "require-dev": {
    "narsil/skills": "^1.0"
  }
}
```

Local development (path repo):

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../narsil-skills"
    }
  ],
  "require-dev": {
    "narsil/skills": "@dev"
  }
}
```

For PHP checks and fixers, see the [Commands guide](docs/commands.md).
