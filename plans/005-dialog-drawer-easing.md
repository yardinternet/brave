# 005 — Give the three dialogs a drawer curve and narrow `transition-all`

- **Status**: TODO
- **Commit**: 8cd4c76
- **Severity**: MEDIUM
- **Category**: Easing & duration / Performance
- **Depends on**: 001 (uses the `ease-drawer` utility)
- **Estimated scope**: 3 Blade files, 2 class strings each

## Problem

The mobile menu, the search bar and the mobile FacetWP filters are native `<dialog>` elements. They slide in with `@starting-style` (Tailwind's `starting:` variant) and `transition-discrete`. That structure is right. The motion values are not:

- All three take 500ms on Tailwind's default curve `cubic-bezier(0.4, 0, 0.2, 1)`. That is at the ceiling of the drawer budget, with a curve that eases in too gently at the start. The search bar in particular is opened to type immediately (its input has `autofocus`).
- `transition-all` transitions every property that changes, not only the ones meant to move.

```blade
{{-- web/app/themes/sage/resources/views/components/header/mobile-menu.blade.php:21-22 — current --}}
	'mobile-menu transition-discrete top-0 bottom-0 left-10 right-0 h-full max-h-full w-auto max-w-full transform-[translateX(100%)] bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
```

```blade
{{-- web/app/themes/sage/resources/views/components/header/search-bar.blade.php:16-17 — current --}}
	'search-bar transition-discrete h-(--combined-bar-height) px-3 w-full max-w-full transform-[translateY(-100%)] bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
```

```blade
{{-- web/app/themes/sage/resources/views/components/facetwp/mobile-filters.blade.php:13-14 — current --}}
	'transition-discrete z-1 max-h-3/4 mt-auto h-fit w-full max-w-full transform-[translateY(100%)] rounded-t-lg bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
```

## Target

- Curve: `cubic-bezier(0.32, 0.72, 0, 1)` (the iOS-like drawer curve, token `--ease-drawer` from plan 001).
- Duration: 400ms for the two drawers (mobile menu, filters). 300ms for the search bar, which travels a short distance and is opened to type.
- Properties: the panel transitions only `transform, opacity, display, overlay`. The backdrop transitions only `background-color, display, overlay`. `display` and `overlay` must stay in the list. Together with `transition-discrete` they keep the dialog in the top layer until the exit transition finishes. Dropping them breaks the close animation.

Resulting strings:

```blade
{{-- mobile-menu.blade.php --}}
	'mobile-menu transition-discrete top-0 bottom-0 left-10 right-0 h-full max-h-full w-auto max-w-full transform-[translateX(100%)] bg-white opacity-0 transition-[transform,opacity,display,overlay] duration-400 ease-drawer',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-[background-color,display,overlay] backdrop:duration-400 backdrop:ease-drawer',

{{-- search-bar.blade.php --}}
	'search-bar transition-discrete h-(--combined-bar-height) px-3 w-full max-w-full transform-[translateY(-100%)] bg-white opacity-0 transition-[transform,opacity,display,overlay] duration-300 ease-drawer',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-[background-color,display,overlay] backdrop:duration-300 backdrop:ease-drawer',

{{-- mobile-filters.blade.php --}}
	'transition-discrete z-1 max-h-3/4 mt-auto h-fit w-full max-w-full transform-[translateY(100%)] rounded-t-lg bg-white opacity-0 transition-[transform,opacity,display,overlay] duration-400 ease-drawer',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-[background-color,display,overlay] backdrop:duration-400 backdrop:ease-drawer',
```

## Repo conventions to follow

- Dialog motion lives entirely in the Blade `@class([...])` arrays shown above. Keep it there. Do not move it to CSS files.
- The `starting:open:` and `open:` lines (the third and fourth strings in each array) stay exactly as they are.

## Steps

1. Confirm plan 001 is done: `grep -n "ease-drawer" web/app/themes/sage/resources/styles/base/theme.css` returns the token. If not, STOP.
2. In `web/app/themes/sage/resources/views/components/header/mobile-menu.blade.php`, replace lines 21-22 with the mobile-menu strings from Target.
3. In `web/app/themes/sage/resources/views/components/header/search-bar.blade.php`, replace lines 16-17 with the search-bar strings from Target.
4. In `web/app/themes/sage/resources/views/components/facetwp/mobile-filters.blade.php`, replace lines 13-14 with the mobile-filters strings from Target.

## Boundaries

- Only the first two strings of each `@class` array change. Do NOT touch the `starting:open:` / `open:` strings, the trigger buttons, or the dialog contents.
- Do NOT touch the hover classes on the search/close buttons in `search-bar.blade.php` (lines 27 and 32). That is a separate finding.
- Do NOT change the slide directions or remove the opacity fade.
- If any line does not match the excerpt, STOP and report.

## Verification

- **Mechanical**: `pnpm run build:themes` succeeds. In DevTools, inspect each open dialog and confirm computed `transition-property` lists exactly `transform, opacity, display, overlay`.
- **Feel check** (mobile viewport for menu and filters, any viewport for search):
  - Open the mobile menu. It moves fast at the start and settles softly into place, not with an even glide.
  - Close it with the X and with Escape. It slides **out**. It does not vanish instantly. This is the regression to watch for: if close is instant, `display`/`overlay` are missing from the transition list.
  - The backdrop fades in and out in step with the panel.
  - Open search and start typing immediately. The bar is already in place.
  - Open the filters on a FacetWP archive at mobile width. Same check as the menu.
  - DevTools Animations panel at 10%: panel curve is front-loaded, durations 400ms / 300ms / 400ms.
  - Toggle `prefers-reduced-motion: reduce`. Dialogs open and close instantly, as the global rule in `base.css` enforces.
- **Done when**: all three dialogs open and close with `--ease-drawer` at the durations above, and close still animates.
