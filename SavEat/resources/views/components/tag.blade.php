@props(['tag', 'mode' => 'editable'])

<div class="inline-flex items-center bg-white rounded-md pl-2 pr-2 py-1 text-sm shadow">
    @if ($mode === 'editable' && !$tag->is_default)
        <button
            type="button"
            class="text-gray-700 hover:text-gray-900 focus:outline-none"
            wire:click="editTag({{ $tag->id }})"
        >
            {{ $tag->name }}
        </button>

        <button
            type="button"
            class="text-gray-400 hover:text-gray-600 focus:outline-none"
            wire:click="confirmDelete({{ $tag->id }})"
        >
            <span class="w-6 h-6 text-gray-primary-dark">
                <x-icon name="delete" />
            </span>
        </button>
    @else
        <span class="text-gray-700">{{ $tag->name }}</span>
    @endif
</div>
