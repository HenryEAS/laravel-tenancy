<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tenants') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg text-center  text-2x6 font-semibold mb-4">{{ __('Create a Tenant') }}</h3>
                    <form action="{{ route('tenants.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <x-input-label for="id" class="w-1/4">{{ __("Name") }}</x-input-label>
                                <x-text-input
                                    id="id"
                                    name="id"
                                    type="text"
                                    value="{{ old('id') }}"
                                    placeholder="Ingresa el nombre"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('id')" class="mt-2" />
                            </div>

                            <div class="flex items-center">
                                <x-input-label for="name_fantasy" class="w-1/4">{{ __("Name Fantasy") }}</x-input-label>
                                <x-text-input
                                    id="name_fantasy"
                                    name="name_fantasy"
                                    type="text"
                                    value="{{ old('name_fantasy') }}"
                                    placeholder="Ingresa el nombre fantasía"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('name_fantasy')" class="mt-2" />
                            </div>

                            <div class="flex items-center">
                                <x-input-label for="email" class="w-1/4">{{ __("Email") }}</x-input-label>
                                <x-text-input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    placeholder="Ingresa el email"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('email')" class="mt-2" />
                            </div>

                            <div class="flex items-center">
                                <x-input-label for="ruc" class="w-1/4">{{ __("Ruc") }}</x-input-label>
                                <x-text-input
                                    id="ruc"
                                    name="ruc"
                                    type="text"
                                    value="{{ old('ruc') }}"
                                    placeholder="Ingresa el ruc"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('ruc')" class="mt-2" />
                            </div>

                            <div class="flex items-center">
                                <x-input-label for="phone" class="w-1/4">{{ __("Phone") }}</x-input-label>
                                <x-text-input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone') }}"
                                    placeholder="Ingresa el teléfono"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('phone')" class="mt-2" />
                            </div>

                            <div class="flex items-center">
                                <x-input-label for="address" class="w-1/4">{{ __("Address") }}</x-input-label>
                                <x-text-input
                                    id="address"
                                    name="address"
                                    type="text"
                                    value="{{ old('address') }}"
                                    placeholder="Ingresa la dirección"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('address')" class="mt-2" />
                            </div>

                            <div class="flex items-center">
                                <x-input-label for="timbrado" class="w-1/4">{{ __("Timbrado") }}</x-input-label>
                                <x-text-input
                                    id="timbrado"
                                    name="timbrado"
                                    type="text"
                                    value="{{ old('timbrado') }}"
                                    placeholder="Ingresa el timbrado"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('timbrado')" class="mt-2" />
                            </div>

                            <div class="flex items-center">
                                <x-input-label for="tenant_facturaSend" class="w-1/4">{{ __("Tenant Factura Send") }}</x-input-label>
                                <x-text-input
                                    id="tenant_facturaSend"
                                    name="tenant_facturaSend"
                                    type="text"
                                    value="{{ old('tenant_facturaSend') }}"
                                    placeholder="Ingresa la dirección"
                                    class="w-3/4"
                                />
                                <x-input-error :messages="$errors->first('tenant_facturaSend')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
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
