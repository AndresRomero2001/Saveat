<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class TagHeader extends Component
{
    public $title = 'Tags';

    #[On('filters-changed')]
    public function updateTitle($showOnlyUserTags, $showOnlyLocations)
    {
        if ($showOnlyUserTags) {
            if ($showOnlyLocations) {
                $this->title = __('My Tags') . ' - ' . __('Locations');
            } else {
                $this->title = __('My Tags');
            }
        } else if ($showOnlyLocations) {
            $this->title = __('Locations');
        } else {
            $this->title = __('Tags');
        }
    }

    public function render()
    {
        return view('livewire.tag-header');
    }
}
