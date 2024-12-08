<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
{{--                    @dd($posts)--}}

                    @foreach($posts as $post)
                        <div class="bg-gray-100 rounded-lg shadow-md p-6 mb-6">
                            <h1 class="text-xl font-bold text-gray-800">{{ $post->title }}</h1>
                            <p class="mt-2 text-gray-700">{{ $post->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
