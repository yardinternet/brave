<x-layout>
	<div class="wp-block-buttons">
		<a class="is-button" href="https://brave.local/">Test knop</a>
		<a class="is-button is-button-subtle" href="https://brave.local/">Test knop</a>
		<a class="is-button is-button-outline" href="https://brave.local/">Test knop</a>
	</div>
	<div class="wp-block-buttons">
		<a class="is-button" href="https://brave.local/">Test knop</a>
		<a class="is-button is-button-subtle" href="https://brave.local/">Test knop</a>
		<a class="is-button is-button-outline" href="https://brave.local/">Test knop</a>
	</div>
	<div class="wp-block-buttons">
		<a class="is-button" href="https://brave.local/">Test knop</a>
		<a class="is-button is-button-subtle" href="https://brave.local/">Test knop</a>
		<a class="is-button is-button-outline" href="https://brave.local/">Test knop</a>
	</div>
	@while (have_posts())
		@php(the_post())
		@php(the_content())
	@endwhile
</x-layout>
