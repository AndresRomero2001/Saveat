<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Cerrar sesión') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Cierra tu sesión en todos los dispositivos.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="flex justify-end">
            <x-danger-button>
                {{ __('Cerrar sesión') }}
            </x-danger-button>
    </form>
</section>
