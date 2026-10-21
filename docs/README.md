# Leiden migration docs

Goal: rebuild gemeente Leiden on Brave with a pixel-identical frontend. The old site is Yard Fusion v5 with two headless OpenWebconcept sites (OpenPDC, OpenPub) consumed over REST. The new site is Bedrock + Acorn + Sage with `yard/brave-owc` so PDC items and news live in the portal itself.

## Sites

| Site | Local | Live | Status (2026-10-21) |
|---|---|---|---|
| New portal | https://leiden-brave.local/ | – | up, 55 pages (Brave scaffold content) |
| Old portal | https://leiden.local/ | https://gemeente.leiden.nl/ | up; PDC/OpenPub routes 404 because APIs unreachable |
| OpenPDC | https://leiden-openpdc.local/ | https://openpdc.leiden.nl/ | not running in Local; DB readable |
| OpenPub | https://leiden-openpub.local/ | https://openpub.leiden.nl/ | redirects to `/wp/`, `/wp-json` 404; DB readable but holds Buren data (see 02) |
| gemeentehw (reference) | https://gemeentehw.local/ | – | 502 locally; code readable |

Live URLs are down. Use local.

## Phases

| # | Doc | Scope | Status |
|---|---|---|---|
| 0 | [00-project-overview.md](00-project-overview.md) | Old vs new stack, paths, environment issues | ☐ |
| 1 | [01-inventory.md](01-inventory.md) | Inventory of old site: pages, CPTs, blocks per page, API dependencies | ☐ |
| 2 | [02-owc-content-models.md](02-owc-content-models.md) | Install `yard/brave-owc`, configure pdc-item / openpub-item | ☐ |
| 3 | [03-other-content-models.md](03-other-content-models.md) | Person, Project, Project news CPTs, taxonomies, meta | ☐ |
| 4 | [04-styling.md](04-styling.md) | Tokens, fonts, header, menu, search, footer | ☐ |
| 5 | [05-basic-blocks.md](05-basic-blocks.md) | Block inventory old vs new, theme blocks | ☐ |
| 6 | [06-block-styles-variations.md](06-block-styles-variations.md) | `is-style-*`, variations, block swaps | ☐ |
| 7 | [07-composite-blocks.md](07-composite-blocks.md) | Banner, standard page layout, cards | ☐ |
| 8 | [08-block-patterns.md](08-block-patterns.md) | Patterns from DB to code | ☐ |
| 9 | [09-remaining-functionality.md](09-remaining-functionality.md) | JS, plugins, hooks, templates, search, misc | ☐ |
| 10 | [10-content-migration.md](10-content-migration.md) | PDC items first, then the rest | ☐ |
| – | [content-migration-notes.md](content-migration-notes.md) | Ledger of every transform rule phases 3–9 produce | ongoing |

## How to use these docs

- Each phase doc has: what exists in the old site, what Brave offers, a checklist, open questions.
- Tick checklist items in place. Update the status column above when a phase is done.
- Anything that changes stored content goes in `content-migration-notes.md` immediately, not at the end.
- Open questions are questions for the team. Do not resolve them by guessing.

## Related

- Old portal repo: https://github.com/yardinternet/leiden
- Brave template: https://github.com/yardinternet/brave
- Scaffold commands: https://github.com/yardinternet/brave-scaffold#usage
- gemeentehw import example: `~/LocalSites/gemeentehw/app/public/web/app/themes/sage/app/Console/Commands/OpenPdcImport/`
