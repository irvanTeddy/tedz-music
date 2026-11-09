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

    // 1. Abaikan non-GET, audio/video range, dan file sw.js itu sendiri
    if (req.method !== 'GET' || req.headers.has('range')) return;
    if (url.pathname === '/sw.js') return;

    // 2. Hanya proses aset dari origin sendiri atau CDN UI (Tailwind & Vue).
    // Semua node eksternal Audius (rickyrombo.com, zeogrid.com, audius.co, dll) dilewatkan langsung.
    const isLocal = url.origin === self.location.origin;
    const isCdn = url.hostname === 'cdn.tailwindcss.com' || url.hostname === 'unpkg.com';
    if (!isLocal && !isCdn) return;

    // 3. Halaman navigasi: Jaringan dulu, fallback ke cache jika offline
    if (req.mode === 'navigate') {
        e.respondWith(
            fetch(req)
                .then(res => {
                    if (res.ok) {
                        const copy = res.clone();
                        caches.open(CACHE).then(c => c.put(req, copy));
                    }
                    return res;
                })
                .catch(() => caches.match(req).then(r => r || caches.match('/')))
        );
        return;
    }

    // 4. Aset statis (CSS, JS, Ikon lokal): Cache dulu, perbarui di belakang layar
    e.respondWith(
        caches.match(req).then(cached => {
            const net = fetch(req)
                .then(res => {
                    if (res.ok || res.type === 'opaque') {
                        const copy = res.clone();
                        caches.open(CACHE).then(c => c.put(req, copy));
                    }
                    return res;
                })
                .catch(() => {
                    // Pastikan selalu mengembalikan objek Response yang valid jika offline & belum ada di cache
                    return cached || new Response('', { status: 404, statusText: 'Offline' });
                });

            return cached || net;
        })
    );
});