<div class="p-4 space-y-6">
    <form wire:submit="createRestaurant" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
            <input type="text" wire:model="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="main_tag_id" class="block text-sm font-medium text-gray-700">{{ __('Main tag') }}</label>
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
            @error('main_tag_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="main_location_tag_id" class="block text-sm font-medium text-gray-700">{{ __('Main location') }}</label>
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
                        class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
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
            @error('main_location_tag_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="price_range" class="block text-sm font-medium text-gray-700">{{ __('Price range') }}</label>
            <select wire:model="price_range" id="price_range" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue">
                <option value="">{{ __('Select') }}</option>
                @foreach(App\Enums\PriceRange::cases() as $range)
                    <option value="{{ $range->value }}">{{ $range->label() }}</option>
                @endforeach
            </select>
            @error('price_range') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="rating" class="block text-sm font-medium text-gray-700">{{ __('Rating') }}</label>
            <div class="mt-2">
                <livewire:star-rating-input wire:model="rating" :value="$rating ?? 0" />
            </div>
            @error('rating') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700">{{ __('Tags') }}</label>

            <div class="relative mt-2">
                <input
                    type="text"
                    wire:model.live="tagSearch"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"
                    placeholder="{{ __('Search...') }}"
                >

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

            @if($selectedTagsData->isNotEmpty())
                <div class="mt-2 flex flex-wrap gap-1">
                    @foreach($selectedTagsData as $tag)
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

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
            <textarea wire:model="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-blue focus:ring-primary-blue"></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="pt-6 flex justify-end gap-3">
            <a
                href="{{ route('restaurants.index') }}"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-blue"
            >
                {{ __('Cancel') }}
            </a>
            <button
                type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-blue hover:bg-primary-blue-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-blue"
            >
                {{ __('Create') }}
            </button>
        </div>
    </form>
</div>
