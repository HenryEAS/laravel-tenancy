<x-tenancy-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <x-container>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <input-label>
                                {{ __("Name") }}
                            </input-label>

                            <x-text-input
                                value="{{ old('name', $task->name) }}"
                                name="name"
                                type="text"
                                class="w-full mt-2"
                                placeholder="Nommbre de la tarea"
                            />
                            <x-input-error :messages="$errors->first('name')" />
                        </div>
                        <div class="mb-4">
                            <input-label>
                                {{ __("Description") }}
                            </input-label>

                            <textarea
                                name="description"
                                type="text"
                                class="form-control w-full mt-2 border-gray-300 rounded-md"
                                placeholder="Descripción de la tarea"
                            >{{ old('description', $task->description) }}</textarea>
                            <x-input-error :messages="$errors->first('description')" />
                        </div>
                        <div class="mb-4">
                            <input-label>
                                {{ __("Image") }}
                            </input-label>

                            <input
                                name="image_url"
                                type="file"
                                class="w-full mt-2"
                                placeholder="Imagen"
                            />
                            <x-input-error :messages="$errors->first('image_url')" />
                        </div>
                        <div class="flex justify-end">
                            <button class="btn btn-blue">
                                {{ __("Update") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-container>
</x-tenancy-layout>
