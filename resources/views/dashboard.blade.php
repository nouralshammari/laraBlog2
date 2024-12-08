<x-app-layout>
    <link href="{{ asset('../../css/app.css') }}" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Parent container met flex-col om verticale indeling te forceren -->
    <div class="flex flex-col items-center justify-start bg-gray-100 min-h-screen">
        <!-- Eerste sectie: You're logged in -->
        <div class="py-12 w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Tweede sectie: Add new post -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-7xl">
            <div class="max-w-xl mx-auto">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Add new post') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Share your thoughts, or your experiences') }}
                        </p>
                    </header>

                    <form method="POST" action="/create-post" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="post_title" :value="__('Title')" />
                            <x-text-input id="post_title" name="title" type="text" class="mt-1 block w-full" autocomplete="off" />
                        </div>
                        <div>
                            <x-input-label for="post_content" :value="__('Content')" />
                            <textarea id="post_body" name="description" class="mt-1 block w-full" rows="6"></textarea>
                        </div>
                        <div class="flex items-center justify-center gap-4">
                            <x-primary-button>{{ __('Create Post') }}</x-primary-button>
                            @if (session('status') === 'post-created')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Post created successfully.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!-- Derde sectie: Posts overzicht -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-7xl">
            <div class="max-w-xl mx-auto">
                <section>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('All my posts: ') }}
                    </h2>
                    @foreach ($posts as $post)
                        <div class="bg-gray-100 rounded-lg shadow-md p-6 mb-6">
                            <h3 class="text-lg font-medium text-gray-900">{{ __($post['title']) }}</h3>
                            <p class="mt-2 text-gray-700">{{ $post['description'] }}</p>

                            <div class="flex justify-end gap-4 mt-4">
                                <!-- Edit knop -->
                                <a href="/edit-post/{{ $post->id }}"
                                   class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded hover:bg-yellow-600 !important">
                                    Edit
                                </a>

                                <!-- Delete knop -->
                                <form action="/delete-post/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600 !important">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </section>
            </div>
        </div>
    </div>
</x-app-layout>
