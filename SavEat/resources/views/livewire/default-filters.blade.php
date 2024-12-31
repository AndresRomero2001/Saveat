<div class="mt-4 space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Default Filters') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Set your default filters so you can apply them with one touch') }}
        </p>
    </header>

    <!-- Main Tag -->
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Main Tag') }}</label>
        <div class="relative mt-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input
                    type="text"
                    wire:model.live="mainTagSearch"
                    class="block w-full pl-9 rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
                    placeholder="{{ __('Search...') }}"
                >
            </div>

            @if($mainTagSearch)
                <div class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-sm">
                    @forelse($searchedMainTags as $tag)
                        <button
                            type="button"
                            wire:click="setMainTag({{ $tag->id }})"
                            class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50"
                        >
                            {{ $tag->name }}
                        </button>
                    @empty
                        <div class="px-3 py-2 text-sm text-gray-500">{{ __('No tags found') }}</div>
                    @endforelse
                </div>
            @endif
        </div>

        @if($selectedMainTag)
            <div class="mt-2">
                <div class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-sm bg-gray-100">
                    <span>{{ $selectedMainTag->name }}</span>
                    <button
                        type="button"
                        wire:click="setMainTag(null)"
                        class="text-gray-400 hover:text-gray-600"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Location Tag -->
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Main Location') }}</label>
        <div class="relative mt-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input
                    type="text"
                    wire:model.live="locationTagSearch"
                    class="block w-full pl-9 rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
                    placeholder="{{ __('Search...') }}"
                >
            </div>

            @if($locationTagSearch)
                <div class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-sm">
                    @forelse($searchedLocationTags as $tag)
                        <button
                            type="button"
                            wire:click="setLocationTag({{ $tag->id }})"
                            class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50"
                        >
                            {{ $tag->name }}
                        </button>
                    @empty
                        <div class="px-3 py-2 text-sm text-gray-500">{{ __('No locations found') }}</div>
                    @endforelse
                </div>
            @endif
        </div>

        @if($selectedLocationTag)
            <div class="mt-2">
                <div class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-sm bg-gray-100">
                    <span>{{ $selectedLocationTag->name }}</span>
                    <button
                        type="button"
                        wire:click="setLocationTag(null)"
                        class="text-gray-400 hover:text-gray-600"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Additional Tags -->
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Additional Tags') }}</label>
        <div class="relative mt-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input
                    type="text"
                    wire:model.live="tagSearch"
                    class="block w-full pl-9 rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
                    placeholder="{{ __('Search tags...') }}"
                >
            </div>

            @if($tagSearch)
                <div class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-sm">
                    @forelse($searchedTags as $tag)
                        <button
                            type="button"
                            wire:click="addTag({{ $tag->id }})"
                            class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50"
                        >
                            {{ $tag->name }}
                        </button>
                    @empty
                        <div class="px-3 py-2 text-sm text-gray-500">{{ __('No tags found') }}</div>
                    @endforelse
                </div>
            @endif
        </div>

        @if($selectedTags->isNotEmpty())
            <div class="mt-2 flex flex-wrap gap-1">
                @foreach($selectedTags as $tag)
                    <div class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-sm bg-gray-100">
                        <span>{{ $tag->name }}</span>
                        <button
                            type="button"
                            wire:click="removeTag({{ $tag->id }})"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Price Range -->
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Price Range') }}</label>
        <div class="grid grid-cols-2 gap-2 mt-2">
            @foreach(\App\Enums\PriceRange::cases() as $priceRange)
                <button
                    type="button"
                    wire:click="togglePriceRange('{{ $priceRange->value }}')"
                    class="py-2 px-3 rounded-lg border {{ in_array($priceRange->value, $filters['price_ranges']) ? 'bg-primary-blue text-white border-primary-blue' : 'border-gray-300' }}"
                >
                    {{ $priceRange->label() }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Rating -->
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Minimum Rating') }}</label>
        <div class="mt-2">
            <livewire:star-rating-input wire:model="filters.rating" :value="$filters['rating'] ?? 0" />
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end pt-4">
        @if($showSuccessMessage)
            <div
                class="mr-2 bg-green-100 text-green-800 border border-green-300 rounded-lg p-2 text-xs transition-opacity duration-300"
            >
                {{ __('Default filters updated') }}
            </div>
        @endif
        <x-primary-button
            wire:click="saveDefaultFilters" type="button"
        >
            {{ __('Save') }}
        </x-primary-button>
    </div>
</div>
