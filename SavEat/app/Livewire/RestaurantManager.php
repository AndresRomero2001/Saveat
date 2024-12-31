<?php

namespace App\Livewire;

use App\Models\Restaurant;
use App\Models\Tag;
use App\Models\UserDefaultFilter;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class RestaurantManager extends Component
{
    public $restaurants;
    public $search = '';
    public $showFilters = false;
    public $tagSearch = '';
    public Collection $selectedTags;
    public $filters = [
        'rating' => 0,
        'price_ranges' => [],
        'tag_ids' => [],
        'main_tag_id' => null,
        'main_location_tag_id' => null
    ];
    public $mainTagSearch = '';
    public $locationTagSearch = '';
    public $mainTagSearchFocused = false;
    public $locationTagSearchFocused = false;
    public $tagSearchFocused = false;
    public $selectedMainTag = null;
    public $selectedLocationTag = null;

    public function mount()
    {
        $this->restaurants = collect();
        $this->selectedTags = collect();
        $this->applyDefaultFilters();
    }

    #[On('search-updated')]
    public function handleSearch($search)
    {
        $this->search = $search;
        $this->loadRestaurants();
    }

    public function addTag($tagId)
    {
        $tag = Tag::find($tagId);

        if (!$this->selectedTags->contains('id', $tagId)) {
            $this->selectedTags->push($tag);
            $this->filters['tag_ids'][] = $tagId;
        }

        $this->tagSearch = '';
    }

    public function removeTag($tagId)
    {
        $this->selectedTags = $this->selectedTags->reject(fn($t) => $t->id === $tagId);
        $this->filters['tag_ids'] = array_values(array_diff($this->filters['tag_ids'], [$tagId]));
    }

    public function togglePriceRange($priceRange)
    {
        if (in_array($priceRange, $this->filters['price_ranges'])) {
            $this->filters['price_ranges'] = array_values(
                array_diff($this->filters['price_ranges'], [$priceRange])
            );
        } else {
            $this->filters['price_ranges'][] = $priceRange;
        }
    }

    public function applyFilters()
    {
        $this->showFilters = false;
        $this->loadRestaurants();
    }

    public function loadRestaurants()
    {
        $query = Restaurant::with(['mainTag', 'mainLocationTag', 'tags'])
            ->where('restaurants.user_id', Auth::id())
            ->orderBy('restaurants.name');

        if ($this->search) {
            $query->where('restaurants.name', 'like', '%' . $this->search . '%');
        }

        if ($this->filters['rating'] > 0) {
            $query->where('restaurants.rating', '>=', $this->filters['rating']);
        }

        if (!empty($this->filters['price_ranges'])) {
            $query->whereIn('restaurants.price_range', $this->filters['price_ranges']);
        }

        // Handle main tag filter
        if ($this->filters['main_tag_id']) {
            $query->where('main_tag_id', $this->filters['main_tag_id']);
        }

        // Handle location tag filter
        if ($this->filters['main_location_tag_id']) {
            $query->where('main_location_tag_id', $this->filters['main_location_tag_id']);
        }

        // Handle other tags filter
        if (!empty($this->filters['tag_ids'])) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('tags.id', $this->filters['tag_ids']);
            });
        }

        $this->restaurants = $query->get();
    }

    public function render()
    {
        return view('livewire.restaurant-manager', [
            'searchedMainTags' => Tag::where('name', 'like', '%' . $this->mainTagSearch . '%')
                ->where('is_location', false)
                ->orderBy('name')
                ->limit(5)
                ->get(),
            'searchedLocationTags' => Tag::where('name', 'like', '%' . $this->locationTagSearch . '%')
                ->where('is_location', true)
                ->orderBy('name')
                ->limit(5)
                ->get(),
            'searchedTags' => Tag::where('name', 'like', '%' . $this->tagSearch . '%')
                ->whereNotIn('id', $this->selectedTags->pluck('id'))
                ->orderBy('name')
                ->limit(5)
                ->get()
        ]);
    }

    public function clearFilters()
    {
        $this->filters = [
            'rating' => 0,
            'price_ranges' => [],
            'tag_ids' => [],
            'main_tag_id' => null,
            'main_location_tag_id' => null
        ];
        $this->selectedTags = collect();
        $this->dispatch('rating-reset');
        $this->loadRestaurants();
    }

    #[On('rating-changed')]
    public function handleRatingChange($value)
    {
        $this->filters['rating'] = $value;
    }

    public function hasActiveFilters()
    {
        if ($this->isUsingDefaultFilters()) {
            return false;
        }

        return $this->filters['rating'] > 0
            || !empty($this->filters['price_ranges'])
            || !empty($this->filters['tag_ids']);
    }

    public function isUsingDefaultFilters()
    {
        $defaultFilters = UserDefaultFilter::where('user_id', Auth::id())->first();
        if (!$defaultFilters) return false;

        // Create arrays for comparison
        $defaultTags = $defaultFilters->tag_ids ?? [];
        $currentTags = $this->filters['tag_ids'];

        // Sort arrays to ensure consistent comparison
        sort($defaultTags);
        sort($currentTags);

        return $this->filters['rating'] == $defaultFilters->rating
            && $this->filters['price_ranges'] == $defaultFilters->price_ranges
            && $currentTags == $defaultTags
            && $this->filters['main_tag_id'] == $defaultFilters->main_tag_id
            && $this->filters['main_location_tag_id'] == $defaultFilters->main_location_tag_id;
    }

    public function applyDefaultFilters()
    {
        $defaultFilters = UserDefaultFilter::where('user_id', Auth::id())->first();

        if ($defaultFilters) {
            $this->filters['rating'] = $defaultFilters->rating ?? 0;
            $this->filters['price_ranges'] = $defaultFilters->price_ranges ?? [];

            // Set main tags first
            $this->filters['main_tag_id'] = $defaultFilters->main_tag_id;
            $this->filters['main_location_tag_id'] = $defaultFilters->main_location_tag_id;

            // Set selected main tags for the UI
            if ($defaultFilters->main_tag_id) {
                $this->selectedMainTag = Tag::find($defaultFilters->main_tag_id);
            }
            if ($defaultFilters->main_location_tag_id) {
                $this->selectedLocationTag = Tag::find($defaultFilters->main_location_tag_id);
            }

            // Set other tags (excluding main tags)
            $this->filters['tag_ids'] = $defaultFilters->tag_ids ?? [];
            $this->selectedTags = Tag::whereIn('id', $this->filters['tag_ids'])->get();

            $this->dispatch('rating-reset');
            $this->loadRestaurants();
        }
    }

    public function toggleDefaultFilters()
    {
        if ($this->isUsingDefaultFilters()) {
            $this->clearFilters();
        } else {
            $this->applyDefaultFilters();
        }
    }

    public function setMainTag($tagId)
    {
        $tag = Tag::find($tagId);
        $this->filters['main_tag_id'] = $tagId;
        $this->selectedMainTag = $tag;
        $this->mainTagSearch = '';
    }

    public function removeMainTag()
    {
        $this->filters['main_tag_id'] = null;
        $this->selectedMainTag = null;
    }

    public function setLocationTag($tagId)
    {
        $tag = Tag::find($tagId);
        $this->filters['main_location_tag_id'] = $tagId;
        $this->selectedLocationTag = $tag;
        $this->locationTagSearch = '';
    }

    public function removeLocationTag()
    {
        $this->filters['main_location_tag_id'] = null;
        $this->selectedLocationTag = null;
    }

}
