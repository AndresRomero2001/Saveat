<x-guest-layout>
    <div class="text-center max-w-md mx-auto p-8 pb-4">
        <!-- Warning Icon -->
        <div class="flex justify-center">
            <div class="w-20 h-20 text-red-500">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mb-10">
            403
        </h1>

        <p class="text-gray-600 mb-12">
            {{ __('Esta acción no está autorizada.') }}
        </p>

        <div class="">
            <a
                href="{{ url()->previous() }}"
                class="inline-block bg-primary-blue text-white rounded-lg px-4 py-2 font-medium hover:bg-primary-blue-dark"
            >
                {{ __('Volver') }}
            </a>
        </div>
    </div>
</x-guest-layout>
