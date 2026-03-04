<x-layout>
	<x-brave::nav aria-label="{{ __('Test navigatie met hover', 'sage') }}">
		<x-brave::nav.list>
			<x-brave::nav.item>
				<x-brave::nav.link href="/contact">
					Contact
				</x-brave::nav.link>

			</x-brave::nav.item>
			<x-brave::nav.item>
				<x-brave::nav.link href="/" :active="true" class="text-green-500">
					Home
				</x-brave::nav.link>
			</x-brave::nav.item>

			<x-brave::nav.item class="group" :hasChildren="true">
				<x-brave::nav.link href="#" :hasChildren="true">
					Dropdown
				</x-brave::nav.link>

				<x-brave::nav.dropdown-on-hover @class(['invisible absolute', 'group-has-aria-expanded:visible'])>
					<x-brave::nav.item>
						<x-brave::nav.link href="/contact">
							Contact
						</x-brave::nav.link>

					</x-brave::nav.item>
					<x-brave::nav.item>
						<x-brave::nav.link href="/" :active="true">
							Home
						</x-brave::nav.link>
					</x-brave::nav.item>
				</x-brave::nav.dropdown-on-hover>

			</x-brave::nav.item>
		</x-brave::nav.list>
	</x-brave::nav>

	<x-brave::nav aria-label="{{ __('Test navigatie met click', 'sage') }}">
		<x-brave::nav.list>
			<x-brave::nav.item>
				<x-brave::nav.link href="/contact">
					Contact
				</x-brave::nav.link>

			</x-brave::nav.item>
			<x-brave::nav.item>
				<x-brave::nav.link href="/" :active="true" class="text-green-500">
					Home
				</x-brave::nav.link>
			</x-brave::nav.item>

			<x-brave::nav.item class="group" :hasChildren="true">
				<x-brave::nav.link href="#" :hasChildren="true">
					Dropdown
				</x-brave::nav.link>

				<x-brave::nav.dropdown-on-click @class(['invisible absolute', 'group-has-aria-expanded:visible'])>
					<x-brave::nav.item>
						<x-brave::nav.link href="/contact">
							Contact
						</x-brave::nav.link>

					</x-brave::nav.item>
					<x-brave::nav.item>
						<x-brave::nav.link href="/" :active="true">
							Home
						</x-brave::nav.link>
					</x-brave::nav.item>
				</x-brave::nav.dropdown-on-click>

			</x-brave::nav.item>
		</x-brave::nav.list>
	</x-brave::nav>

	@while (have_posts())
		@php(the_post())
		@php(the_content())
	@endwhile
</x-layout>
