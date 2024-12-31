<div>
    <div class="mb-6 flex gap-2">
        <livewire:search-input :placeholder="__('Search restaurants...')" />
        <button
            wire:click="toggleDefaultFilters"
            class="text-gray-500 hover:text-primary-blue focus:outline-none rounded-lg"
        >
            <img
                src="{{ asset($this->isUsingDefaultFilters() ? 'icons/user-filters.svg' : 'icons/user-filters-outline.svg') }}"
                alt="{{ $this->isUsingDefaultFilters() ? 'Remove default filters' : 'Apply default filters' }}"
                class="w-7 h-7"
            >
        </button>
        <button
            wire:click="$toggle('showFilters')"
            class="text-gray-500 hover:text-primary-blue focus:outline-none rounded-lg"
        >
            <img
                src="{{ asset($this->hasActiveFilters() ? 'icons/filter.svg' : 'icons/filter-outline.svg') }}"
                alt="{{ $this->hasActiveFilters() ? 'Active filters' : 'Filter' }}"
                class="w-7 h-7"
            >
        </button>
    </div>

    <!-- Filter Modal -->
    @if($showFilters)
        <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50"
            wire:click="$toggle('showFilters')"
        >
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <div
                        class="w-full max-w-md bg-white rounded-xl p-4"
                        wire:click.stop="$refresh"
                    >
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">{{ __('Filters') }}</h2>
                            <button wire:click="$toggle('showFilters')">
                                <img src="{{ asset('icons/delete.svg') }}" alt="Close" class="w-6 h-6">
                            </button>
                        </div>

                        <!-- Main Tag Filter -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Main tag') }}</label>
                            <div class="relative">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        wire:model.live="mainTagSearch"
                                        wire:focus="$set('mainTagSearchFocused', true)"
                                        wire:blur="$set('mainTagSearchFocused', false)"
                                        class="block w-full pl-9 rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
                                        placeholder="{{ __('Search...') }}"
                                    >
                                </div>

                                @if($mainTagSearch && $mainTagSearchFocused)
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
                                            wire:click="removeMainTag"
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

                        <!-- Location Tag Filter -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Main location') }}</label>
                            <div class="relative">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        wire:model.live="locationTagSearch"
                                        wire:focus="$set('locationTagSearchFocused', true)"
                                        wire:blur="$set('locationTagSearchFocused', false)"
                                        class="block w-full pl-9 rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
                                        placeholder="{{ __('Search...') }}"
                                    >
                                </div>

                                @if($locationTagSearch && $locationTagSearchFocused)
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
                                            wire:click="removeLocationTag"
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

                        <!-- Additional Tags Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Other tags') }}</label>
                            <div class="relative">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        wire:model.live="tagSearch"
                                        wire:focus="$set('tagSearchFocused', true)"
                                        wire:blur="$set('tagSearchFocused', false)"
                                        class="block w-full pl-9 rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
                                        placeholder="{{ __('Search...') }}"
                                    >
                                </div>

                                @if($tagSearch && $tagSearchFocused)
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

                        <!-- Price Range Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Price Range') }}</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(\App\Enums\PriceRange::cases() as $priceRange)
                                    <button
                                        wire:click="togglePriceRange('{{ $priceRange->value }}')"
                                        class="py-2 px-3 rounded-lg border {{ in_array($priceRange->value, $filters['price_ranges']) ? 'bg-primary-blue text-white border-primary-blue' : 'border-gray-300' }}"
                                    >
                                        {{ $priceRange->label() }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div class="mb-10">
                            <label class="block text-sm font-medium text-gray-700">{{ __('Minimum Rating') }}</label>
                            <div class="mt-2">
                                <livewire:star-rating-input wire:model="filters.rating" :value="$filters['rating'] ?? 0" />
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <button
                                wire:click="clearFilters"
                                class="flex-1 bg-gray-200 text-gray-primary-dark rounded-lg py-2 font-medium"
                            >
                                {{ __('Clear') }}
                            </button>
                            <button
                                wire:click="applyFilters"
                                class="flex-1 bg-primary-blue text-white rounded-lg py-2 font-medium"
                            >
                                {{ __('Filter') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(!$restaurants || $restaurants->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">{{ __('No restaurants found') }}</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($restaurants as $restaurant)
                <livewire:restaurant :restaurant="$restaurant" :key="$restaurant->id" />
            @endforeach
        </div>
    @endif

    <a
        href="{{ route('restaurants.create') }}"
        class="fixed right-4 bottom-20 inline-flex items-center justify-center w-12 h-12 text-white bg-primary-blue hover:bg-primary-blue-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-blue rounded-full shadow-lg"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="sr-only">{{ __('Add new restaurant') }}</span>
    </a>
</div>
