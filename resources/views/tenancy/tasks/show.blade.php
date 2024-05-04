<x-tenancy-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <x-container>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold mb-4">{{ $task->name }}</h1>
                <p>{{ $task->description }}</p>
                <img class="w-100 h-100" src="{{ route('file', $task->image_url) }}">
            </div>
        </div>
    </x-container>
</x-tenancy-layout>
