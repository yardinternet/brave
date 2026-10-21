# 10 – Content migration

Goal: old content in the new site, transformed per `content-migration-notes.md`. PDC items first. Other types optional, decided later.

## Reference implementation (gemeentehw)

`~/LocalSites/gemeentehw/app/public/web/app/themes/sage/app/Console/Commands/OpenPdcImport/`

| File | Role |
|---|---|
| `ImportOpenPdc.php` | Artisan command `pdc:import`, steps, idempotent upserts |
| `OpenPdc.php` | REST fetch (`owc/pdc/v1/…?limit=-1`), media sideload, block markup builders (banner, taxonomy query, collapse, see-also, files) |
| `HtmlToBlocks.php` | classic HTML → Gutenberg blocks |
| `export-extra.php` | run on the source site with `wp eval-file`; dumps fields the API omits to `docs/openpdc-extra.json` |
| `docs/openpdc-migration.md` | mapping rules, endpoint counts, parent resolution, ordering, meta keys |
| `docs/openpdc-missing-data.md`, `docs/openpdc-redirects.csv` | gaps and redirects |

Registered in `config/console.php`. Run:

```
WP_ENV=staging wp acorn pdc:import terms|themes [--fresh]|leges|items [--files] [--only=ids]|extra|redirects [--out=csv]
```

`WP_ENV=staging` because Ignition turns PHP deprecations into fatals locally. Items upsert by `_openpdc_id` meta, terms by slug.

## Leiden PDC specifics

- Source: OpenPDC REST (needs `leiden-openpdc.local` running) or its DB directly. REST preferred for parity with gemeentehw.
- Volume: 280 published + 16 draft items, 12 categories, 53 subcategories, 1 group, 21 leges, 2 verordeningen, 1 location.
- URL: `/inwoners-en-ondernemers/{thema}/{subthema}/{item}`, no id. Old URLs must redirect to new ones if slugs change.
- Identifications on, groups on. FAQ, internal data, expiration date present.
- Removed fields (02) do not need importing.
- Media: featured images and downloads sideloaded; check `--files`.

## Steps

1. Terms (doelgroep, aspect, decided taxonomies).
2. Themes / subthemes → whatever structure 02 decided (pdc-group terms, pages, or category posts).
3. Leges, verordeningen (shortcodes referencing them must keep working).
4. Items: content via `HtmlToBlocks`, then transforms from the ledger (block renames, styles, patterns).
5. Extra data from `export-extra.php`.
6. Redirects CSV → relay / server config.
7. Verify.

## Other types (optional, decide later)

| Type | Source | Transform needs |
|---|---|---|
| pages | old portal DB (`wp_posts`), WXR or direct SQL | ledger rules for blocks, styles, patterns; `_ys_` taxonomy prefix; ACF meta keys |
| person, project, project-news | old portal DB | same + ACF relationships (IDs change) |
| openpub-item | OpenPub REST / DB (confirm Leiden DB) | news slug change, id dropped from URL, polls |
| media | old uploads | sideload or rsync + GUID fix |

## Verification

- Counts per type and taxonomy before/after (`wp post list --post_type=… --format=count`, `wp term list`).
- Re-run import: zero duplicates (idempotency).
- Spot-check 10 items in the browser against the old site (visual + links + downloads + identifications).
- Old URL → new URL for 20 sampled items (redirect test).
- No `yard-blocks/`, `theme/page-attributes-parent`, `pattern-standard-page` strings left in `post_content` after transforms.

## Checklist

- [ ] Copy gemeentehw command structure into `app/Console/Commands/OpenPdcImport/`, adjust to Leiden mapping
- [ ] Write `docs/openpdc-migration.md` equivalent for Leiden (mapping table) next to the command or in this folder
- [ ] Dry run on a copy of the local DB
- [ ] Verification list above passes
- [ ] Decide on other types
