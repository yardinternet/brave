@if (has_nav_menu('primary_navigation'))
	<nav class="nav-primary hidden items-center lg:flex" aria-label="{{ __('Primaire navigatie', 'sage') }}">
		@php
			wp_nav_menu([
			    'container' => '',
			    'depth' => 2,
			    'id' => '',
			    'menu_class' => 'nav flex align-center justify-center h-full',
			    'theme_location' => 'primary_navigation',
			]);
		@endphp
	</nav>
@endif
