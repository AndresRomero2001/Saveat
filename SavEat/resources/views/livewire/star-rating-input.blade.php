<div>
    <div class="flex flex-col gap-2">
        <div class="flex gap-1">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($value))
                    <img src="{{ asset('icons/star-yellow.svg') }}" alt="★" class="w-6 h-6">
                @elseif ($i - 0.5 == $value)
                    <img src="{{ asset('icons/star-half.svg') }}" alt="★" class="w-6 h-6">
                @else
                    <img src="{{ asset('icons/star-gray.svg') }}" alt="★" class="w-6 h-6">
                @endif
            @endfor
        </div>

        <input
            type="range"
            wire:model.live="value"
            id="{{ $id }}"
            min="0"
            max="5"
            step="0.5"
            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
        >

        <div class="flex justify-between px-2">
            <span class="text-xs text-gray-500">0</span>
            <span class="text-xs text-gray-500">5</span>
        </div>
    </div>
</div>
