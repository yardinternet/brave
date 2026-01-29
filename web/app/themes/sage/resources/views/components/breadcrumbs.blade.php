@if (!is_front_page() && function_exists('seopress_display_breadcrumbs'))
	<div class="alignwide wp-block-wpseopress-breadcrumbs relative my-3">
		{!! seopress_display_breadcrumbs() !!}
	</div>
@endif
