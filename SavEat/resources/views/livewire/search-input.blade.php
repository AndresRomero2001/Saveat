<div class="relative flex-1">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 h-full">
        <x-icon name="search-outline" class="w-6 h-6" color="gray-primary-light" />
    </div>
    <input
        type="search"
        wire:model.live="search"
        class="w-full h-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-transparent"
        placeholder="{{ $placeholder }}"
    >
</div>
