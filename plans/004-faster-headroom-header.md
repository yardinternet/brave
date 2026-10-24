# 004 — Make the hide/show header respond faster

- **Status**: TODO
- **Commit**: 8cd4c76
- **Severity**: MEDIUM
- **Category**: Easing & duration
- **Depends on**: 001 (uses the `ease-out` utility)
- **Estimated scope**: 1 file, 1 class attribute

## Problem

The sticky header slides out on scroll down and back in on scroll up (headroom.js via `@yardinternet/brave-frontend-kit`). That happens on every change of scroll direction, tens of times per visit. It takes 500ms with Tailwind's default curve `cubic-bezier(0.4, 0, 0.2, 1)`. When a user scrolls up to reach the navigation, the header is still sliding for half a second.

```blade
{{-- web/app/themes/sage/resources/views/sections/header.blade.php:1-2 — current --}}
<header id="js-brave-header"
	class="header justify shadow-xs headroom-pinned:translate-y-0 headroom-unpinned:-translate-y-full fixed z-50 w-full bg-white transition-transform duration-500">
```

## Target

300ms with the strong ease-out curve `cubic-bezier(0.23, 1, 0.32, 1)`. The header reacts immediately and settles softly.

```blade
<header id="js-brave-header"
	class="header justify shadow-xs headroom-pinned:translate-y-0 headroom-unpinned:-translate-y-full fixed z-50 w-full bg-white transition-transform duration-300 ease-out">
```

`transition-transform` in Tailwind 4 covers the `translate` property that `translate-y-*` uses. Keep it.

## Repo conventions to follow

- Easing is applied with a Tailwind `ease-*` utility next to `duration-*`, e.g. `ease-base … duration-300` in `web/app/themes/sage/resources/views/components/header/mega-dropdown.blade.php:5`.

## Steps

1. Confirm plan 001 is done: `grep -n "ease-out" web/app/themes/sage/resources/styles/base/theme.css` shows `--ease-out: cubic-bezier( 0.23, 1, 0.32, 1 );`. If not, STOP. Without it, `ease-out` resolves to Tailwind's weaker built-in curve.
2. In `web/app/themes/sage/resources/views/sections/header.blade.php` line 2, replace `duration-500` with `duration-300 ease-out`.

## Boundaries

- Do NOT change the headroom tolerances or anything in `node_modules`.
- Do NOT change the `headroom-pinned` / `headroom-unpinned` variants.
- Do NOT run `format:blade` over other files.

## Verification

- **Mechanical**: `pnpm run build:themes` succeeds. Inspect the header element and confirm computed `transition-duration: 0.3s` and `transition-timing-function: cubic-bezier(0.23, 1, 0.32, 1)`.
- **Feel check**: on a long page,
  - Scroll down. The header leaves without dragging.
  - Flick upward. The header is back within a glance, not sliding into place.
  - Reverse direction mid-slide. The header turns around smoothly from where it is (CSS transition retargets). It never jumps.
  - Test on a real phone as well. Touch scrolling changes direction often.
- **Done when**: header slides in 300ms with the `--ease-out` curve.
