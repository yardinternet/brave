# 01 – Inventory of the old site

Goal: know what the site contains before touching anything. Output is a set of tables in this doc, not code.

## Method

- Old portal `wp` cli is broken (PHP mismatch, see 00). Options: fix PHP in Local, or read the DB through Local's MySQL socket, or scrape `https://leiden.local/`.
- Block usage per page: query `post_content` for `<!-- wp:` markers. One SQL per block name is enough; no need for a parser.
- OpenPDC and OpenPub content lives in their own DBs (table prefixes `0wc_pdc_`, `0wc_op_`).
- Verify everything you record by opening the page in the browser.

## Already known

### Site structure (from homepage nav)

- Inwoners en ondernemers (PDC: afval, parkeren, paspoort, subsidies, uitkering, verhuizen, wonen en bouwen, melding)
- Bestuur (college, gemeenteraad, beleid en regelgeving)
- Nieuws en publicaties (OpenPub news at `nieuws-en-publicaties/nieuws/{title}/{id}`)
- Projecten (`projecten/`, title "Bouwen aan de stad"), Werkzaamheden, Veiligheid, Verkiezingen
- Over gemeente Leiden, Contact (`contact/`), English, Archiefwebsite, Privacy, Toegankelijkheid, Over deze site

### Content types

| Type | Where | Count | Notes |
|---|---|---|---|
| page | portal | ? | has ACF "Pagina-instellingen" + "Interne informatie" |
| person | portal | ? | tax `person-position-category`, `person-tax-party` |
| project | portal, hierarchical | ? | tax `project-type`, `project-district`, `project-status`, `project-language` |
| project-news | portal | ? | linked to project via ACF |
| yard-presets | portal | ? | block patterns, see 08 |
| pdc-item | OpenPDC | 280 published, 16 draft | 12 categories, 53 subcategories, 1 group |
| pdc-leges | OpenPDC | 21 | shortcode output |
| pdc-location | OpenPDC | 1 | |
| pdc-verordeningen | OpenPDC | 2 | |
| openpub-item | OpenPub | 506 published, 15 draft | DB may be Buren data, confirm |

Taxonomy slugs in the portal DB are prefixed `_ys_` (Fusion `prefix.taxonomy`). Example: `_ys_person-position-category`.

### Blocks seen on sampled pages

Homepage, `contact/`, `projecten/`, `nieuws-en-publicaties/nieuws/`: `core/cover`, `core/media-text`, `core/columns`, `core/heading`, `core/paragraph`, `core/buttons`, `core/button`, `core/social-links`, `core/gallery`, `core/latest-posts`, `core/post-template`, `core/term-template`, `core/spacer`, `core/pullquote`, `yard-blocks/icon`, `wpseopress/table-of-contents`, `wpseopress/local-business-field`.

Styles seen: `is-style-borders`, `is-style-logos-only`, `is-style-outlined`, `is-style-tile`, `is-style-two-columns`, `is-style-unstyled`. Class `pattern-cards` on columns.

Footer: three widget areas `sidebar-footer-1..3` with block widgets.

### External dependencies the old site renders at runtime

- OpenPDC REST `owc/pdc/v1` (themes, subthemes, items, items/internal, groups, locations)
- OpenPub REST `owc/openpub/v1` (items, items/active)
- Elasticsearch (JKC search over portal + openpdc + openpub indices, reactive-search UI)
- Weather XML feed (terrace temperature, `config/weather.php`)
- Holland Midden Veilig incident widget script (`wp_footer`)
- Google Maps (ACF `project_address`)

## Checklist

- [ ] Page list with template, parent, language, block names used (table below)
- [ ] Counts per CPT in the portal DB
- [ ] Terms per taxonomy (with `_ys_` prefix noted)
- [ ] Menus: primary, top bar, footer; which items are injected (PDC themes via `OpenPDCMenuItem`)
- [ ] Widgets in `sidebar-footer-1..3`
- [ ] Options pages: Spoedmelding (crisis banner) values
- [ ] Gravity Forms list and where embedded
- [ ] Redirects (`includes/redirect.conf`, `RedirectionsServiceProvider`)
- [ ] Sitemaps (SEOPress + external openpub/openpdc sitemaps)
- [ ] Reusable blocks (`wp_block`) and presets (`yard-presets`)
- [ ] Media: image sizes in use (old site keeps only thumbnail, medium, medium_large, large)
- [ ] Pages that use the terrace widget (`#js-terrace-temperature`), FAQ hash, identifications placeholder

## Deliverable: page inventory table

| URL | Template | Pattern / layout | Blocks | Notes |
|---|---|---|---|---|
| `/` | page | banner-home | cover, media-text, columns, … | |

## Open questions

- Which OpenPub DB is the real Leiden one? Local DB says Buren.
- Are `yard-servicepoints` / `plugin-yard-servicepoints` (not in composer) in use on live?
- Is the English section (`/english/`) a separate page tree or a language field on pages (`page_language`)?
