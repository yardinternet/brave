# Copilot Instructions for Brave

## Project Overview

Brave is a WordPress site template built on [Bedrock](https://roots.io/bedrock/), [Acorn](https://roots.io/acorn/), and [Sage](https://roots.io/sage/), with custom scaffolding and component systems. It is designed for rapid, modern WordPress development with opinionated structure and tooling.

## Key Architecture & Structure

-   **Bedrock**: Manages WordPress as a dependency and provides environment configuration.
-   **Acorn**: Laravel-like framework for WordPress, used for service providers, commands, and dependency injection.
-   **Sage**: Blade-based theming system. Main theme in `web/app/themes/sage`.
-   **Custom Scaffolding**: Use `wp acorn scaffold:*` commands to generate content types and child themes.
-   **Components**: Blade components are provided and can be published/overridden.

## Context: Yard Packages

This project uses several Yard packages for modular functionality:

-   **yard/brave-components**: Shared Blade components for rapid UI development.
-   **yard/brave-csp**: Content Security Policy (CSP) management.
-   **yard/brave-hooks**: Centralized registration and management of WordPress hooks.
-   **yard/config-expander**: Expands and merges config files for modular configuration.
-   **yard/data**: Utilities for data handling and transformation.
-   **yard/multisite-url-fixer**: Fixes URL issues in WordPress multisite environments.
-   **yard/nutshell**: Extends Acorns with additional features and helpers.
-   **yard/query-block**: Provides advanced query blocks for Gutenberg.
-   **yard/webmanifest**: Generates and manages web app manifests.
-   **yard/wordfence-mysqli-storage-engine**: Custom storage engine for Wordfence using MySQLi.
-   **yard/wp-block-registrar**: Registers custom Gutenberg blocks via PHP.
-   **yard/wp-database**: Database utilities and helpers for WordPress.
-   **yard/wp-user-roles**: Manages custom user roles and capabilities.

## Frontend Build & JS Packages

-   **Build Process**: Uses Vite for asset bundling and development server. Main config: `vite.config.js` and `vite-blocks.config.js`.
-   **package.json**: Manages JS dependencies, scripts, and build tools. Use `pnpm` for installing and linking packages.

### Context: @yardinternet Packages

-   **@yardinternet/eslint-config**: Shared ESLint rules for consistent JS/TS linting.
-   **@yardinternet/prettier-config**: Shared Prettier formatting rules.
-   **@yardinternet/stylelint-config**: Shared Stylelint rules for CSS/SCSS.
-   **@yardinternet/toolkit**: Utility functions and helpers for frontend development.
-   **@yardinternet/vite-config**: Shared Vite configuration for Yard projects.
-   **@yardinternet/a11y-cookie-yes**: Accessibility and cookie consent utilities.
-   **@yardinternet/brave-frontend-kit**: Shared frontend UI components and styles.
-   **@yardinternet/gutenberg-components**: Shared React components for Gutenberg block development.

## Project Conventions

-   **PSR-4 Autoloading**: Add new child themes to `composer.json` under `autoload.psr-4`.
-   **pnpm**: Used for JS package management. Use `pnpm-workspace.yaml` for monorepo overrides and linking.
-   **Blade Components**: Place custom components in `web/app/themes/sage/resources/views/components`.
-   **Environment Config**: See `config/environments/` for per-environment PHP config.
-   **Custom PHP**: Place custom PHP in `web/app/themes/sage/app/` or child theme `app/` folders.
-   **Config Folder (`web/app/themes/sage/config/`)**:
    -   Use `hooks.php` to register theme hooks (actions/filters) in a centralized way.
    -   Register custom post types and taxonomies in `poet.php` (using the Poet package conventions).
    -   Define PHP server-side blocks in `blocks.php`.
    -   Configure Gutenberg editor and block settings in `gutenberg.php`.
    -   Nested folders (e.g., `facetwp/facets/`, `poet/post/`) represent config keys and allow for modular, hierarchical configuration. Each file or folder under `config/` is autoloaded as a config key, and nested files become nested config arrays.

## References

-   Main theme: `web/app/themes/sage/`
-   Components: `web/app/themes/sage/resources/views/components/`
-   Scaffolding: See [Brave Scaffold](https://github.com/yardinternet/brave-scaffold)
-   Components: See [Brave Components](https://github.com/yardinternet/brave-components)
