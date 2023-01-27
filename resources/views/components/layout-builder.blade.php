@foreach ($blocks as $block)
	<x-dynamic-component :component="$block->blade_component" :block="$block" :id="$block->key()" :data-block-type="$block->name()" :data-block-index="$block->data_index"
		:data-block-type-index="$block->data_type_index" />
@endforeach
