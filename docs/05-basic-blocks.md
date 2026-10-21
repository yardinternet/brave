# 05 – Basic blocks

Goal: every block used in old content has a home in the new site: yard-gutenberg plugin block, Brave theme block, core block, or a documented replacement.

## Old block sources

- npm `@yardinternet/gutenberg-core`, registered in `assets/js/src/editor/blocks.js`: `collapseList`, `collapseItem`, `iconList`, `iconListItem`, `facetwp`, `listposts`. Namespace `yard-blocks/`.
- `yard-blocks` plugin installed but block bootstrap disabled (`yard-blocks.bootstrapBlocksFromYardBlocksPlugin` false; styling, Font Awesome, block manager off in `app/filters.php`). Presets CPT enabled.
- Theme blocks (`assets/js/src/editor/<block>/`, render in `app/Actions/Gutenberg.php` or `app/Blocks/`).
- Core blocks: about 70 unregistered via `unusedCoreBlocks` in `blocks.js` (deny-list). Brave uses an allow-list in `config/gutenberg.php`.
- `block-visibility` plugin, `@yardinternet/gutenberg-block-filters` for `core/column` visibility and ToC.
- SEOPress blocks seen in content: `wpseopress/table-of-contents`, `wpseopress/local-business-field`.

## Library blocks

| Old (`yard-blocks/*`) | New (`yard/*`, plugin/yard-gutenberg) | Decision |
|---|---|---|
| `collapse` + `collapse-item` | `collapse`, `collapse-item` | rename namespace; subtitle toggle was enabled, check attribute |
| `iconlist` + `iconlist-item` | `iconlist`, `iconlist-item` | rename namespace; styles tile/borders see 06 |
| `icon` | `icon` | rename namespace |
| `facetwp` | `facetwp` | rename namespace; templates in `config/facetwp/` |
| `listposts` (remote sources OpenPub / Locaties / Producten en Diensten; layouts `1-op-een-rij`, `2-op-een-rij`, `3-op-een-rij`, `locatie-openings-bericht-vandaag`) | `yard/query` (yard/query-block, templates in `resources/views/vendor/yard-query-block/templates/`) | content now local, so a query block replaces remote listposts. Attribute mapping needed per layout. Biggest transform in this phase |
| – | `counting-number`, `slider`/`slide`, `tabs`/`tabs-item`, `table-of-contents`, `timeline`/`timeline-item`/`timeline-item-collapse` | available; enable only what Leiden uses |

## Theme blocks

| Old | Files | Candidate in Brave | Decision |
|---|---|---|---|
| `theme/connected-posts` | `editor/connected-posts/`, `Actions/Gutenberg.php`, `templates/blocks/connected-posts.blade.php`; reads ACF `page_connected_*` | `theme/card` + `yard/query`, or port as `theme/connected-posts` via `brave-gutenberg-block` skill | ask |
| `theme/openinghours` | `editor/openinghours/`, `app/Blocks/OpeningHours/`, `partials/opening-hours/{regular,timetable}` | none; port | port (used on contact page) |
| `theme/social-share` | `editor/social-share/`, `partials/social-share` | `<x-brave-social-icon>` + frontend-kit `WebShareApi` | likely replace, verify markup |
| `theme/table-of-contents` | `editor/table-of-contents/`, `TableOfContents.js` (focus-trap) | `yard/table-of-contents` | replace if visually equal |
| `theme/page-attributes-parent` | `editor/page-attributes-parent/`, scss `blocks/page-attributes-parent` | `theme/back-button` (renders for post types supporting parent-page) | replace |
| `theme/timeline` + `theme/timeline-item` (static save) | `editor/timeline/block.json` | `yard/timeline` + `yard/timeline-item` | replace; static markup needs transform |

## Brave theme blocks available now

`theme/alert`, `theme/article`, `theme/back-button`, `theme/banner`, `theme/card`, `theme/group`, `theme/section` (`config/blocks.php`, `app/Blocks/`, `resources/scripts/blocks/`).

## Core blocks

Produce the list of core blocks actually present in old content (inventory, phase 1), then set `config/gutenberg.php` `blockSets` / `allowedCoreBlocks` accordingly. Old deny-list is in `blocks.js`; don't copy it, derive from usage.

## Checklist

- [ ] Block usage counts from old DB (`<!-- wp:yard-blocks/…`, `<!-- wp:theme/…`, `<!-- wp:core/…`)
- [ ] `config/gutenberg.php` allow-lists set
- [ ] Decision per theme block (table above) with a reason
- [ ] Ported blocks scaffolded with `brave-gutenberg-block`, styled in `resources/styles/blocks/<block>/`
- [ ] Each block rendered on a test page and compared with the old site
- [ ] `content-migration-notes.md`: namespace renames, attribute maps, listposts → query mapping

## Open questions

- `listposts` layouts: which are in use and on which pages?
- `block-visibility` plugin: in use on content? Not in Brave composer.
- SEOPress blocks: keep (SEOPress stays) or remove from content?
- Font Awesome: old site used light + brands via gutenberg-editor-components. Which icon set does Brave's `yard/icon` use, and does the icon list match?
