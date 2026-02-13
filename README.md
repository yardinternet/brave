[![Code Style](https://github.com/yardinternet/brave/actions/workflows/format-php.yml/badge.svg?no-cache)](https://github.com/yardinternet/brave/actions/workflows/format-php.yml)

# Brave

Brave is a template for making WordPress sites. It is primarily a combination of [Bedrock](https://roots.io/bedrock/), [Acorn](https://roots.io/acorn/) and [Sage](https://roots.io/sage/), with a few modifications and additional features.

## Packages

This project uses a number of PHP packages:

- [**plugin/yard-gutenberg**](https://github.com/yardinternet/wp-gutenberg): Custom blocks and additional features for the Gutenberg editor.
- [**yard/brave-components**](https://github.com/yardinternet/brave-components): Shared Blade components.
- [**yard/brave-csp**](https://github.com/yardinternet/brave-csp): Content Security Policy management.
- [**yard/brave-hooks**](https://github.com/yardinternet/brave-hooks): System for registering and managing plugin-specific and conditional WordPress hooks.
- [**yard/brave-scaffold**](https://github.com/yardinternet/brave-scaffold): Quickly scaffold WordPress content types to help you get started quickly.
- [**yard/config-expander**](https://github.com/yardinternet/config-expander): Centralized, extensible WordPress site configuration.
- [**yard/data**](https://github.com/yardinternet/wp-data): Adds powerful WordPress data objects.
- [**yard/multisite-url-fixer**](https://github.com/yardinternet/multisite-url-fixer): Fixes URL issues in WordPress multisite environments.
- [**yard/nutshell**](https://github.com/yardinternet/nutshell): Extends Acorns with additional features and helpers.
- [**yard/query-block**](https://github.com/yardinternet/wp-query-block): Provides an advanced query blocks for Gutenberg.
- [**yard/webmanifest**](https://github.com/yardinternet/wp-webmanifest): Generates a web app manifest.
- [**yard/wp-block-registrar**](https://github.com/yardinternet/wp-block-registrar): Register Gutenberg blocks via config.
- [**yard/wp-database**](https://github.com/yardinternet/wp-database): WordPress Eloquent ORM and database utilities.
- [**yard/wp-hook-registrar**](https://github.com/yardinternet/wp-hook-registrar): Register hooks using PHP attributes.
- [**yard/wp-user-roles**](https://github.com/yardinternet/wp-user-roles): Manages custom user roles and capabilities.

This project uses several JavaScript packages:

- [**@yardinternet/a11y-cookie-yes**](https://github.com/yardinternet/a11y-cookie-yes): Accessibility improvements for the CookieYes plugin.
- [**@yardinternet/brave-frontend-kit**](https://github.com/yardinternet/brave-frontend-kit): Contains frontend UI modules.
- [**@yardinternet/eslint-config**](https://github.com/yardinternet/toolkit/tree/main/packages/eslint-config): ESLint rules for consistent JS/TS linting.
- [**@yardinternet/gutenberg-components**](https://github.com/yardinternet/gutenberg-packages/tree/master/packages/components): React components for Gutenberg block development.
- [**@yardinternet/prettier-config**](https://github.com/yardinternet/toolkit/tree/main/packages/prettier-config): Prettier formatting rules.
- [**@yardinternet/stylelint-config**](https://github.com/yardinternet/toolkit/tree/main/packages/stylelint-config): Stylelint rules.
- [**@yardinternet/toolkit**](https://github.com/yardinternet/toolkit/tree/main/packages/toolkit): Utility functions and helpers for frontend development.
- [**@yardinternet/vite-config**](https://github.com/yardinternet/toolkit/tree/main/packages/vite-config): Vite configuration.

## Theme development

1. Run `nvm use` to automatically use the correct Node version
2. Run `pnpm install` to install dependencies
3. Run `pnpm start` to compile assets

### Linking local packages

```bash
pnpm link <package-path>
```

Note: if you encounter errors with missing dependencies, add `shamefullyHoist: true` to `pnpm-workspace.yaml`.

## About us

[![banner](https://raw.githubusercontent.com/yardinternet/.github/refs/heads/main/profile/assets/small-banner-github.svg)](https://www.yard.nl/werken-bij/)
