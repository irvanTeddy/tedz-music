// Tedz Music service worker. Naikkan CACHE saat mengubah file ini agar cache lama dibuang.
const CACHE = 'tedz-music-v2';

self.addEventListener('install', () => self.skipWaiting());

self.addEventListener('activate', e => {
    e.waitUntil(
        caches.keys()
            .then(keys => Promise.all(keys.filter(k => k !== CACHE).map(k => caches.delete(k))))
            .then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', e => {
    const req = e.request, url = new URL(req.url);

    // Audio, API Audius, dan request non-GET selalu langsung ke jaringan
    if (req.method !== 'GET' || req.headers.has('range')) return;
    if (url.hostname.endsWith('audius.co') || url.hostname.endsWith('lrclib.net')) return;
    if (url.pathname === '/sw.js') return;

    // Halaman: jaringan dulu, pakai cache hanya jika offline
    if (req.mode === 'navigate') {
        e.respondWith(
            fetch(req)
                .then(res => {
                    if (res.ok) { const copy = res.clone(); caches.open(CACHE).then(c => c.put(req, copy)); }
                    return res;
                })
                .catch(() => caches.match(req).then(r => r || caches.match('/')))
        );
        return;
    }

    // Aset (CSS, JS, font, gambar): cache dulu, diperbarui di belakang
    e.respondWith(
        caches.match(req).then(cached => {
            const net = fetch(req)
                .then(res => {
                    if (res.ok || res.type === 'opaque') { const copy = res.clone(); caches.open(CACHE).then(c => c.put(req, copy)); }
                    return res;
                })
                .catch(() => cached);
            return cached || net;
        })
    );
});