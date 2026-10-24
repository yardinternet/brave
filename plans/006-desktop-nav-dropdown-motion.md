# 006 — Desktop navigation: ease-out dropdowns, horizontal underline

- **Status**: DONE
- **Commit**: 8cd4c76
- **Severity**: MEDIUM
- **Category**: Easing & duration / Physicality
- **Depends on**: 001 (uses the `ease-out` utility)
- **Estimated scope**: 3 Blade files, 1 class string each

## Problem

Desktop navigation is hovered constantly. Three things are off:

1. **Dropdowns enter with plain `ease`.** `ease-base` is `cubic-bezier(0.25, 0.1, 0.25, 1)`, the same as CSS `ease`. Entrances need a strong ease-out so the menu responds the moment the pointer arrives. Both dropdowns also use `transition-all`. The mega dropdown takes 300ms, too long for a hover menu.
2. **The active/hover underline grows from a dot.** `scale-0` scales both axes from zero, so a 4px bar balloons out of its center point. An underline should grow horizontally only.
3. **The underline transitions every property.** It sets `duration-300` with no `transition-*` utility, so the browser default `transition-property: all` applies.

```blade
{{-- web/app/themes/sage/resources/views/components/header/dropdown.blade.php:5 — current --}}
	    'ease-base invisible absolute min-w-60 -translate-y-3 bg-white leading-snug opacity-0 shadow-md transition-all',
```

```blade
{{-- web/app/themes/sage/resources/views/components/header/mega-dropdown.blade.php:5 — current --}}
	    'ease-base invisible fixed left-1/2 z-10 w-(--container-width) -translate-x-1/2 -translate-y-6 columns-3 gap-x-6 bg-white p-8 leading-snug opacity-0 shadow-lg transition-all duration-300',
```

```blade
{{-- web/app/themes/sage/resources/views/components/header/navigation.blade.php:26-29 — current --}}
						<span @class([
							'bg-primary ease-base absolute bottom-0 w-full left-0 h-1 duration-300 invisible scale-0 group-hover:visible group-hover:scale-100',
							'visible scale-100' => $item->active || $item->activeParent,
						]) aria-hidden="true"></span>
```

## Target

Values: curve `cubic-bezier(0.23, 1, 0.32, 1)` (the `ease-out` utility after plan 001), 200ms for every piece.

In Tailwind 4, `translate-*` utilities set the CSS `translate` property and `scale-*` set the `scale` property, not `transform`. The transition lists below name those properties. `visibility` must be in the dropdown lists: it keeps the menu visible until the fade-out finishes and flips it visible immediately on open.

```blade
{{-- dropdown.blade.php:5 --}}
	    'ease-out invisible absolute min-w-60 -translate-y-3 bg-white leading-snug opacity-0 shadow-md transition-[translate,opacity,visibility] duration-200',

{{-- mega-dropdown.blade.php:5 --}}
	    'ease-out invisible fixed left-1/2 z-10 w-(--container-width) -translate-x-1/2 -translate-y-6 columns-3 gap-x-6 bg-white p-8 leading-snug opacity-0 shadow-lg transition-[translate,opacity,visibility] duration-200',

{{-- navigation.blade.php:27-28 --}}
							'bg-primary ease-out absolute bottom-0 w-full left-0 h-1 transition-[scale,visibility] duration-200 invisible scale-x-0 group-hover:visible group-hover:scale-x-100',
							'visible scale-x-100' => $item->active || $item->activeParent,
```

`scale-x-0` is a deliberate exception to "never scale from 0". This is a line growing along its own axis, a standard underline reveal, not an object appearing from nothing.

## Repo conventions to follow

- Motion classes live in the Blade `@class([...])` / `$attributes->class([...])` arrays. Keep them there.
- The second line of each dropdown array (`group-has-aria-expanded:…`) stays unchanged.

## Steps

1. Confirm plan 001 is done: `grep -n "ease-out" web/app/themes/sage/resources/styles/base/theme.css` shows `--ease-out: cubic-bezier( 0.23, 1, 0.32, 1 );`. If not, STOP.
2. In `web/app/themes/sage/resources/views/components/header/dropdown.blade.php` line 5, replace the string with the dropdown string from Target.
3. In `web/app/themes/sage/resources/views/components/header/mega-dropdown.blade.php` line 5, replace the string with the mega-dropdown string from Target.
4. In `web/app/themes/sage/resources/views/components/header/navigation.blade.php`, replace lines 27 and 28 with the two navigation lines from Target.

## Boundaries

- Do NOT change `dropdown-item.blade.php` or the hover arrow inside it.
- Do NOT change the translate distances (`-translate-y-3`, `-translate-y-6`) or the `group-has-aria-expanded:` line.
- Do NOT touch `BraveNavigation` in `node_modules`. Do NOT add hover delays.
- Do NOT touch the mobile menu.
- If any line does not match the excerpt, STOP and report.

## Verification

- **Mechanical**: `pnpm run build:themes` succeeds. Inspect an open dropdown and confirm computed `transition-property: translate, opacity, visibility` and `transition-timing-function: cubic-bezier(0.23, 1, 0.32, 1)`.
- **Feel check** at desktop width (≥ 1024px):
  - Hover a nav item with children. The dropdown is there the moment the pointer lands and settles softly. It no longer drifts in.
  - Move the pointer away quickly and back again. The dropdown reverses from its current position. It never restarts from hidden.
  - Sweep the pointer across all top-level items. The underline grows horizontally from the center and stays 4px tall the whole time. No dot, no ballooning.
  - The active page's underline is fully visible on load, with no animation.
  - DevTools Animations panel at 10%: underline height stays constant while width grows.
  - Keyboard: Tab to a nav item and open its dropdown. It still appears (visibility is not stuck hidden).
- **Done when**: both dropdowns and the underline use `ease-out` at 200ms with the property lists above, and the underline scales on the x-axis only.
