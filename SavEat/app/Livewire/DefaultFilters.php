<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\UserDefaultFilter;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class DefaultFilters extends Component
{
    public $tagSearch = '';
    public $mainTagSearch = '';
    public $locationTagSearch = '';
    public Collection $selectedTags;
    public $selectedMainTag = null;
    public $selectedLocationTag = null;
    public $filters = [
        'rating' => 0,
        'price_ranges' => [],
        'tag_ids' => []
    ];
    public $showSuccessMessage = false;

    public function mount()
    {
        $this->selectedTags = collect();
        $this->loadDefaultFilters();
    }

    public function loadDefaultFilters()
    {
        $defaultFilters = UserDefaultFilter::where('user_id', Auth::id())->first();

        if ($defaultFilters) {
            $this->filters['rating'] = $defaultFilters->rating ?? 0;
            $this->filters['price_ranges'] = $defaultFilters->price_ranges ?? [];
            $this->filters['tag_ids'] = $defaultFilters->tag_ids ?? [];
            $this->selectedMainTag = $defaultFilters->mainTag;
            $this->selectedLocationTag = $defaultFilters->mainLocationTag;
            $this->selectedTags = Tag::whereIn('id', $this->filters['tag_ids'])->get();
        }
    }

    public function setMainTag($tagId)
    {
        $this->selectedMainTag = Tag::find($tagId);
        $this->mainTagSearch = '';
    }

    public function setLocationTag($tagId)
    {
        $this->selectedLocationTag = Tag::find($tagId);
        $this->locationTagSearch = '';
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

    #[On('rating-changed')]
    public function handleRatingChange($value)
    {
        $this->filters['rating'] = $value;
    }

    public function saveDefaultFilters()
    {
        UserDefaultFilter::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'main_tag_id' => $this->selectedMainTag?->id,
                'main_location_tag_id' => $this->selectedLocationTag?->id,
                'rating' => $this->filters['rating'],
                'price_ranges' => $this->filters['price_ranges'],
                'tag_ids' => $this->filters['tag_ids']
            ]
        );

        $this->showSuccessMessage = true;
    }

    #[On('hideMessage')]
    public function hideMessage()
    {
        $this->showSuccessMessage = false;
    }

    public function render()
    {
        return view('livewire.default-filters', [
            'searchedMainTags' => !empty($this->mainTagSearch)
                ? Tag::where('name', 'like', '%' . $this->mainTagSearch . '%')
                    ->where('is_location', false)
                    ->orderBy('name')
                    ->limit(5)
                    ->get()
                : collect(),
            'searchedLocationTags' => !empty($this->locationTagSearch)
                ? Tag::where('name', 'like', '%' . $this->locationTagSearch . '%')
                    ->where('is_location', true)
                    ->orderBy('name')
                    ->limit(5)
                    ->get()
                : collect(),
            'searchedTags' => !empty($this->tagSearch)
                ? Tag::where('name', 'like', '%' . $this->tagSearch . '%')
                    ->whereNotIn('id', $this->selectedTags->pluck('id'))
                    ->orderBy('name')
                    ->limit(5)
                    ->get()
                : collect()
        ]);
    }
}
