# 03 – Other content models (Person, Project, Project news, Page)

Goal: same CPTs, taxonomies and fields as the old site, registered the Brave way. Use the `brave-post-type` skill per CPT. Old source: `app/Components/{Person,Project}/*`, `theme-fusion/acf-json/*.json`.

Old taxonomy slugs in the DB carry the `_ys_` prefix. New registrations use the bare slug. This is a migration transform, record it.

## Person

| | Old | New |
|---|---|---|
| Slug | `person` (Persoon / Personen, no archive) | `config/poet/post/person.php` |
| Taxonomies | `person-position-category` (Functiecategorie), `person-tax-party` (Politieke partij) | `config/poet/taxonomy/person-position-category.php`, `person-party.php` (gemeentehw uses `person_type`, `person_party`) |
| ACF group | `group_652e83bc820d9` Persooninstellingen | `app/FieldGroups/Person.php` |
| Fields | `person_position` (text), `person_portrait_image` (image), `person_connected` (relationship) | same keys unless Brave naming says otherwise |
| Tax meta | Functiecategorie: `person_position_category_breadcrumb_title`, `_url` | FieldGroup on taxonomy |
| Data | `PersonComposer` | `app/Data/PersonData.php` |
| Views | `templates/single-person.blade.php`, `partials/card/card-default` | `single-person.blade.php`, card component |
| Overview | ? (check inventory) | FacetWP template `config/facetwp/templates/person.php` if needed |

## Project

| | Old | New |
|---|---|---|
| Slug | `project`, hierarchical, no archive, overview page `/projecten/` | `config/poet/post/project.php` |
| Taxonomies | `project-type`, `project-district` (Stadsdeel), `project-status`, `project-language` | one file each under `config/poet/taxonomy/` |
| ACF group | `group_6580595386414` Project instellingen | `app/FieldGroups/Project.php` |
| Fields | `project_language`, `project_hide`, `project_is_information_page`, `project_start_date`, `project_end_date`, `project_logo`, `project_documents` (repeater), `project_external_documents` (repeater), `project_address` (google_map), `project_connection_to_news` | same keys; google_map needs API key hook (old: `acf/fields/google_map/api`) |
| Data | `Project.php` model + composer, `Project/Document/Document.php` | `app/Data/ProjectData.php` |
| Views | `single-project.blade.php`, `partials/project-documents`, `card/card-project` | `single-project.blade.php` |
| Overview | FacetWP template `templates/blocks/FacetWp/view/custom/projects.blade.php` + `loops/projects-loop` | `config/facetwp/templates/project.php`, `resources/views/blocks/FacetWP/loops/project-loop.blade.php` |

## Project news

| | Old | New |
|---|---|---|
| Slug | `project-news` (rewrite `project-nieuws`), menu under project | `config/poet/post/project-news.php` |
| Taxonomies | none | – |
| ACF | `group_65b2268555e0b`: `project_news_connection_to_project` (relationship) | `app/FieldGroups/ProjectNews.php` |
| Views | `single-project-news.blade.php` | |

## Page extras

| Old | Fields | New |
|---|---|---|
| `group_652e639b4db1f` Pagina-instellingen | `page_language`, `page_hide_feedback_form`, `page_connected_posts`, `page_connected_links`, `page_connected_links_english` | `app/FieldGroups/PageSettings.php`; feeds `theme/connected-posts` block (see 05) |
| `group_652e6927bd656` Interne informatie (page, person, project, project-news) | `internal_information_title`, `internal_information_content` | brave-owc ships `internal-data` (`internal_information` repeater) on page, pdc-item, openpub-item. Decide: reuse brave-owc group and extend post types, or own group. Record mapping. |
| `app/PostTypes/Page.php` overrides | ? | check what it changes |

## Options

| Old | New |
|---|---|
| `ui_options_page_652e90a945e2f` Spoedmelding (crisis banner), `group_62582b4fd7b5d`, rendered by `CrisisServiceProvider` on `wp_after_navigation` | `config/acf.php` `option_pages` + FieldGroup; render in header partial. Brave `theme/alert` block may cover the markup. |

## Checklist

- [ ] Person: poet post + 2 taxonomies + FieldGroup + Data + single + card
- [ ] Project: poet post + 4 taxonomies + FieldGroup + Data + single + FacetWP overview
- [ ] Project news: poet post + FieldGroup + single
- [ ] Page settings FieldGroup
- [ ] Internal information: decision + FieldGroup
- [ ] Spoedmelding options page
- [ ] Verify each in admin and on a test post; check REST (`show_in_rest`) where the editor needs it
- [ ] `content-migration-notes.md`: per CPT the old→new slug, taxonomy slug (strip `_ys_`), meta key table

## Open questions

- Keep old field keys 1:1 (simplest migration) or rename to Brave conventions where gemeentehw differs?
- `project-language` and `page_language`: is the English section driven by these, and does Brave have a language convention?
- `project_address` google_map: Brave has `brave-facetwp-map` skill; is a map used anywhere on the frontend?
