<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action('get_header'); ?>

	<div id="app" class="flex min-h-screen flex-col overflow-x-clip">
		<a class="is-button on-focus-visible focus:!fixed focus:!left-4 focus:!top-4" href="#main">
			{{ __('Skip to content') }}
		</a>

		@include('sections.header')

		<main id="main" class="main is-main-content create-main-content-alignment mt-(--combined-bar-height) flex-auto">
			@include('partials.breadcrumbs')
			{{ $slot }}
		</main>

		@include('sections.footer')
	</div>

	<?php do_action('get_footer'); ?>
	<?php wp_footer(); ?>
</body>

</html>
