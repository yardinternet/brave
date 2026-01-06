[![Code Style](https://github.com/yardinternet/brave/actions/workflows/format-php.yml/badge.svg?no-cache)](https://github.com/yardinternet/brave/actions/workflows/format-php.yml)

# Brave

Brave is a template for making WordPress sites. It is primarily a combination of [Bedrock](https://roots.io/bedrock/), [Acorn](https://roots.io/acorn/) and [Sage](https://roots.io/sage/), with a few modifications and additional features.

## Scaffold

This project includes scaffolding commands for commonly used content types to help you get started quickly. The best way to get familiar with this project is by running the following commands and exploring the generated files:

More information: [Brave Scaffold](https://github.com/yardinternet/brave-scaffold)

### Content types

```shell
wp acorn scaffold:news
wp acorn scaffold:person
wp acorn scaffold:project
wp acorn scaffold:knowledgebase
wp acorn scaffold:events
```

### Child Themes

1. To create a child theme you can run the following command. This will create a child theme directory in `web/app/themes/{slug}` that has Sage as the parent theme.

```shell
 wp acorn scaffold:sage-child {slug}
 ```

2. Add PSR-4 autoloading for your child theme to your (root) `composer.json`:

```diff
 "autoload": {
   "psr-4": {
     "App\\": "web/app/themes/sage/app/",
 +   "ChildTheme\\App\\": "web/app/themes/{slug}/app/",
   }
 },

```

More information: [Sage Child Theme Support](https://github.com/yardinternet/sage-child-theme-support).

## Components

Brave comes with a set of default components. Component views can be published with the following command:

```shell
wp acorn vendor:publish --provider="Yard\Brave\ComponentsServiceProvider" --tag="views"
```

More information: [Brave Components](https://github.com/yardinternet/brave-components)

## Theme development

1. Run `nvm use` to automatically use the correct Node version
2. Run `pnpm install` to install dependencies
3. Run `pnpm start` to compile assets

### Linking local packages

```bash
pnpm link <package-path>
```

For example: `pnpm link /Users/<user>/Packages/brave-frontend-kit`

Note: if you encounter errors with missing dependencies, add this to `pnpm-workspace.yaml`. For example:

```yaml
overrides:
    '@yardinternet/toolkit': link:../../../../Packages/yard-toolkit/packages/toolkit

shamefullyHoist: true # Add this line
```

## About us

[![banner](https://raw.githubusercontent.com/yardinternet/.github/refs/heads/main/profile/assets/small-banner-github.svg)](https://www.yard.nl/werken-bij/)
