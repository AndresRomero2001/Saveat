<div class="pb-4">
    <div class="mb-6 flex gap-2">
        <livewire:search-input :placeholder="__('Search tags...')" />

        <button
            type="button"
            wire:click="toggleUserFilter"
            class="text-gray-500 hover:text-primary-blue focus:outline-none rounded-lg"
        >
            <img
                src="{{ asset($showOnlyUserTags ? 'icons/user-tag.svg' : 'icons/user-tag-outline.svg') }}"
                alt="{{ $showOnlyUserTags ? __('Show all tags') : __('Show only my tags') }}"
                class="w-8 h-8"
            >
        </button>

        <button
            type="button"
            wire:click="toggleLocationFilter"
            class="text-gray-500 hover:text-primary-blue focus:outline-none rounded-lg"
        >
            <img
                src="{{ asset($showOnlyLocations ? 'icons/location.svg' : 'icons/location-outline.svg') }}"
                alt="{{ $showOnlyLocations ? __('Show all tags') : __('Show only locations') }}"
                class="w-8 h-8"
            >
        </button>
    </div>

    <div class="flex flex-wrap gap-2">
        @foreach($tags as $tag)
            <x-tag :tag="$tag" mode="editable" />
        @endforeach
    </div>

    <div class="mt-4 text-sm text-gray-400">
        {{ $tags->count() }} {{ __('tags') }}
    </div>

    @if($showCreateModal)
        <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 transition-opacity duration-300"
            wire:click="$set('showCreateModal', false)"
        >
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <!-- stop is used to prevent the click event from propagating to the parent div -->
                    <!-- this is because the click on the button was being propagated to the shade, and therefore setting the modal to false -->
                    <!-- refresh is used because stop requires a laravel action -->
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-xl transform w-full max-w-lg transition-all duration-300 ease-out"
                        wire:click.stop="$refresh"
                    >
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Create Tag') }}
                            </h2>

                            <div class="mt-6">
                                <x-input-label for="tag_name" :value="__('Name')" />
                                <x-text-input
                                    wire:model.live="tag_name"
                                    id="tag_name"
                                    class="mt-1 block w-full"
                                    type="text"
                                />
                                <x-input-error :messages="$errors->get('tag_name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <label class="flex items-center">
                                    <input
                                        type="checkbox"
                                        wire:model.live="isLocation"
                                        class="rounded border-gray-300 text-primary-blue shadow-sm focus:ring-primary-blue"
                                    >
                                    <span class="ml-2 text-sm text-gray-600">{{ __('It is a location') }}</span>
                                </label>
                            </div>

                            <div class="mt-6 flex justify-end gap-4">
                                <x-secondary-button wire:click="$set('showCreateModal', false)">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button wire:click="createTag">
                                    {{ __('Create') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showEditModal)
        <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 transition-opacity duration-300"
            wire:click="$set('showEditModal', false)"
        >
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-xl transform w-full max-w-lg transition-all duration-300 ease-out"
                        wire:click.stop="$refresh"
                    >
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Tag') }}
                            </h2>

                            <div class="mt-6">
                                <x-input-label for="editingTagName" :value="__('Name')" />
                                <x-text-input
                                    wire:model.live="editingTagName"
                                    id="editingTagName"
                                    class="mt-1 block w-full"
                                    type="text"
                                />
                                <x-input-error :messages="$errors->get('editingTagName')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <label class="flex items-center">
                                    <input
                                        type="checkbox"
                                        wire:model.live="editingTagIsLocation"
                                        class="rounded border-gray-300 text-primary-blue shadow-sm focus:ring-primary-blue"
                                    >
                                    <span class="ml-2 text-sm text-gray-600">{{ __('It is a location') }}</span>
                                </label>
                            </div>

                            <div class="mt-6 flex justify-end gap-4">
                                <x-secondary-button wire:click="$set('showEditModal', false)">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button wire:click="updateTag">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showDeleteModal)
        <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 transition-opacity duration-300"
            wire:click="$set('showDeleteModal', false)"
        >
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-xl transform w-full max-w-lg transition-all duration-300 ease-out"
                        wire:click.stop = "$refresh"
                    >
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Delete Tag') }}
                            </h2>

                            <p class="mt-4 text-sm text-gray-600">
                                {{ __('Are you sure you want to delete this tag? This action cannot be undone.') }}
                            </p>

                            <div class="mt-6 flex justify-end gap-4">
                                <x-secondary-button wire:click="$set('showDeleteModal', false)">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button wire:click="deleteTag">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Floating Action Button -->
    <div class="fixed bottom-20 right-4">
        <button
            type="button"
            class="flex items-center justify-center w-12 h-12 text-white bg-primary-blue rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-blue shadow-lg"
            wire:click="$set('showCreateModal', true)"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="sr-only">{{ __('Add new tag') }}</span>
        </button>
    </div>
</div>
