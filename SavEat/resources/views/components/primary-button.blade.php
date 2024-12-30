<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-blue/90 active:bg-primary-blue/80 focus:outline-none focus:ring-2 focus:ring-primary-blue focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
