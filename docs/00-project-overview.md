# 00 – Project overview

## Stack comparison

| | Old (Fusion) | New (Brave) |
|---|---|---|
| Repo | `~/LocalSites/leiden/app/public` | `~/LocalSites/leiden-brave/app/public` |
| Framework | Yard Fusion v5 (Laravel 8 style app at repo root, facades `Hook`, `Route`, `View`, `Taxonomy`) | Bedrock + Acorn 5 + Sage |
| WP core | `htdocs/wp` 6.8 | `web/wp` 7.1 |
| Theme | `htdocs/wp-content/themes/theme-fusion` | `web/app/themes/sage` |
| PHP app code | `app/` at repo root, providers in `config/app.php` | `web/app/themes/sage/app/` (`Blocks`, `Csp`, `Data`, `FieldGroups`, `Hooks`, `Providers`, `View`) |
| Hooks | `app/actions.php`, `app/filters.php`, `app/assets.php` | `app/Hooks/*.php` with `#[Action]` / `#[Filter]` attributes, listed in `config/hooks.php` |
| Post types | Fusion `PostType` classes in `app/Components/*`, listed in `config/app.php` | Poet: `config/poet/post/*.php`, `config/poet/taxonomy/*.php` |
| Meta | ACF JSON in `theme-fusion/acf-json/` | `app/FieldGroups/*.php` via `yard/brave-acf`, listed in `config/acf.php` |
| View data | Fusion ViewComposers per component | `app/Data/*Data.php` (spatie/laravel-data) + `app/View/Composers` |
| Build | `@wordpress/scripts` (webpack), npm, TypeScript, `scripts/{editor,frontend}.config.js` | Vite via `@yardinternet/vite-config`, pnpm, `yard-toolkit` scripts |
| CSS | SCSS + Bootstrap 4.6, tokens as `--color-palette-*` in `assets/scss/settings/_global.scss` | Tailwind v4, tokens in `resources/styles/base/theme.css` (`@theme static`, 50–950 scales) |
| Fonts | Open Sans self-hosted woff2 in `assets/fonts/` | `config/google-fonts.php` (spatie) or self-hosted in `resources/fonts/` |
| Blocks (library) | npm `@yardinternet/gutenberg-core` registered in theme JS; `yard-blocks` plugin present but block bootstrap disabled | `plugin/yard-gutenberg` (composer), allow-list in `config/gutenberg.php` |
| Blocks (theme) | editor JS in `assets/js/src/editor/<block>/`, PHP render in `app/Actions/Gutenberg.php` or `app/Blocks/*` | `resources/scripts/blocks/<name>/` + `app/Blocks/<Name>.php` + `resources/views/blocks/<name>.blade.php`, registered in `config/blocks.php` |
| Block patterns | DB: `yard-presets` CPT (yard-blocks presets) | `config/poet.php` `block_pattern` + `resources/views/block-patterns/*.blade.php` |
| Blade components | – | `yard/brave-components` (`<x-brave-*>`), theme `app/View/Components` |
| Search | Elasticsearch: ElasticPress + `yard-elasticsearch`, JKC multi-index REST (`app/Jkc`), `@yardinternet/reactive-search` in header | not decided; Brave private packages offer SearchWP + FacetWP |
| OpenPDC / OpenPub | live REST calls from `app/OpenPDC`, `app/OpenPub`, listposts remote sources | `yard/brave-owc` installs pdc-base + openpub-base in the portal; content imported |
| Security headers | `bepsvpt/secure-headers` | `yard/brave-csp` (`app/Csp/Policy.php`) |
| Deploy | `yard/wp-deployer`, `deploy.php` | `composer private-deployer` |

## Key paths, old site

```
app/
  actions.php filters.php assets.php
  Actions/Gutenberg.php          # theme block renders, render_block rewrites
  Blocks/ListPosts/Models/       # OpenPub / OpenPDC / Location remote models
  Components/Person Project Crisis Client NavMenu GravityForms User PWA
  OpenPDC/ OpenPub/ Jkc/ Search/ Sitemap/ Redirections/
config/
  app.php openpdc.php openpub.php yard-blocks.php jkc.php search.php weather.php
htdocs/wp-content/themes/theme-fusion/
  acf-json/ theme.json
  assets/js/src/editor/          # blocks.js, block-variations.js, hooks/style-class.js, <block>/
  assets/js/src/frontend/        # app.ts, components/*.ts, search/
  assets/scss/                   # settings/, blocks/, components/, patterns/
  templates/                     # layouts/, partials/, blocks/, single-*.blade.php
```

## Key paths, new site

```
web/app/themes/sage/
  app/Blocks app/Data app/FieldGroups app/Hooks app/View
  config/blocks.php gutenberg.php poet.php poet/ acf.php hooks.php facetwp/ google-fonts.php
  resources/scripts/blocks/<name>/ resources/scripts/editor/ resources/scripts/frontend/
  resources/styles/base/{theme,variables,config}.css resources/styles/blocks/ components/ vendor/
  resources/views/blocks/ block-patterns/ components/ partials/ sections/ vendor/
```

## Reference project

`~/LocalSites/gemeentehw/app/public` is the most recent municipality on Brave with `yard/brave-owc` ^4. Use it for:

- `config/owc.php` and how the theme overrides brave-owc defaults
- `app/Console/Commands/OpenPdcImport/` and its `docs/` for the content import
- `config/poet/`, `app/FieldGroups`, `app/Data` for CPTs person, project, roadmaintenance, servicepoint
- `config/facetwp/templates/*.php` and `resources/views/blocks/FacetWP/`

## Environment issues (2026-10-21)

- Old portal: `wp` cli fails. Local serves PHP 8.1.29, composer platform requires 8.2. Fix: switch the site's PHP version in Local, or query the DB directly.
- `leiden-openpdc.local`: not running (connection refused). Start it in Local before phase 2 and 10.
- `leiden-openpub.local`: redirects to `/wp/`, REST returns 404. The DB is also not Leiden data (portal URL `buren.nl`, composer name `alkmaar-openpub`). Confirm which OpenPub database to use before relying on it.
- `gemeentehw.local`: 502. Code is readable; no browser verification possible until started.
- Old portal PDC and news routes 404 locally because they fetch from the headless sites at request time.
