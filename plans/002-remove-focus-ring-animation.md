# 002 — Stop animating the keyboard focus ring

- **Status**: TODO
- **Commit**: 8cd4c76
- **Severity**: HIGH
- **Category**: Purpose & frequency
- **Estimated scope**: 1 file, ~15 lines removed

## Problem

Every Tab press animates the focus ring in from 16px away. Keyboard navigation is the highest-frequency interaction there is: a keyboard user fires this dozens of times per page. Keyboard-initiated actions should never animate. The ring should simply be there. It also animates `outline-offset`, which repaints on every frame.

The `.js-user-is-tabbing` class is added to `<body>` by `FocusStyle` from `@yardinternet/brave-frontend-kit` on the first Tab key press, so this animation only ever runs for keyboard users.

```css
/* web/app/themes/sage/resources/styles/base/base.css:105-138 — current */
/* All focusable elements */
input[type='radio']:focus + label,
input[type='checkbox']:focus + label,
input:focus:not( [type='radio'], [type='checkbox'] ),
textarea:focus,
a:focus,
button:focus,
select:focus,
area:focus,
iframe:focus,
details:focus {
	outline-width: 0;

	.js-user-is-tabbing & {
		animation: focus 0.1s linear both;
		outline-color: -webkit-focus-ring-color;
		outline-style: auto;
	}
}

@keyframes focus {
	0% {
		outline-offset: 16px;
		outline-style: auto;
		outline-width: 0px;
	}

	100% {
		z-index: 9999;
		outline-offset: 4px;
		outline-style: auto;
		outline-width: 2px;
	}
}
```

## Target

The keyframe's end state, applied statically. Same visual result, no motion.

```css
	.js-user-is-tabbing & {
		z-index: 9999;
		outline-color: -webkit-focus-ring-color;
		outline-offset: 4px;
		outline-style: auto;
		outline-width: 2px;
	}
```

`z-index: 9999` was previously applied through the animation's `both` fill mode. Keep it so focused elements still stack above neighbours.

## Repo conventions to follow

- Properties inside a rule are sorted alphabetically (see the current block: `animation`, `outline-color`, `outline-style`). Keep that order.
- Tabs for indentation.

## Steps

1. In `web/app/themes/sage/resources/styles/base/base.css`, replace the `.js-user-is-tabbing & { … }` block (the three lines `animation: focus 0.1s linear both;`, `outline-color: …`, `outline-style: auto;`) with the Target block above.
2. In the same file, delete the entire `@keyframes focus { … }` block.
3. Search the theme for other uses of the keyframe name: `grep -rn "focus 0\|animation: focus\|animation-name: focus" web/app/themes/sage/resources`. Expect zero matches. If there are matches, STOP and report.

## Boundaries

- Do NOT change the selector list or the `outline-width: 0;` default.
- Do NOT touch the `@variant motion-reduce` block below it.
- Do NOT touch `FocusStyle` or anything in `node_modules`.
- If the code does not match the excerpt (drift since the commit stamp), STOP and report.

## Verification

- **Mechanical**: `pnpm run lint:css` passes. `pnpm run build:themes` succeeds.
- **Feel check**: load any page, press Tab repeatedly.
  - The ring appears instantly at 4px offset on each element. There is no zoom-in.
  - Tab through: a header nav link, the search button, a `.is-button`, a text input and a select inside a Gravity Form, and a checkbox label. Each shows the ring. Animated values used to override normal declarations, so a static value can lose to a more specific rule. If any of these elements lost its ring, STOP and report which one.
  - Click with the mouse after tabbing. The ring disappears (body class removed), as before.
- **Done when**: no `@keyframes focus` remains and every element above shows a static ring.
