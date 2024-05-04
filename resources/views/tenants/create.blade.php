<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tenants') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tenants.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input-label>
                                {{ __("Name") }}
                            </input-label>

                            <x-text-input
                                value="{{ old('id') }}"
                                name="id"
                                type="text"
                                class="w-full mt-2"
                                placeholder="Ingresa el nombre"
                            />
                            <x-input-error :messages="$errors->first('id')" />
                        </div>
                        <div class="flex justify-end">
                            <button class="btn btn-blue">
                                {{ __("Save") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
