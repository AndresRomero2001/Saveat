<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Install App') }}
                    </h3>
                    <div class="mt-3">
                        <button
                            id="installButton"
                            class="inline-flex items-center px-4 py-2 bg-primary-blue border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-primary-blue-dark focus:bg-primary-blue-dark active:bg-primary-blue-dark focus:outline-none focus:ring-2 focus:ring-primary-blue focus:ring-offset-2 transition ease-in-out duration-150"
                            style="display: none;"
                        >
                            {{ __('Install Saveat') }}
                        </button>
                        <p id="installText" class="text-sm text-gray-600" style="display: none;">
                            {{ __('App already installed') }}
                        </p>
                        <p id="notAvailableText" class="text-sm text-gray-600">
                            {{ __('Installation will be available when conditions are met') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    <livewire:default-filters />
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.logout-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let deferredPrompt;
        const installButton = document.getElementById('installButton');
        const installText = document.getElementById('installText');
        const notAvailableText = document.getElementById('notAvailableText');

        // Debug function to check PWA requirements
        async function checkPWARequirements() {
            const requirements = {
                isHttps: window.location.protocol === 'https:',
                hasServiceWorker: 'serviceWorker' in navigator,
                hasManifest: false,
                hasRequiredIcons: false,
                isStandalone: window.matchMedia('(display-mode: standalone)').matches,
                isInSupportedBrowser: /chrome|edge|samsung/i.test(navigator.userAgent)
            };

            // Check manifest
            try {
                const manifestResponse = await fetch('/manifest.json');
                if (manifestResponse.ok) {
                    requirements.hasManifest = true;
                    const manifest = await manifestResponse.json();
                    // Check for required icons (at least 192x192 and 512x512)
                    requirements.hasRequiredIcons = manifest.icons &&
                        manifest.icons.some(icon => icon.sizes === '192x192') &&
                        manifest.icons.some(icon => icon.sizes === '512x512');
                }
            } catch (e) {
                console.error('Error checking manifest:', e);
            }

            // Log results
            console.table(requirements);

            // Update UI with specific missing requirements
            let missingReqs = [];
            if (!requirements.isHttps) missingReqs.push('HTTPS connection');
            if (!requirements.hasServiceWorker) missingReqs.push('Service Worker support');
            if (!requirements.hasManifest) missingReqs.push('Web Manifest');
            if (!requirements.hasRequiredIcons) missingReqs.push('Required icons');
            if (!requirements.isInSupportedBrowser) missingReqs.push('Supported browser');

            if (missingReqs.length > 0) {
                notAvailableText.textContent = `Missing requirements: ${missingReqs.join(', ')}`;
            }

            return requirements;
        }

        // Run checks when page loads
        checkPWARequirements();

        // Rest of your existing code...
        if (window.matchMedia('(display-mode: standalone)').matches) {
            installButton.style.display = 'none';
            installText.style.display = 'block';
            notAvailableText.style.display = 'none';
        }

        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('Install prompt triggered!'); // Debug log
            e.preventDefault();
            deferredPrompt = e;
            notAvailableText.style.display = 'none';
            installButton.style.display = 'inline-flex';
        });

        installButton.addEventListener('click', async () => {
            if (!deferredPrompt) {
                console.log('No deferred prompt available'); // Debug log
                return;
            }
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            console.log('Install prompt outcome:', outcome); // Debug log
            deferredPrompt = null;
            installButton.style.display = 'none';
            if (outcome === 'accepted') {
                installText.style.display = 'block';
            } else {
                notAvailableText.style.display = 'block';
            }
        });

        window.addEventListener('appinstalled', (evt) => {
            console.log('App installed!'); // Debug log
            installButton.style.display = 'none';
            installText.style.display = 'block';
            notAvailableText.style.display = 'none';
        });
    </script>
    @endpush
</x-app-layout>
