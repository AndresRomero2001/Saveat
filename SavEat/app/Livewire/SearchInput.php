<?php

namespace App\Livewire;

use Livewire\Component;

class SearchInput extends Component
{
    public $search = '';
    public $placeholder;

    public function mount($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public function updatedSearch()
    {
        $this->dispatch('search-updated', search: $this->search);
    }

    public function render()
    {
        return view('livewire.search-input');
    }
}
