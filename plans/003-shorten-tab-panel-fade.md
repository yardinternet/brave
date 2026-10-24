# 003 — Shorten the tab panel fade from 700ms to 200ms

- **Status**: TODO
- **Commit**: 8cd4c76
- **Severity**: HIGH
- **Category**: Easing & duration
- **Depends on**: 001 (uses `var( --ease-out )`)
- **Estimated scope**: 1 file, 1 line

## Problem

Switching tabs fades the new panel's content in over 700ms with the default `ease` curve. UI animations stay under 300ms. The user clicked a tab to read its content, and for most of a second that content is half-transparent. Tabs are also switched with arrow keys, which makes the delay feel even worse.

```css
/* web/app/themes/sage/resources/styles/blocks/tabs/shared.css:130-136 — current */
	&[aria-hidden='false'] {
		@apply block;

		> * {
			animation: fade 0.7s both;
		}
	}
```

The `fade` keyframe is defined in `web/app/themes/sage/resources/styles/base/motion.css` (opacity 0 to 1).

## Target

```css
		> * {
			animation: fade 200ms var( --ease-out ) both;
		}
```

`--ease-out` is `cubic-bezier(0.23, 1, 0.32, 1)`, added by plan 001. A keyframe is acceptable here: each tab switch shows a different panel that was `display: none`, so there is no mid-animation state to retarget.

## Repo conventions to follow

- CSS variables are written with spaces inside the parentheses: `var( --ease-out )`.

## Steps

1. Confirm plan 001 is done: `grep -n "ease-out" web/app/themes/sage/resources/styles/base/theme.css` shows `--ease-out: cubic-bezier( 0.23, 1, 0.32, 1 );`. If not, STOP.
2. In `web/app/themes/sage/resources/styles/blocks/tabs/shared.css`, replace `animation: fade 0.7s both;` with `animation: fade 200ms var( --ease-out ) both;`.

## Boundaries

- Do NOT change `motion.css` or the `fade` keyframe. Other code may use it.
- Do NOT change the tab button transitions in the same file.
- Do NOT add translate or scale to the panel.

## Verification

- **Mechanical**: `pnpm run lint:css` passes. `pnpm run build:themes` succeeds.
- **Feel check**: open a page with a Tabs block.
  - Click between tabs. The new content is readable almost immediately. There is a soft fade, not a slow reveal.
  - Use the arrow keys to move between tabs quickly. Content never lags noticeably behind the selected tab.
  - In DevTools Animations panel at 10% playback, confirm the fade lasts 200ms and is front-loaded (most opacity gained early).
  - Toggle `prefers-reduced-motion: reduce` in the Rendering panel. The panel appears instantly, as the global reduced-motion rule already enforces.
- **Done when**: the only animation on tab panels is the 200ms `--ease-out` fade.
