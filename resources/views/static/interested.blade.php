<x-layout :title="$page->seo_title ?? $page->title" :seo="$page->seo">
	<x-layout-builder :blocks="$page->body" />
</x-layout>
