# 08 – Block patterns

Goal: old patterns move from the database into code.

## Old

- Patterns are posts of type `yard-presets`, registered by the yard-blocks plugin (`PresetsServiceProvider`), enabled via `yard::blocks/enable_patterns` in `app/filters.php`. No `register_block_pattern` in code.
- Reusable blocks (`wp_block`) may also exist.
- Pattern CSS lives in `assets/scss/patterns/` (`banner-home`, `banner`, `standard-page`) and hints at the names; the real list must come from the DB.

Export (old DB, prefix may differ):

```sql
SELECT ID, post_title, post_name, post_status FROM wp_posts WHERE post_type IN ('yard-presets','wp_block');
SELECT post_content FROM wp_posts WHERE ID = <id>;
```

## New

`config/poet.php` `block_pattern` + `resources/views/block-patterns/<slug>.blade.php`. Existing: `cards-2`, `cards-3`, `page-detail`, `query-pages`. Categories: `yard-banners`, `yard-cards`, `yard-content-enrichment`, `yard-media-text`, `yard-page-sections`, `yard-pages`, `yard-query`.

```php
'page-detail' => [
    'title' => 'Detailpagina',
    'categories' => ['yard-pages'],
    'blockTypes' => ['core/post-content'],
    'postTypes' => ['page'],
],
```

gemeentehw adds `pdc-page-detail`, `pdc-page-overview`, `pdc-page-overview-groups` with `postTypes => ['pdc-item']`.

## Pattern list (to fill from DB)

| Old preset title | Old content summary | New slug | Category | Status |
|---|---|---|---|---|
| Standaard pagina (?) | columns main/sidebar | `layout-article-aside` | yard-pages | ☐ |
| Banner (?) | media-text | uses `theme/banner` | yard-banners | ☐ |
| Banner home (?) | cover | | yard-banners | ☐ |
| Cards (?) | columns.pattern-cards | `cards-2` / `cards-3` | yard-cards | ☐ |

## Checklist

- [ ] Export `yard-presets` and `wp_block` from the old DB; paste titles into the table
- [ ] For each: rebuild with new blocks (05–07), save as `resources/views/block-patterns/<slug>.blade.php`, register in `config/poet.php`
- [ ] PDC patterns from gemeentehw adapted to Leiden's theme → subtheme → item structure
- [ ] Insert each pattern in the editor, save, view, compare
- [ ] `content-migration-notes.md`: pages that were created from a preset and must receive the new structure

## Open questions

- Are presets "synced" (edits propagate) or copied into pages? Affects whether migration touches pages or only the pattern.
