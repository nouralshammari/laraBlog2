<?php
?>

<x-app-layout>


<form method="post" action= "{{ route('post.updatePost', ['id' => $post->id]) }}" class="mt-6 space-y-6">
            <section>
@csrf
@method('PUT')

<div>
    <x-input-label for="post_title" :value="__('Title')" />
    <x-text-input id="post_title" name="title"  type="text" class="mt-1 block w-full" autocomplete="off"  />

</div>

<div>
    <x-input-label for="post_content" :value="__('Content')" />
    <textarea id="post_body" name="description" class="mt-1 block w-full" rows="6"></textarea>
</div>

<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Edit Post') }}</x-primary-button>
</div>
            </section>
</form>
</x-app-layout>
