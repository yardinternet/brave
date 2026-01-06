<div class="@xl:gap-6 grid gap-4">
	@forelse ($postDataCollection as $postData)
		<x-dynamic-card :card="$postData->postType()" class="card-horizontal" :postData="$postData" :label="get_post_type_object($postData->postType())?->labels->singular_name" />
	@empty
		<x-facetwp.no-results />
	@endforelse
</div>
