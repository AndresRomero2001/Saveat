<?php

namespace App\Livewire;

use App\Models\Restaurant as RestaurantModel;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class Restaurant extends Component
{
    public RestaurantModel $restaurant;
    public Collection $locationTags;
    public Collection $otherTags;

    public function mount(RestaurantModel $restaurant)
    {
        $this->restaurant = $restaurant;
        $this->locationTags = $restaurant->tags
            ->where('is_location', true)
            ->where('id', '!=', $restaurant->main_location_tag_id);
        $this->otherTags = $restaurant->tags
            ->where('is_location', false)
            ->where('id', '!=', $restaurant->main_tag_id);
    }

    public function render()
    {
        return view('livewire.restaurant');
    }
}
