<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
class TagManager extends Component
{
    public $tags;
    public $editingTagId = null;
    public $editingTagName = '';
    public $editingTagIsLocation = false;
    public $showEditModal = false;
    public $showCreateModal = false;
    public $tag_name = '';
    public $isLocation = false;
    public $search = '';
    public $showOnlyLocations = false;
    public $showOnlyUserTags = false;
    public $showDeleteModal = false;
    public $deletingTagId = null;

    public function mount()
    {
        $this->loadTags();
    }

    #[On('search-updated')]
    public function handleSearch($search)
    {
        $this->search = $search;
        $this->loadTags();
    }

    public function loadTags()
    {
        $query = Tag::orderBy('name');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->showOnlyLocations) {
            $query->where('is_location', true);
        }

        if ($this->showOnlyUserTags) {
            $query->where('user_id', Auth::id());
        }

        $this->tags = $query->get();
    }

    public function toggleLocationFilter()
    {
        $this->showOnlyLocations = !$this->showOnlyLocations;
        $this->loadTags();
        $this->dispatch('filters-changed', showOnlyUserTags: $this->showOnlyUserTags, showOnlyLocations: $this->showOnlyLocations);
    }

    public function toggleUserFilter()
    {
        $this->showOnlyUserTags = !$this->showOnlyUserTags;
        $this->loadTags();
        $this->dispatch('filters-changed', showOnlyUserTags: $this->showOnlyUserTags, showOnlyLocations: $this->showOnlyLocations);
    }

    public function editTag($tagId)
    {
        $tag = Tag::find($tagId);
        $this->editingTagId = $tag->id;
        $this->editingTagName = $tag->name;
        $this->editingTagIsLocation = $tag->is_location;
        $this->showEditModal = true;
    }

    public function updateTag()
    {
        $this->validate([
            'editingTagName' => 'required|min:2|max:50|unique:tags,name,' . $this->editingTagId,
        ]);

        $tag = Tag::find($this->editingTagId);
        $tag->update([
            'name' => $this->editingTagName,
            'is_location' => $this->editingTagIsLocation
        ]);

        $this->showEditModal = false;
        $this->resetEditingFields();
        $this->loadTags();
    }

    private function resetEditingFields()
    {
        $this->editingTagId = null;
        $this->editingTagName = '';
        $this->editingTagIsLocation = false;
    }

    public function confirmDelete($tagId)
    {
        $this->deletingTagId = $tagId;
        $this->showDeleteModal = true;
    }

    public function deleteTag()
    {
        Tag::find($this->deletingTagId)->delete();
        $this->showDeleteModal = false;
        $this->deletingTagId = null;
        $this->loadTags();
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function createTag()
    {
        $this->validate([
            'tag_name' => 'required|min:2|max:25|unique:tags,name',
        ]);

        Tag::create([
            'name' => $this->tag_name,
            'is_location' => $this->isLocation ?? false,
            'is_default' => false,
            'user_id' => Auth::id()
        ]);

        $this->showCreateModal = false;
        $this->tag_name = '';
        $this->isLocation = false;
        $this->loadTags();
    }

    public function render()
    {
        return view('livewire.tag-manager');
    }
}
