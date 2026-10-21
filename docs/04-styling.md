# 04 – Basic styling

Goal: tokens, fonts, header, menu, search bar, footer, breadcrumbs look identical to `https://leiden.local/`. Written in Brave's Tailwind v4 setup, not ported SCSS.

## Tokens

Old: CSS custom properties in `theme-fusion/assets/scss/settings/_global.scss` plus SCSS vars in `_colors.scss`. `theme.json` palette is empty.

| Old token | Value | Proposed new token |
|---|---|---|
| `--color-palette-blue` | #057aba | `--color-primary-500` (scale 50–950 generated around it) |
| `--color-palette-blue-dark` | #035688 | `--color-primary-700` (check exact step) |
| `--color-palette-blue-light` | #f2f7fb | `--color-primary-50` |
| `--color-palette-red` | #d62410 | `--color-secondary-500` |
| `--color-palette-red-dark` | #a91c09 | `--color-secondary-700` |
| `$red-light` | #ffe4e4 | `--color-secondary-50` |
| `--color-palette-black` | #101920 | `--color-gray-950` or body text var |
| `--color-palette-gray-light` | #f7f7f8 | `--color-gray-50` |
| `$gray-medium` / `$gray-dark` / `$gray-darker` | #ededed / #e0e0e0 / #383838 | gray scale steps |
| `--yrs-color-primary` | red | search component var |
| `--layout-content-size` | 759px | `--content-container-width` |
| `--layout-content-size-pattern-main-column` | 655px | article column width (see 07) |
| `--layout-wide-size` | Bootstrap xl container | `--container-width` |

Scale values must reproduce the exact old hex at the steps actually used; generated in-between steps are free. Confirm with the designer or by sampling in the browser. `config/theme.php` legacy primary #cf0c12 / secondary #284148 look unused; ignore unless found in the browser.

New location: `resources/styles/base/theme.css` (`@theme static`), semantic vars in `base/variables.css`.

## Typography

| | Old | New |
|---|---|---|
| Family | Open Sans 400/600/700, self-hosted woff2 in `assets/fonts/`, `@font-face` in `_typography.scss` | `config/google-fonts.php` already has Open Sans 300–800; or self-host via `brave-install-fonts` skill if licensing/offline matters |
| Sizes | Bootstrap `$font-size-base`, `$lead-font-size`, `$small-font-size`, `theme.json` has none | fluid `--text-step-*`, `--text-h1..h6` in `theme.css`; set to match old computed sizes per breakpoint |
| Breakpoints | Bootstrap 4 (576/768/992/1200) | Brave sm 600 / md 782 / lg 960 / xl 1150. Pixel-perfect needs old values or verified equivalence; decide |

## Components

| Component | Old | New |
|---|---|---|
| Header | `partials/header.blade.php`, `header/site-branding`, `header/navigation` (`BootstrapMenuWalker`), `header/searchbar` | `resources/views/sections/header.blade.php`, `<x-brave-nav>`, `BraveNavigationManager` |
| Mobile menu | `MobileMenu.ts`, Bootstrap collapse | brave-frontend-kit navigation + `DialogManager` |
| Sticky navbar | `Navbar.ts` (headroom.js) | frontend-kit `Headroom` |
| Search bar | `@yardinternet/reactive-search` React app, Elasticsearch | depends on search decision (09); placeholder form posting to `/zoeken` until decided |
| Crisis banner | `CrisisServiceProvider` on `wp_after_navigation`, `Crisis.ts`, `_crisis.scss` | header partial + options page (03), `theme/alert` styling |
| Breadcrumbs | `partials/breadcrumbs`, `_breadcrumbs.scss`, filters in CPT providers | `<x-brave-breadcrumb>` |
| Footer | `partials/footer.blade.php`, widget areas `sidebar-footer-1..3` | `resources/views/sections/footer.blade.php`; Brave has no widgets. Decide: footer menu + options, or a footer pattern. Record widget content in inventory first |
| Focus styles | `FocusStyle.ts` | frontend-kit `FocusStyle` |
| Skip links / a11y toolbar | `_a11y-toolbar.scss` (toolbar disabled in code) | drop toolbar; keep skip link |
| Cookie banner | ? (check plugin) | `cookie-law-info` + `a11y-cookie-yes` already in Brave |

## Checklist

- [ ] Token scales in `theme.css`; delete Brave placeholder primary
- [ ] Semantic vars in `variables.css` (body text, headings, links, list markers, quote)
- [ ] Fonts: decide Google vs self-hosted; implement
- [ ] Breakpoints decision
- [ ] Header + nav + mobile menu
- [ ] Search bar placeholder
- [ ] Crisis banner
- [ ] Breadcrumbs
- [ ] Footer
- [ ] Browser verify: homepage, contact, a PDC page, a project page at 375 / 782 / 1280 widths against `leiden.local`; screenshot both and diff
- [ ] Lint: `pnpm lint:css`

## Open questions

- Breakpoints: keep Bootstrap values for pixel parity or accept Brave's?
- Footer widgets: what is in them (inventory) and where does that content live in Brave?
- Cookie banner on old site: which plugin, what text?
