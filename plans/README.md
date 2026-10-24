# Animation plans

Audit of the Sage theme's motion (`web/app/themes/sage/resources`) at commit `8cd4c76`. Each plan is self-contained and can be handed to any agent.

| # | Plan | Severity | Status |
| --- | --- | --- | --- |
| 001 | [Add strong easing tokens](001-add-motion-easing-tokens.md) | LOW (prereq) | TODO |
| 002 | [Stop animating the keyboard focus ring](002-remove-focus-ring-animation.md) | HIGH | TODO |
| 003 | [Shorten tab panel fade to 200ms](003-shorten-tab-panel-fade.md) | HIGH | TODO |
| 004 | [Faster hide/show header](004-faster-headroom-header.md) | MEDIUM | TODO |
| 005 | [Drawer curve for the three dialogs](005-dialog-drawer-easing.md) | MEDIUM | TODO |
| 006 | [Desktop nav dropdowns and underline](006-desktop-nav-dropdown-motion.md) | MEDIUM | TODO |

## Execution order

1. **001** first. Plans 003–006 use its tokens and stop if it is missing.
2. **002** has no dependencies and can run anytime, including in parallel with 001.
3. **003, 004, 005, 006** in any order after 001. They touch disjoint files.

## Findings not yet planned

- **Button press snaps.** `is-button` scales to 0.98 on `:active` but only transitions colors, so the press has no easing (`styles/base/utilities.css:112-116`).
- **Card hover.** Cards use `transition-all`, and the lift on raw `:hover` is not gated for touch devices (`views/components/card.blade.php:3`, `styles/components/cards.css:1-6`, `scripts/blocks/card/style.css:8-16`).
- **`transition-all` and slow hovers elsewhere.** The search bar buttons take 500ms for a hover color change. Collapse, select, pagination, social links and the reset icon also use `transition-all`. The hamburger lines have transitions that nothing triggers.
- **Mobile submenu opens instantly.** Its chevron rotates but the list snaps from `hidden` to `block` (`views/components/header/mobile-menu.blade.php:48`).

## Noted, not reported

- The global `motion-reduce` rule in `styles/base/base.css` removes all transitions, including opacity. That is a documented choice (it cites web.dev).
- The accordion's 400ms duration lives in `@yardinternet/brave-frontend-kit`, outside this repo.
