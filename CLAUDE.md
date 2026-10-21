# Leiden Brave

Migration of gemeente Leiden from the old Fusion site to this Brave project. Frontend stays pixel-identical; every underlying technique moves to Brave conventions. Read `docs/README.md` first, then the phase doc you are working on.

## Working rules

- Always ask, never assume. Anything odd, missing or contradictory in the old site, the APIs or these docs: stop and ask.
- Brave standards win. Do not copy Fusion code or structure blindly. Use the Brave way (Poet configs, `app/Hooks` attributes, `app/FieldGroups`, `app/Data`, `config/blocks.php`, Tailwind v4 tokens). Unsure which way is "the Brave way": ask.
- Prove it, don't assume it. Verify in the real browser (Claude in Chrome, Chrome DevTools MCP) and in the database (`wp` cli). Use existing pages where possible, create test pages when needed, deliberately break things to confirm behaviour.
- No redesign. Compare against `https://leiden.local/` for every visual change.
- Every decision that affects stored content (block renames, class renames, meta keys, term slugs, pattern renames) goes into `docs/content-migration-notes.md` the moment it is made.
- Prefer existing skills: `brave-post-type`, `brave-gutenberg-block`, `brave-install-fonts`, `brave-facetwp-*`.

## Sites

| Site | Local | Live (down) |
|---|---|---|
| New portal (this repo) | https://leiden-brave.local/ | – |
| Old portal (Fusion) | https://leiden.local/ | https://gemeente.leiden.nl/ |
| OpenPDC (headless, old) | https://leiden-openpdc.local/ | https://openpdc.leiden.nl/ |
| OpenPub (headless, old) | https://leiden-openpub.local/ | https://openpub.leiden.nl/ |
| Reference project | `~/LocalSites/gemeentehw` | – |

Old repos on disk: `~/LocalSites/leiden/app/public` (theme at `htdocs/wp-content/themes/theme-fusion`), `~/LocalSites/leiden-openpdc/app/public`, `~/LocalSites/leiden-openpub/app/public`.

## Docs

- `docs/README.md` – index, phase table, status
- `docs/00-project-overview.md` – old vs new stack
- `docs/01-inventory.md` … `docs/10-content-migration.md` – one doc per phase
- `docs/content-migration-notes.md` – running ledger for the content migration phase
