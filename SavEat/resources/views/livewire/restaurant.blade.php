<a href="{{ route('restaurants.edit', $restaurant) }}">
    <div class="bg-white rounded-lg shadow p-4 mb-3">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-semibold text-gray-dark">{{ $restaurant->name }}</h3>
                <div class="flex items-center gap-2 mt-1">
                    <x-tag :tag="$restaurant->mainTag" mode="readonly"/>
                    <x-tag :tag="$restaurant->mainLocationTag" mode="readonly"/>
                </div>
            </div>
            <div class="text-right">
                @if($restaurant->price_range)
                    <div class="text-sm font-medium text-gray-primary">
                        {{ $restaurant->price_range?->label() }}
                    </div>
                @endif
                @if($restaurant->rating)
                    <div class="flex items-center justify-end gap-1 mt-1">
                        <span class="text-sm font-medium text-gray-primary">{{ number_format($restaurant->rating, 1) }}</span>
                        <img src="{{ asset('icons/star-yellow.svg') }}" alt="Rating" class="w-5 h-5">
                    </div>
                @endif
            </div>
        </div>

        @if($restaurant->description)
            <p class="mt-2 text-sm text-gray-600">{{ $restaurant->description }}</p>
        @endif

        @if($locationTags->isNotEmpty() || $otherTags->isNotEmpty())
            <div class="mt-3 flex flex-col gap-2">
                @if($locationTags->isNotEmpty())
                    <div class="flex items-start gap-2">
                        <img src="{{ asset('icons/location-outline.svg') }}" alt="Location" class="w-4 h-4 mt-1">
                        <div class="flex flex-wrap gap-1">
                            @foreach($locationTags as $tag)
                                <x-tag :tag="$tag" mode="readonly"/>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($otherTags->isNotEmpty())
                    <div class="flex items-start gap-2">
                        <img src="{{ asset('icons/tag-outline.svg') }}" alt="Tags" class="w-4 h-4 mt-1">
                        <div class="flex flex-wrap gap-1">
                            @foreach($otherTags as $tag)
                                <x-tag :tag="$tag" mode="readonly"/>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</a>
