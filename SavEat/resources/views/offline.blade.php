<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <img
                        src="{{ asset('icons/icon-192x192.png') }}"
                        alt="Saveat"
                        class="w-24 h-24 mx-auto mb-6"
                    >
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">
                        {{ __('No hay conexión a internet') }}
                    </h2>
                    <p class="text-gray-600">
                        {{ __('Por favor, comprueba tu conexión e inténtalo de nuevo.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
