const staticCacheName = 'saveat-static-v1';
const dynamicCacheName = 'saveat-dynamic-v1';

// Assets to cache
const assets = [
    '/',
    'offline',
    'manifest.json',
    // Icons PNG
    'icons/icon-72x72.png',
    'icons/icon-96x96.png',
    'icons/icon-128x128.png',
    'icons/icon-144x144.png',
    'icons/icon-152x152.png',
    'icons/icon-192x192.png',
    'icons/icon-384x384.png',
    'icons/icon-512x512.png',
    // SVG icons
    'icons/delete.svg',
    'icons/filter-outline.svg',
    'icons/filter.svg',
    'icons/food-bank-outline.svg',
    'icons/food-bank.svg',
    'icons/location-outline.svg',
    'icons/location.svg',
    'icons/search-outline.svg',
    'icons/star-gray.svg',
    'icons/star-half.svg',
    'icons/star-yellow.svg',
    'icons/tag-outline.svg',
    'icons/tag.svg',
    'icons/user-filters-outline.svg',
    'icons/user-filters.svg',
    'icons/user-outline.svg',
    'icons/user-tag-outline.svg',
    'icons/user-tag.svg',
    'icons/user.svg'
];

// Install Service Worker
self.addEventListener('install', event => {
    // console.log('Service worker has been installed');
    event.waitUntil(
        caches.open(staticCacheName).then(cache => {
            return cache.addAll(assets);
        })
    );
});

// Activate Event
self.addEventListener('activate', event => {
    // console.log('Service worker has been activated');
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== staticCacheName && key !== dynamicCacheName)
                .map(key => caches.delete(key))
            );
        })
    );
});

// Fetch Event
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(cacheRes => {
                return cacheRes || fetch(event.request)
                    .then(fetchRes => {
                        return caches.open(dynamicCacheName)
                            .then(cache => {
                                // Don't cache POST requests or browser-sync requests
                                if (event.request.method !== 'POST' && !event.request.url.includes('browser-sync')) {
                                    cache.put(event.request.url, fetchRes.clone());
                                }
                                return fetchRes;
                            });
                    });
            })
            .catch(() => {
                if (event.request.url.indexOf('.html') > -1) {
                    return caches.match('/offline');
                }
            })
    );
});
