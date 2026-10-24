# 001 — Add strong easing tokens to the Tailwind theme

- **Status**: DONE
- **Commit**: 8cd4c76
- **Severity**: LOW (prerequisite for 003–006)
- **Category**: Cohesion & tokens
- **Estimated scope**: 1 file, 2 lines

## Problem

The theme has one easing token, and it is identical to the built-in CSS `ease` keyword. There is no strong ease-out curve for entrances and no drawer curve. Components fall back to Tailwind's default `cubic-bezier(0.4, 0, 0.2, 1)` or this weak token.

```css
/* web/app/themes/sage/resources/styles/base/theme.css:74-75 — current (inside `@theme static { … }`) */
	/* Transitions */
	--ease-base: cubic-bezier( 0.25, 0.1, 0.25, 1 );
```

## Target

Two new tokens next to `--ease-base`. Because they live in `@theme`, Tailwind generates the utilities `ease-out` and `ease-drawer`, and the CSS variables `--ease-out` / `--ease-drawer` are emitted on `:root`.

```css
	/* Transitions */
	--ease-base: cubic-bezier( 0.25, 0.1, 0.25, 1 );
	--ease-out: cubic-bezier( 0.23, 1, 0.32, 1 );
	--ease-drawer: cubic-bezier( 0.32, 0.72, 0, 1 );
```

`--ease-out` deliberately overrides Tailwind's built-in `--ease-out` (`cubic-bezier(0, 0, 0.2, 1)`). The theme does not use the `ease-out` utility anywhere yet, so nothing existing changes.

## Repo conventions to follow

- Theme tokens live in `web/app/themes/sage/resources/styles/base/theme.css` inside `@theme static { … }`.
- Formatting uses spaces inside parentheses: `cubic-bezier( 0.25, 0.1, 0.25, 1 )`. Match it.

## Steps

1. In `web/app/themes/sage/resources/styles/base/theme.css`, directly below the line `--ease-base: cubic-bezier( 0.25, 0.1, 0.25, 1 );`, add:
   ```css
   	--ease-out: cubic-bezier( 0.23, 1, 0.32, 1 );
   	--ease-drawer: cubic-bezier( 0.32, 0.72, 0, 1 );
   ```

## Boundaries

- Do NOT change `--ease-base` or any other token.
- Do NOT add `--ease-in-out`. The hamburger in `mobile-menu.blade.php` uses Tailwind's built-in `ease-in-out`.
- Do NOT touch any component in this plan.
- If `--ease-base` is no longer at that location (drift since the commit stamp), STOP and report.

## Verification

- **Mechanical**: `pnpm run lint:css` passes. `pnpm run build:themes` succeeds.
- **Check**: in the browser, run `getComputedStyle(document.documentElement).getPropertyValue('--ease-out')` and confirm it returns the new curve. Same for `--ease-drawer`.
- **Done when**: both variables resolve on `:root` and the build is green.
