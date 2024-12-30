<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200">
    <div class="flex justify-around items-center h-16">
        <a href="{{ route('restaurants.index') }}" class="text-zinc-700">
            <img src="{{ asset(request()->routeIs('restaurants.*') ? 'icons/food-bank.svg' : 'icons/food-bank-outline.svg') }}"
                 alt="Restaurants"
                 class="w-6 h-6">
        </a>

        <a href="{{ route('tags.index') }}" class="text-zinc-700">
            <img src="{{ asset(request()->routeIs('tags.*') ? 'icons/tag.svg' : 'icons/tag-outline.svg') }}"
                 alt="Tags"
                 class="w-6 h-6">
        </a>

        <a href="{{ route('profile.edit') }}" class="text-zinc-700">
            <img src="{{ asset(request()->routeIs('profile.*') ? 'icons/user.svg' : 'icons/user-outline.svg') }}"
                 alt="Profile"
                 class="w-6 h-6">
        </a>
    </div>
</nav>
