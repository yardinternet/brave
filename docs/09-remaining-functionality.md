# 09 – Remaining functionality

Goal: nothing from the old site is forgotten. Each row gets a decision: covered by Brave/package, port, drop, or ask.

## Custom JavaScript (`theme-fusion/assets/js/src/frontend/`)

| File | Purpose | Decision |
|---|---|---|
| `app.ts` | entry; Bootstrap collapse/dropdown/alert; registers `/sw.js` | replaced by `resources/scripts/frontend/frontend.js` |
| `components/Cards.ts` | hover class on cards with link | frontend-kit `A11yCards` |
| `components/Crisis.ts` | crisis banner dismiss | port if banner stays (04) |
| `components/CustomEventTracking.js` | analytics events | ask: which analytics, still needed |
| `components/FacetWP.ts` | refresh + scroll-to-top | frontend-kit `A11yFacetWP` |
| `components/Faq.ts` | open collapse matching `#faq` hash | ask: still needed with `yard/collapse`? |
| `components/FocusStyle.ts` | focus styling | frontend-kit `FocusStyle` |
| `components/Identifications.ts` | moves PDC DigiD blocks into content placeholder | drop; brave-owc renders server-side |
| `components/Links.ts` | external link handling | check frontend-kit; else port |
| `components/MobileMenu.ts` | mobile menu | frontend-kit `BraveNavigationManager` |
| `components/Navbar.ts` | headroom + dropdown hover | frontend-kit `Headroom` |
| `components/Table.ts` | scrollable, focusable tables | check frontend-kit; else port |
| `components/TableOfContents.js` | ToC with focus-trap | `yard/table-of-contents` |
| `components/TerraceWidget.ts` | fills `#js-terrace-temperature` from `yard/v1/terrace-temperature` REST (proxy of weather XML, `config/weather.php`) | ask: still wanted? If yes: Hook with REST route + small component |
| `components/PatternStandardPage.ts` | not imported; dead | drop |
| `oldTableOfContents.ts` | dead | drop |
| `search/*`, `views/*`, `config/config.js` | reactive-search app (Elasticsearch) | search decision below |
| `utils/a11y.ts`, `utils/slugify.ts` | helpers | drop unless a ported component needs them |

Footer-injected script: Holland Midden Veilig incident widget (`wp_footer` in `app/actions.php`, per environment) + `_vr-live-incident.scss`. Ask: keep?

## Plugins

| Old plugin | New status | Decision |
|---|---|---|
| advanced-custom-fields-pro, facetwp, gravityforms, wp-seopress(+pro), wp-migrate-db-pro, yard-dashboard | `composer private-packages` | install |
| gravity-forms-zero-spam, imagify, relay, user-switching, duplicate-post, yard-warden, query-monitor | already in Brave composer | – |
| enable-media-replace, filebird, post-expirator, onelogin-saml-sso | come with brave-owc | – |
| gravityformspolls | OpenPub polls | ask (02) |
| gravitysmtp | mail | ask: Brave default mail setup? |
| elasticpress, yard-elasticsearch | search | search decision |
| yard-blocks, block-visibility | blocks | drop; block-visibility ask (05) |
| config-expander | `yard/config-expander` in Brave | – |
| stream | audit log | Brave has `wordpress-simple-history`; drop stream |
| two-factor | login | ask: Brave standard? |
| generate-security-txt | security.txt | ask |
| yard-environments, yard-redis-purge, yard-shroud | infra | ask ops |
| yard-servicepoints / plugin-yard-servicepoints (not composer-managed) | ? | ask: in use on live? |

## Hooks and PHP (old `app/actions.php`, `app/filters.php`, providers)

| Old | New |
|---|---|
| theme supports, menus (`Actions/Setup`) | `app/Hooks/Setup.php` exists; adjust menu locations (primary, top_bar, footer) |
| sidebars / widgets | no widgets in Brave (04) |
| secure headers (`config/secure-headers.php`) | `app/Csp/Policy.php` (brave-csp) |
| Gravity Forms filters (`Filters/GravityForms`: autocomplete, disclaimer, NL phone, role=alert, html5, no legacy markup, no auto-update) + `SubmissionLimiter` | check what `yard/brave-hooks` / Brave defaults already do; port rest to `app/Hooks/GravityForms.php` |
| SEOPress filters (`Filters/SeoPress`: capability, external sitemaps openpdc/openpub) | external sitemaps obsolete; capability check |
| `facetwp_load_a11y` | Brave default? |
| `upload_mimes`, `wp_kses_allowed_html`, `map_meta_cap` | port what is still needed, ask per item |
| `embed_oembed_html` wrapper, `render_block` embed URL rewrite | check Brave embed styling |
| `the_password_form` | `app/Hooks/Theme.php` already has one |
| image sizes pruned to 4 | ask |
| `rest_api_init` terrace temperature | see JS table |
| `HTMLHeadMeta` OG/canonical for API pages | obsolete (content local) |
| `User/Admin.php`, `RolesAndCapabilities.php`, `config/capabilities.php`, `AddSuperUserRole` | `yard/wp-user-roles`, `config/user-roles.php` |
| `Search/SearchSettings` `?s=` → `/zoeken` | search decision |
| `Redirections` + `includes/redirect.conf` | ask: server-level or plugin (`relay` is in Brave) |
| `PWA` + `sw.js` + `config/pwa.php` | Brave has `yard/webmanifest`; service worker ask |
| `Sitemap/` views | SEOPress handles |
| `BlocksServiceProvider` transient cache exclusions | obsolete |
| `Jkc/` REST search, `config/jkc.php` | search decision |

## Blade templates

| Old (`theme-fusion/templates/`) | New |
|---|---|
| `layouts/app`, `layouts/main-sidebar` | `resources/views/layouts/` (Brave) |
| `404`, `archive`, `page`, `single`, `single-person`, `single-project`, `single-project-news` | same names in `resources/views/` |
| `partials/header*`, `footer`, `breadcrumbs` | `sections/` + brave components (04) |
| `partials/internal-information` | `<x-owc-internal-data>` (03) |
| `partials/project-documents` | project single (03) |
| `partials/social-share`, `table-of-contents` | blocks (05) |
| `partials/card/card-*` (default, event, location, location-basic, location-openings-message-today, project) | card component / query templates; event + location cards relate to listposts remote sources (05) |
| `partials/opening-hours/*` | openinghours block (05) |
| `blocks/FacetWp/*`, `blocks/ListPosts/*` | `resources/views/blocks/FacetWP/`, `vendor/yard-query-block/templates/` |
| `app/OpenPDC/views/*`, `app/OpenPub/views/*` | `single-pdc-item`, `single-openpub-item`, PDC patterns |

## Vendor CSS

Old `assets/scss/components/`: `_facetwp`, `_gravityforms`, `_yrs-*` (reactive-search), `_embed`, `_pagination`, `_load-icon`, `_feedback`. Brave has `resources/styles/vendor/{cookie-yes,facetwp,gravity-forms}.css`. Diff visually; add missing.

## Search

Old: Elasticsearch + ElasticPress + yard-elasticsearch, JKC combined index (portal, openpdc, openpub), reactive-search React UI in header, `/zoeken` page, autosuggest. With content in one DB the multi-index reason disappears. Options: SearchWP (private package) + FacetWP search template (`config/facetwp/templates/search.php` in gemeentehw), or keep ElasticPress. Ask before building. Pixel-perfect header search bar must be rebuilt either way.

## Checklist

- [ ] Every row above has a decision and, where ported, a file path
- [ ] Private packages installed
- [ ] Gravity Forms behaviour verified on a test form
- [ ] Redirect strategy decided and tested with 3 old URLs
- [ ] Search decided
- [ ] Nothing in old `app/` left unreviewed (`ls -R app` tick-off)
