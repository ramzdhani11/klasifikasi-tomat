// Service Worker untuk caching dan offline support
const CACHE_NAME = 'admin-dashboard-v1';
const urlsToCache = [
    '/admin',
    '/admin/dashboard',
    '/admin/system-statistics',
    '/admin/classification-history',
    '/admin/manage-admin',
    'https://cdn.tailwindcss.com',
    'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
];

// Install Service Worker
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Cache opened');
                return cache.addAll(urlsToCache).catch(err => {
                    console.log('Cache addAll partially failed:', err);
                    // Continue even if some urls fail to cache
                    return Promise.resolve();
                });
            })
    );
    self.skipWaiting();
});

// Activate Service Worker
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// Fetch Event - Network First, then Cache
self.addEventListener('fetch', event => {
    const { request } = event;
    const url = new URL(request.url);
    
    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }
    
    // Skip admin area fetches (always fresh)
    if (url.pathname.includes('/admin/api/')) {
        event.respondWith(
            fetch(request)
                .then(response => {
                    // Cache valid responses
                    if (response && response.status === 200 && response.type === 'basic') {
                        const responseToCache = response.clone();
                        caches.open(CACHE_NAME).then(cache => {
                            cache.put(request, responseToCache);
                        });
                    }
                    return response;
                })
                .catch(() => {
                    // Return cached version if network fails
                    return caches.match(request)
                        .then(cached => cached || new Response('Offline', { status: 503 }));
                })
        );
        return;
    }
    
    // Cache First strategy untuk static assets
    if (request.url.includes('cdn.') || 
        request.url.includes('fonts.') || 
        request.url.includes('cdnjs')) {
        event.respondWith(
            caches.match(request)
                .then(cached => {
                    return cached || fetch(request)
                        .then(response => {
                            if (response && response.status === 200) {
                                const responseToCache = response.clone();
                                caches.open(CACHE_NAME).then(cache => {
                                    cache.put(request, responseToCache);
                                });
                            }
                            return response;
                        })
                        .catch(() => new Response('Resource not available', { status: 404 }));
                })
        );
        return;
    }
    
    // Network First for HTML pages
    event.respondWith(
        fetch(request)
            .then(response => {
                if (response && response.status === 200) {
                    const responseToCache = response.clone();
                    caches.open(CACHE_NAME).then(cache => {
                        cache.put(request, responseToCache);
                    });
                }
                return response;
            })
            .catch(() => {
                return caches.match(request)
                    .then(cached => cached || new Response('Offline - Page not cached', { status: 503 }));
            })
    );
});
