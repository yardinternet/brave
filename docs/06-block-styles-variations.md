# 06 – Block styles, variations and block swaps

Goal: every `is-style-*`, variation and class used in old content either exists in Brave or is mapped to a replacement. Source: `assets/js/src/editor/hooks/style-class.js`, `editor/block-variations.js`, `assets/scss/blocks/*`.

## Block styles

| Block | Old style | Label | New | Notes |
|---|---|---|---|---|
| `core/list` | `is-style-arrow-left` | Pijlen links | swap to `yard/iconlist` with arrow icon, or Brave list style | prefer swap for editor UX |
| `core/list` | `is-style-unstyled` | Stijlloos | Brave list style? | |
| `core/button` | `is-style-outlined` | Secundair | Brave button styles in `resources/scripts/editor/block-styles.js` | check name |
| `core/button` | removed `fill`, `yard-blocks-button-outline` | | | |
| `core/group` | `is-style-alert` | Waarschuwing | `theme/alert` block | swap |
| `core/group` | `is-style-unstyled` | Stijlloos | plain group | |
| `yard-blocks/iconlist` | `is-style-tile` | Tegel | `yard/iconlist` style? | check plugin styles |
| `yard-blocks/iconlist` | `is-style-borders` | Randen | `yard/iconlist` style? | |
| `core/table` | removed `stripe`, `stripes`, `default` | | | |
| `core/quote` | removed `large`, `default`, `plain` | | | |
| `core/social-links` | `is-style-logos-only` (core) | seen in footer | core | |
| `core/columns`? | `is-style-two-columns` (seen on homepage) | | find origin | ask |

## Variations

| Block | Old | New |
|---|---|---|
| `core/spacer` | `spacer-with-steps` default, height `var:preset|spacing|5`; `theme.json` spacing presets 1–7 | Brave spacing presets in `theme.json`; map preset numbers |
| `core/group` | `group-with-background` default (bg white); core `group`, `group-row`, `group-stack`, `group-grid` unregistered | `theme/group` / `theme/section` with color supports; `resources/scripts/editor/block-variations.jsx` |
| `core/media-text` | banner variation (see 07) | `theme/banner` |

## Classes applied by hand or by patterns

Collected from scss and sampled pages: `pattern-cards`, `pattern-standard-page`, `main-column`, `sidebar-column`, `pattern-banner`, `pattern-banner-home`. Complete this list from the inventory (`grep -o 'className":"[^"]*'` on old `post_content`).

## Server-side rewrites in old site

`app/Actions/Gutenberg.php` on `render_block`: embed URL rewrite (`changeEmbedURL`) and `core/column.main-column` → `<article>`, `.sidebar-column` → `<aside>` (`changePatternStandardPage`). Neither should be ported; replace by real blocks (07) and check whether embed rewrite is still needed.

## Block swaps for editor UX

| Old | New | Reason |
|---|---|---|
| `core/list.is-style-arrow-left` | `yard/iconlist` | editor UX |
| `core/group.is-style-alert` | `theme/alert` | real block |
| `core/media-text` banner | `theme/banner` | 07 |
| `theme/page-attributes-parent` | `theme/back-button` | 05 |
| `theme/timeline` | `yard/timeline` | 05 |
| `yard-blocks/listposts` | `yard/query` | 05 |

## Checklist

- [ ] Full list of `is-style-*` and `className` values from old content with counts
- [ ] Decision per row; register needed styles in `resources/scripts/editor/block-styles.js`, variations in `block-variations.jsx`
- [ ] CSS in `resources/styles/blocks/<block>/shared.css` (+ `editor.css`)
- [ ] Test page with every style side by side; compare with old
- [ ] `content-migration-notes.md`: search/replace rules per row (block name, className, attributes)

## Open questions

- `is-style-two-columns`: which block, where registered?
- Spacing preset scale: old 1–7 values vs Brave presets, exact px?
