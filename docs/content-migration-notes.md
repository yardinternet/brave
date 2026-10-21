# Content migration notes (ledger)

Append a row the moment a decision changes how stored content must be transformed. Phase 10 reads this file, nothing else. Keep rows atomic: one old thing → one new thing → one rule.

Status: `todo` (rule written, not implemented), `done` (transform implemented and tested), `n/a` (decided not needed).

| Phase | Old | New | Transform rule | Status |
|---|---|---|---|---|
| 03 | taxonomy slugs `_ys_<slug>` | `<slug>` | strip `_ys_` prefix when importing terms and term relationships | todo |
| 03 | `person-tax-party` | tbd | rename if Brave slug differs | todo |
| 05 | `yard-blocks/collapse`, `yard-blocks/collapse-item` | `yard/collapse`, `yard/collapse-item` | rename block comment; check subtitle attribute | todo |
| 05 | `yard-blocks/iconlist`, `yard-blocks/iconlist-item` | `yard/iconlist`, `yard/iconlist-item` | rename block comment | todo |
| 05 | `yard-blocks/icon` | `yard/icon` | rename block comment; verify icon name set | todo |
| 05 | `yard-blocks/facetwp` | `yard/facetwp` | rename; template names from `config/facetwp/templates` | todo |
| 05 | `yard-blocks/listposts` (remote sources) | `yard/query` | per layout attribute map (05) | todo |
| 05 | `theme/page-attributes-parent` | `theme/back-button` | replace block | todo |
| 05 | `theme/timeline`, `theme/timeline-item` (static) | `yard/timeline`, `yard/timeline-item` | rebuild inner markup from saved HTML | todo |
| 05 | `theme/table-of-contents` | `yard/table-of-contents` | replace block, drop attrs | todo |
| 06 | `core/list.is-style-arrow-left` | `yard/iconlist` | convert list items to iconlist items with arrow icon | todo |
| 06 | `core/group.is-style-alert` | `theme/alert` | wrap inner blocks | todo |
| 06 | `core/spacer` variation `spacer-with-steps` | Brave spacer presets | map preset 1–7 to new presets | todo |
| 06 | `core/group` variation `group-with-background` | `theme/group` or `theme/section` | map background attr | todo |
| 07 | `core/media-text.pattern-banner` | `theme/banner` | attribute map (07) | todo |
| 07 | `core/columns.pattern-standard-page` (`main-column` / `sidebar-column`) | `layout-article-aside` (`theme/article` + aside) | restructure columns | todo |
| 07 | `core/columns.pattern-cards` | `cards-2` / `cards-3` with `theme/card` | restructure | todo |
| 07 | PDC identifications placeholder in content | removed | strip placeholder; brave-owc renders | todo |
| 08 | `yard-presets` posts | `config/poet.php` patterns | pages created from presets: see 08 table | todo |
| 02 | OpenPub URL `nieuws-en-publicaties/nieuws/{title}/{id}` | `nieuws-en-publicaties/nieuws/{title}` | redirect rule | todo |
| 02 | PDC URL `inwoners-en-ondernemers/{thema}/{subthema}/{item}` | same | redirect only if slug changes | todo |
