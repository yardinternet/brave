# 07 – Composite blocks and layouts

Goal: the bigger structures in old content (banners, standard page layout, card grids) become Brave theme blocks and layout patterns. Old styling: `assets/scss/patterns/{_pattern-banner-home,_pattern-banner,_pattern-standard-page}.scss`, `assets/scss/blocks/media-text`.

## Mappings

| Old | How it is built | New | Notes |
|---|---|---|---|
| Banner | `core/media-text` variation + classes (`pattern-banner`), `core/cover` on homepage | `theme/banner` (`app/Blocks/Banner.php`, `resources/views/blocks/banner.blade.php`, image via `renderImage`) | map media-text attrs (mediaId, mediaPosition, bg) to banner attrs |
| Homepage banner | `pattern-banner-home` | `theme/banner` variant or separate pattern | check if different enough |
| Standard page | columns `.pattern-standard-page` with `.main-column` (655px) / `.sidebar-column`, rewritten to `<article>` / `<aside>` on render | `theme/article` + aside layout; Brave pattern `page-detail` (`resources/views/block-patterns/page-detail.blade.php`) is the starting point. Name in user's terms: `layout-article-aside` | the single largest content transform |
| Card grid | `core/columns.pattern-cards` with card markup inside | `theme/card` inside `cards-2` / `cards-3` patterns, or `yard/query` with card template | |
| Connected posts / links sidebar | `theme/connected-posts` block from ACF | `theme/card` list in aside | see 05 |
| PDC identifications | placeholder in content, filled by `Identifications.ts` | brave-owc renders identifications in `single-pdc-item` | drop JS |
| Terrace temperature | hand-placed `#js-terrace-temperature` markup + `TerraceWidget.ts` | small theme block or component, see 09 | find which page |

## Attribute mapping (to fill)

| Old block + attrs | New block + attrs |
|---|---|
| `core/media-text {mediaId, mediaType, mediaPosition, className: pattern-banner}` | `theme/banner {imageId, …}` |
| `core/columns.pattern-standard-page > core/column.main-column, core/column.sidebar-column` | `theme/article` + aside wrapper |

## Checklist

- [ ] Find every page using each structure (inventory counts)
- [ ] Confirm `theme/banner` and `theme/article` reproduce old markup widths (655px main column, 759px content)
- [ ] Build `layout-article-aside` pattern (08) and test with real old content pasted in
- [ ] Decide homepage banner
- [ ] Browser compare per structure at 3 widths
- [ ] `content-migration-notes.md`: attribute map per structure, with an example old → new block comment

## Open questions

- Does `theme/banner` need a variant for the homepage, or is the difference CSS only?
- Standard page: is the aside always present, or do pages exist without sidebar?
