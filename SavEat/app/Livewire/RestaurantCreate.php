<?php

namespace App\Livewire;

use App\Models\Restaurant;
use App\Models\Tag;
use App\Enums\PriceRange;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class RestaurantCreate extends Component
{
    public $showCreateTagModal = false;
    public $name = '';
    public $main_tag_id = '';
    public $main_location_tag_id = '';
    public $price_range = null;
    public $rating = null;
    public $description = '';
    public $selectedTags = [];
    public $tagSearch = '';
    public $mainTagSearch = '';
    public $locationTagSearch = '';
    public $selectedMainTag = null;
    public $selectedLocationTag = null;
    public $newTagName = '';
    public $newTagIsLocation = false;
    public $mainTagSearchFocused = false;
    public $locationTagSearchFocused = false;
    public $tagSearchFocused = false;
    public $createTagSource = '';

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'main_tag_id' => ['required', 'exists:tags,id'],
            'main_location_tag_id' => ['required', 'exists:tags,id'],
            'price_range' => ['nullable'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'description' => ['nullable', 'string'],
            'selectedTags' => ['array'],
            'selectedTags.*' => ['exists:tags,id'],
        ];
    }

    #[On('rating-changed')]
    public function handleRatingChange($value)
    {
        $this->rating = $value;
    }

    public function addTag($tagId)
    {
        if (!in_array($tagId, $this->selectedTags)) {
            $this->selectedTags[] = $tagId;
        }
        $this->tagSearch = '';
    }

    public function removeTag($tagId)
    {
        $this->selectedTags = array_filter($this->selectedTags, fn($id) => $id != $tagId);
    }

    public function createRestaurant()
    {
        $validated = $this->validate();

        // Convert empty price_range to null
        if ($validated['price_range'] === '') {
            $validated['price_range'] = null;
        }

        $restaurant = Restaurant::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        if (!empty($this->selectedTags)) {
            $restaurant->tags()->attach($this->selectedTags);
        }

        return redirect()->route('restaurants.index')
            ->with('message', __('Restaurant created successfully'));
    }

    public function setMainTag($tagId)
    {
        $this->main_tag_id = $tagId;
        $this->mainTagSearch = '';
        $this->selectedMainTag = Tag::find($tagId);
    }

    public function removeMainTag()
    {
        $this->main_tag_id = '';
        $this->selectedMainTag = null;
    }

    public function setLocationTag($tagId)
    {
        $this->main_location_tag_id = $tagId;
        $this->locationTagSearch = '';
        $this->selectedLocationTag = Tag::find($tagId);
    }

    public function removeLocationTag()
    {
        $this->main_location_tag_id = '';
        $this->selectedLocationTag = null;
    }

    public function mount()
    {
        $this->showCreateTagModal = false;
        if ($this->main_tag_id) {
            $this->selectedMainTag = Tag::find($this->main_tag_id);
        }
        if ($this->main_location_tag_id) {
            $this->selectedLocationTag = Tag::find($this->main_location_tag_id);
        }
    }

    public function render()
    {
        return view('livewire.restaurant-create', [
            'searchedMainTags' => Tag::where('name', 'like', '%' . $this->mainTagSearch . '%')
                ->where('is_location', false)
                ->orderBy('name')
                ->get(),
            'mainTags' => Tag::where('is_location', false)->where('is_default', true)->orderBy('name')->get(),
            'locationTags' => Tag::where('is_location', true)->orderBy('name')->get(),
            'priceRanges' => collect(PriceRange::cases())->mapWithKeys(fn ($range) => [(int)$range->value => $range->label()]),
            'searchedTags' => Tag::where('name', 'like', '%' . $this->tagSearch . '%')
                ->whereNotIn('id', $this->selectedTags)
                ->orderBy('name')
                ->get(),
            'selectedTagsData' => Tag::whereIn('id', $this->selectedTags)->get(),
            'searchedLocationTags' => Tag::where('name', 'like', '%' . $this->locationTagSearch . '%')
                ->where('is_location', true)
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function openCreateTagModal($source)
    {
        $this->createTagSource = $source;

        switch ($source) {
            case 'main':
                $this->newTagName = $this->mainTagSearch;
                $this->newTagIsLocation = false;
                break;
            case 'location':
                $this->newTagName = $this->locationTagSearch;
                $this->newTagIsLocation = true;
                break;
            default:
                $this->newTagName = $this->tagSearch;
                $this->newTagIsLocation = false;
        }

        $this->showCreateTagModal = true;
    }

    public function createTag()
    {
        $tag = Tag::create([
            'name' => $this->newTagName,
            'user_id' => Auth::id(),
            'is_location' => $this->newTagIsLocation
        ]);

        if ($this->createTagSource === 'location') {
            $this->setLocationTag($tag->id);
            $this->locationTagSearch = '';
        } elseif ($this->createTagSource === 'main') {
            $this->setMainTag($tag->id);
            $this->mainTagSearch = '';
        } else {
            $this->addTag($tag->id);
            $this->tagSearch = '';
        }

        $this->showCreateTagModal = false;
        $this->newTagName = '';
        $this->newTagIsLocation = false;
        $this->createTagSource = '';
    }
}
