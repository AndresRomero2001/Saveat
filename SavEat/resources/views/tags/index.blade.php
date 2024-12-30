<x-app-layout>
    <x-slot name="header">
        <livewire:tag-header />
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
                    <livewire:tag-manager />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
