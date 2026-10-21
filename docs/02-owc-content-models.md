# 02 – OWC content models (OpenPDC + OpenPub)

Goal: `pdc-item` and `openpub-item` exist in the portal with the same taxonomies and fields Leiden uses today, through `yard/brave-owc`. The headless sites and the REST client code (`app/OpenPDC`, `app/OpenPub`, listposts remote sources, JKC) are not ported.

## Install

```
composer run gemeente-packages          # requires yard/brave-owc
wp acorn vendor:publish --provider="Yard\OWC\OWCServiceProvider"
```

Publishes `config/owc.php`. Package provides (gemeentehw, brave-owc ^4):

- Plugins: `pdc-base`, `pdc-faq`, `pdc-leges`, `pdc-samenwerkende-catalogi`, `pdc-verordeningen`, `openpub-base`, meta-box + addons, enable-media-replace, filebird, post-expirator, onelogin-saml-sso, extended-cpts
- Hooks `Yard\OWC\Hooks\{OpenPDC,OpenPub}`: relabels, removes taxonomies, sets capabilities, cleans metaboxes
- Data classes `PDCItemData`, `PDCGroupTermData`, `OpenPubItemData`
- Components `<x-owc-internal-data>`, `<x-owc-pdc-icon>`
- ACF groups `pdc-settings` (`_owc_pdc_active`), `pdc-icon` (`pdc_fa_icon`), `internal-data` (`internal_information` repeater)
- RSS route `/nieuws/feed`

Reference: `~/LocalSites/gemeentehw/app/public/vendor/yard/brave-owc/` and the theme override `web/app/themes/sage/config/owc.php` (makes `pdc-group` hierarchical, adds it to `page`).

## OpenPDC: what Leiden uses

Source: `~/LocalSites/leiden-openpdc/app/public`, plugin `pdc-base` 3.11.1, option `_owc_pdc_base_settings`.

| Setting | Value | Consequence for portal |
|---|---|---|
| portal item slug | `inwoners-en-ondernemers/` | URL base for pdc-item |
| include theme / subtheme in URL | 1 / 1 | `/inwoners-en-ondernemers/{thema}/{subthema}/{item}` |
| include id in URL | 0 | no numeric id |
| pdc-group layer | on | 1 group published; gemeentehw keeps `pdc-group` |
| identifications | on, combined off | DigiD / eHerkenning / eIDAS blocks per item |
| escape element, show-on, feedback form | off | can drop |
| Samenwerkende Catalogi | Gemeente Leiden, OWMS URI set | `pdc-samenwerkende-catalogi` stays |

Taxonomies on `pdc-item` and term counts in the OpenPDC DB:

| Taxonomy | Terms | gemeentehw | Decision |
|---|---|---|---|
| `pdc-doelgroep` | 7 | kept | keep |
| `pdc-aspect` (slug `pdc-kenmerk`) | 17 | kept | keep |
| `pdc-type` | 2 | removed | ask |
| `pdc-usage` | 0 | removed | drop |
| `pdc-owner` ("Inhoudsdeskundige") | 0 | kept (caps) | ask |
| `pdc-show-on` | 0 | – | drop (setting off) |

Category / subcategory are CPTs in OpenPDC (`pdc-category` 12, `pdc-subcategory` 53). gemeentehw makes them non-public and relies on `pdc-group` for grouping. Decide how Leiden's theme → subtheme → item hierarchy maps.

Fields the OpenPDC theme removed (`themes/owc-pdc/src/hooks.php`): alternative title, appointment, links, downloads, forms, "Overig". Remaining per item: `pdc_active`, `pdc_tags`, `pdc_upl_naam`, language, category icon, identifications (`digid`, `eherkenning`, `eidas`, `general_identification`), FAQ (`pdc_faq_group`), internal data (`pdc_internaldata`), expiration date.

Sub-plugins present: pdc-faq, pdc-internal-products, pdc-locations (1 location), pdc-leges (21), pdc-verordeningen (2), pdc-samenwerkende-catalogi, pdc-expiration-date. brave-owc does not ship pdc-locations, pdc-internal-products, pdc-expiration-date.

## OpenPub: what Leiden uses

Source: `~/LocalSites/leiden-openpub/app/public`, plugin `openpub-base` 3.7.6. gemeentehw turns `openpub-item` into "Nieuwsberichten" with slug `nieuws`, hierarchical, no archive, and removes location / theme / subtheme.

| Item | OpenPub | Old portal | Decision |
|---|---|---|---|
| URL | – | `nieuws-en-publicaties/nieuws/{title}/{id}` | slug `nieuws-en-publicaties/nieuws`, id dropped → redirects |
| Taxonomies | audience 7, type 10, usage 5, subject 2 (theme-added), show-on | type/audience/usage used as listposts filters | ask which to keep |
| Fields | expiration date, notes (others removed by theme) | | |
| Comments + polls | `owc/polls/v1/items` (Gravity Forms Polls) | | ask: still used? |
| Redirection notifications | theme feature storing old portal URL | | covered by migration redirects |
| RSS | – | `actueel-feed` in `app/OpenPub/RSS` | brave-owc `/nieuws/feed` |

## Checklist

- [ ] Start `leiden-openpdc` in Local; confirm settings above against the admin
- [ ] Confirm which OpenPub DB is Leiden's
- [ ] `composer run gemeente-packages`, publish config, run `wp acorn` without errors
- [ ] `config/owc.php`: taxonomies, labels, slugs as decided above
- [ ] Theme Hook class (only if brave-owc defaults differ from the table) in `app/Hooks/`, registered in `config/hooks.php`
- [ ] Single templates: `single-pdc-item.blade.php`, `single-openpub-item.blade.php` (see gemeentehw)
- [ ] Patterns `pdc-page-detail`, `pdc-page-overview(-groups)` (see 08)
- [ ] Verify in admin: post types visible, taxonomies attached, fields present; create one test item of each and view it
- [ ] Record meta keys and term slugs in `content-migration-notes.md`

## Open questions

- `pdc-type` (2 terms), `pdc-owner`: keep or drop?
- Keep pdc-locations (1 item) or turn it into page content?
- Internal products (`items/internal`, basic auth, `interne-data/{slug}` route): still needed in the portal? If yes, how is access restricted without the headless split?
- OpenPub comments and polls: in use?
- Search: ES indices for pdc/openpub disappear; see 09.
