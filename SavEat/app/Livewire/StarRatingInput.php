<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
class StarRatingInput extends Component
{
    public $value = 0;
    public $id;

    public function mount($value = 0, $id = 'rating')
    {
        $this->value = $value;
        $this->id = $id;
    }

    public function updating($property, $value)
    {
        if ($property === 'value') {
            $this->dispatch('rating-changed', value: $value);
        }
    }

    public function render()
    {
        return view('livewire.star-rating-input');
    }

    #[On('rating-reset')]
    public function resetRating()
    {
        $this->value = 0;
    }
}
