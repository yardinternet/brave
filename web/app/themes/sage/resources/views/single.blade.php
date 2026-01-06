<x-layout>
	@while (have_posts())
		@php(the_post())
		@if (!post_password_required())
			@includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
		@else
			{{ the_content() }}
		@endif
	@endwhile
</x-layout>
