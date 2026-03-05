<x-layout>
	<x-brave::nav aria-label="{{ __('Test navigatie met hover', 'sage') }}">
		<x-brave::nav.list>
			<x-brave::nav.item>
				<x-brave::nav.link href="/contact">
					Contact
				</x-brave::nav.link>

			</x-brave::nav.item>

			<x-brave::nav.item class="group">
				<x-brave::nav.link href="#" :hasChildren="true">
					Dropdown on hover
				</x-brave::nav.link>

				<x-brave::nav.dropdown mode="hover" @class(['invisible absolute', 'group-has-aria-expanded:visible'])>
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
				</x-brave::nav.dropdown>

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

			<x-brave::nav.item class="group">
				<x-brave::nav.link href="#" :hasChildren="true">
					Dropdown on click
				</x-brave::nav.link>

				<x-brave::nav.dropdown @class(['invisible absolute', 'group-has-aria-expanded:visible'])>
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
				</x-brave::nav.dropdown>

			</x-brave::nav.item>
		</x-brave::nav.list>
	</x-brave::nav>

	@while (have_posts())
		@php(the_post())
		@php(the_content())
	@endwhile
</x-layout>
