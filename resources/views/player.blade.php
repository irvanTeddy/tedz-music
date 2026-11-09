@verbatim
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0c1511">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/svg+xml" href="/icons/logo.svg">
    <link rel="icon" type="image/png" href="/icons/icon-51.png">
    <link rel="apple-touch-icon" href="/icons/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Tedz Music">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Tedz Music</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#0c1511',
                        panel: '#14211b',
                        line: '#26382f',
                        mist: '#8fa398',
                        sun: '#f2c94c',
                        mint: '#3ddc97'
                    },
                    fontFamily: {
                        display: ['"Bricolage Grotesque"', 'system-ui', 'sans-serif'],
                        sans: ['"DM Sans"', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        html {
            color-scheme: dark;
            -webkit-tap-highlight-color: transparent;
        }

        [v-cloak] {
            display: none;
        }

        body {
            overflow-x: clip;
        }

        .glow {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .glow::before {
            content: '';
            position: absolute;
            inset: -15%;
            background-image: var(--g, none);
            background-size: cover;
            background-position: center;
            filter: blur(80px) saturate(1.5);
            opacity: .32;
        }

        .disc.on {
            animation: spin 20s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .eq {
            display: flex;
            gap: 2px;
            align-items: flex-end;
            height: 14px;
        }

        .eq i {
            width: 3px;
            height: 100%;
            background: #f2c94c;
            border-radius: 2px;
            transform-origin: bottom;
            animation: eq .9s ease-in-out infinite;
        }

        .eq i:nth-child(2) {
            animation-delay: -.3s;
        }

        .eq i:nth-child(3) {
            animation-delay: -.6s;
        }

        .eq.off i {
            animation-play-state: paused;
            transform: scaleY(.3);
        }

        @keyframes eq {

            0%,
            100% {
                transform: scaleY(.3);
            }

            50% {
                transform: scaleY(1);
            }
        }

        input[type=range] {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 4px;
            border-radius: 99px;
            outline: none;
            cursor: pointer;
            background: linear-gradient(to right, #f2c94c var(--p, 0%), #26382f var(--p, 0%));
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #fff;
            border: 0;
        }

        input[type=range]::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #fff;
            border: 0;
        }

        :focus-visible {
            outline: 2px solid #f2c94c;
            outline-offset: 2px;
        }

        .skel {
            background: linear-gradient(90deg, #14211b, #1c2d25, #14211b);
            background-size: 200% 100%;
            animation: sk 1.4s infinite;
        }

        @keyframes sk {
            to {
                background-position: -200% 0;
            }
        }

        .ico {
            width: 22px;
            height: 22px;
        }

        .stroke {
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .liked path {
            fill: currentColor;
        }

        .cover {
            touch-action: pan-y;
        }

        .fade-y {
            -webkit-mask-image: linear-gradient(to bottom, transparent 0, #000 14%, #000 86%, transparent 100%);
            mask-image: linear-gradient(to bottom, transparent 0, #000 14%, #000 86%, transparent 100%);
        }

        .noscroll {
            scrollbar-width: none;
        }

        .noscroll::-webkit-scrollbar {
            display: none;
        }

        input[type=range] {
            margin: 10px 0;
        }

        @media (pointer: coarse) {
            input[type=range]::-webkit-slider-thumb {
                width: 22px;
                height: 22px;
            }

            input[type=range]::-moz-range-thumb {
                width: 22px;
                height: 22px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body class="bg-ink text-[#eef3ea] font-sans min-h-screen selection:bg-sun selection:text-ink">
    <div class="glow" id="glow"></div>

    <div id="app" v-cloak class="relative z-10 max-w-6xl mx-auto px-4 md:px-6 pb-44 lg:pb-10">

        <!-- Header -->
        <header class="sticky top-0 z-30 -mx-4 md:-mx-6 px-4 md:px-6 py-3 bg-ink/70 backdrop-blur-xl flex items-center justify-between gap-4">
            <div class="flex items-center gap-2.5 shrink-0">
                <svg class="w-9 h-9 shrink-0" viewBox="0 0 512 512" aria-hidden="true">
                    <defs>
                        <linearGradient id="hd-bg" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0" stop-color="#1f4a37" />
                            <stop offset="1" stop-color="#0a120e" />
                        </linearGradient>
                        <radialGradient id="hd-gl" cx=".25" cy=".15" r=".8">
                            <stop offset="0" stop-color="#3ddc97" stop-opacity=".3" />
                            <stop offset="1" stop-color="#3ddc97" stop-opacity="0" />
                        </radialGradient>
                        <linearGradient id="hd-mk" gradientUnits="userSpaceOnUse" x1="0" y1="126" x2="0" y2="386">
                            <stop offset="0" stop-color="#ffe680" />
                            <stop offset="1" stop-color="#f2c94c" />
                        </linearGradient>
                    </defs>
                    <rect width="512" height="512" rx="116" fill="url(#hd-bg)" />
                    <rect width="512" height="512" rx="116" fill="url(#hd-gl)" />
                    <g transform="translate(256 256) scale(1.0) translate(-256 -256)">
                        <circle cx="256" cy="256" r="220" fill="#08110d" />
                        <g fill="none" stroke="#3ddc97" stroke-opacity=".18" stroke-width="3">
                            <circle cx="256" cy="256" r="196" />
                            <circle cx="256" cy="256" r="172" />
                            <circle cx="256" cy="256" r="148" />
                        </g>
                        <circle cx="256" cy="256" r="130" fill="url(#hd-mk)" />
                        <rect x="176" y="176" width="160" height="40" rx="14" fill="#0c1511" />
                        <rect x="236" y="176" width="40" height="160" rx="14" fill="#0c1511" />
                    </g>
                </svg>
                <h1 class="font-display font-extrabold text-xl tracking-tight">Tedz <span class="text-sun">Music.</span></h1>
            </div>
            <label class="relative w-full max-w-xs hidden lg:block">
                <span class="sr-only">Cari lagu atau artis di Audius</span>
                <svg class="stroke absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-mist" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-3.5-3.5" />
                </svg>
                <input type="search" v-model="query" placeholder="Cari jutaan lagu atau artis..."
                    class="w-full bg-panel border border-line rounded-full pl-9 pr-4 py-2 text-sm placeholder-mist focus:outline-none focus:border-sun transition">
            </label>
        </header>

        <div class="mt-4 grid grid-cols-[minmax(0,1fr)] lg:grid-cols-[minmax(0,1fr)_380px] gap-8 items-start">

            <!-- Daftar lagu -->
            <main class="min-w-0">
                <div class="flex items-center justify-between gap-3 mb-3 px-1">
                    <div class="min-w-0">
                        <h2 class="font-display font-extrabold text-3xl md:text-4xl tracking-tight truncate" v-text="heading"></h2>
                        <p class="text-sm text-mist mt-0.5" v-text="subHeading"></p>
                    </div>
                    <div class="hidden lg:flex p-1 rounded-full bg-panel border border-line text-sm shrink-0">
                        <button type="button" v-on:click="tab='home'" class="px-4 py-1.5 rounded-full transition" :class="tab!=='fav' ? 'bg-sun text-ink font-bold' : 'text-mist hover:text-white'">Semua</button>
                        <button type="button" v-on:click="tab='fav'" class="px-4 py-1.5 rounded-full transition" :class="tab==='fav' ? 'bg-sun text-ink font-bold' : 'text-mist hover:text-white'">Disukai</button>
                    </div>
                </div>

                <!-- Pencarian (mobile, tab Cari) -->
                <label v-if="tab==='search'" class="relative block mb-3 lg:hidden">
                    <span class="sr-only">Cari lagu atau artis</span>
                    <svg class="stroke absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-mist" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />
                    </svg>
                    <input ref="searchEl" type="search" v-model="query" placeholder="Cari jutaan lagu atau artis..."
                        class="w-full h-12 bg-panel border border-line rounded-2xl pl-10 pr-4 text-base placeholder-mist focus:outline-none focus:border-sun">
                </label>

                <div v-if="tab==='home' && !query.trim()" class="noscroll flex gap-2 overflow-x-auto -mx-4 px-4 md:mx-0 md:px-0 pb-3" role="group" aria-label="Genre">
                    <button v-for="g in genres" :key="g.v" type="button" v-on:click="setGenre(g.v)"
                        class="h-9 px-4 rounded-full text-sm whitespace-nowrap shrink-0 border transition"
                        :class="genre === g.v ? 'bg-sun text-ink border-sun font-bold' : 'border-line text-mist hover:text-white'" v-text="g.l"></button>
                </div>

                <ul v-if="(loading || searching) && tab!=='fav'" class="space-y-2" aria-busy="true">
                    <li v-for="n in 8" :key="n" class="skel h-[68px] rounded-xl"></li>
                </ul>

                <div v-else-if="error && tab!=='fav'" class="rounded-2xl border border-line bg-panel p-8 text-center">
                    <p class="font-medium">Lagu gagal dimuat.</p>
                    <p class="text-sm text-mist mt-1">Periksa koneksi internet, lalu coba lagi.</p>
                    <button type="button" v-on:click="retry" class="mt-4 px-5 h-11 rounded-full bg-sun text-ink font-bold text-sm">Coba lagi</button>
                </div>

                <div v-else-if="!filtered.length" class="rounded-2xl border border-line bg-panel p-8 text-center">
                    <template v-if="tab==='fav' && !query.trim()">
                        <p class="font-medium">Belum ada lagu disukai.</p>
                        <p class="text-sm text-mist mt-1">Ketuk ikon hati di lagu mana pun untuk menyimpannya di sini.</p>
                    </template>
                    <template v-else>
                        <p class="font-medium" v-text="'Tidak ada hasil untuk “' + query.trim() + '”'"></p>
                        <p class="text-sm text-mist mt-1">Coba kata kunci judul atau nama artis lain.</p>
                    </template>
                </div>

                <ul v-else class="space-y-1">
                    <li v-for="s in filtered" :key="s.id" class="flex items-center rounded-xl transition hover:bg-white/5" :class="isCur(s) ? 'bg-white/10' : ''">
                        <button type="button" v-on:click="play(s)" class="flex-1 min-w-0 flex items-center gap-3 md:gap-4 p-2.5 text-left">
                            <div class="relative w-12 h-12 md:w-14 md:h-14 shrink-0 rounded-lg overflow-hidden bg-panel">
                                <img :src="cover(s,'150x150')" v-on:error.once="drop(s.id)" loading="lazy" alt="" class="w-full h-full object-cover">
                                <div v-if="isCur(s)" class="absolute inset-0 bg-ink/60 grid place-items-center">
                                    <div class="eq" :class="isPlaying ? '' : 'off'"><i></i><i></i><i></i></div>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate font-medium" :class="isCur(s) ? 'text-sun' : ''" v-text="s.title"></p>
                                <p class="truncate text-sm text-mist" v-text="s.user.name"></p>
                            </div>
                            <span class="text-xs text-mist tabular-nums hidden sm:block" v-text="fmt(s.duration)"></span>
                        </button>
                        <button type="button" v-on:click="toggleFav(s)" class="w-11 h-11 mr-1 grid place-items-center rounded-full shrink-0 transition active:scale-90"
                            :class="isFav(s) ? 'text-sun' : 'text-mist hover:text-white'" :aria-pressed="isFav(s)" aria-label="Sukai lagu">
                            <svg class="stroke ico" :class="isFav(s) ? 'liked' : ''" viewBox="0 0 24 24">
                                <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1 1.1L12 21.2l7.8-7.7 1-1.1a5.5 5.5 0 0 0 0-7.8z" />
                            </svg>
                        </button>
                    </li>
                </ul>
            </main>

            <!-- Pemutar: sticky di desktop, sheet layar penuh di mobile -->
            <section ref="sheet" aria-label="Pemutar musik"
                class="fixed inset-x-0 top-0 h-[100dvh] lg:h-auto lg:max-h-[calc(100dvh_-_5.5rem)] lg:sticky lg:inset-auto lg:top-[4.5rem] lg:z-10 z-50 overflow-y-auto overscroll-contain bg-ink lg:bg-panel/80 lg:backdrop-blur lg:border lg:border-line lg:rounded-3xl p-5 pt-3 lg:pt-5 pb-[max(1.25rem,env(safe-area-inset-bottom))] transition-transform duration-300"
                :class="expanded ? 'translate-y-0' : 'translate-y-full lg:translate-y-0'" :style="sheetStyle"
                v-on:touchstart.passive="dS" v-on:touchmove.passive="dM" v-on:touchend="dE">

                <div class="lg:hidden flex justify-center -mt-2 mb-1"><span class="w-10 h-1 rounded-full bg-line"></span></div>
                <div class="flex items-center justify-between lg:hidden">
                    <button type="button" v-on:click="expanded=false" class="w-11 h-11 -ml-2 grid place-items-center rounded-full hover:bg-white/10" aria-label="Tutup pemutar">
                        <svg class="stroke ico" viewBox="0 0 24 24">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <span class="text-sm text-mist">Sedang diputar</span>
                    <span class="w-9"></span>
                </div>

                <!-- Cover: persegi di mobile (geser kiri/kanan ganti lagu), piringan di desktop -->
                <div v-if="!showLyrics" class="cover relative aspect-square mx-auto my-3 w-[min(72vw,34dvh)] lg:w-[clamp(7rem,28dvh,15rem)] transition-transform duration-300"
                    :class="isPlaying ? '' : 'scale-95'"
                    v-on:touchstart.passive="tStart" v-on:touchend="tEnd">
                    <div class="disc w-full h-full rounded-full overflow-hidden border-[6px] border-line shadow-2xl bg-panel" :class="isPlaying ? 'on' : ''">
                        <img v-if="current" :src="cover(current,'480x480')" v-on:error.once="$event.target.src = '/icons/icon-512.png'" alt="" class="w-full h-full object-cover select-none" draggable="false">
                        <div v-else class="w-full h-full grid place-items-center text-5xl text-mist">♪</div>
                    </div>
                    <div class="absolute inset-0 grid place-items-center pointer-events-none">
                        <div class="w-8 h-8 rounded-full bg-ink border-4 border-line"></div>
                    </div>
                </div>

                <div v-else class="my-3">
                    <div ref="lyricsEl" data-lyrics
                        class="relative overflow-y-auto overscroll-contain noscroll fade-y h-[calc(100dvh_-_20.5rem)] min-h-[10rem] lg:h-[clamp(9rem,34dvh,17rem)]">
                        <template v-if="lyrics.status === 'ok'">
                            <div class="h-3"></div>
                            <p v-for="(l, i) in lyrics.lines" :key="i" class="px-2 py-0.5 font-display font-bold text-xl lg:text-lg leading-snug text-white/85" v-text="l.text || '\u00a0'"></p>
                            <div class="h-3"></div>
                        </template>
                        <div v-else class="h-full grid place-items-center text-center px-6 text-mist">
                            <div v-if="lyrics.status === 'loading'" class="w-full space-y-3" aria-busy="true">
                                <div class="skel h-6 rounded-lg w-4/5"></div>
                                <div class="skel h-6 rounded-lg w-3/5"></div>
                                <div class="skel h-6 rounded-lg w-2/3"></div>
                            </div>
                            <p v-else-if="lyrics.status === 'instrumental'">Lagu ini instrumental.</p>
                            <div v-else-if="lyrics.status === 'error'">
                                <p>Lirik gagal dimuat.</p>
                                <button type="button" v-on:click="loadLyrics" class="mt-3 px-4 h-10 rounded-full bg-sun text-ink font-bold text-sm">Coba lagi</button>
                            </div>
                            <p v-else-if="lyrics.status === 'none'">Lirik belum tersedia untuk lagu ini.</p>
                            <p v-else>Putar lagu untuk melihat lirik.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div class="min-w-0 flex-1 lg:text-center">
                        <p class="font-display font-extrabold text-xl truncate" v-text="current ? current.title : 'Belum ada lagu'"></p>
                        <p class="text-sm text-mist truncate mt-0.5" v-text="current ? current.user.name : 'Pilih lagu dari daftar untuk mulai'"></p>
                    </div>
                    <button v-if="current" type="button" v-on:click="toggleFav(current)" class="w-11 h-11 grid place-items-center rounded-full shrink-0 transition active:scale-90 lg:hidden"
                        :class="isFav(current) ? 'text-sun' : 'text-mist'" aria-label="Sukai lagu">
                        <svg class="stroke ico" :class="isFav(current) ? 'liked' : ''" viewBox="0 0 24 24">
                            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1 1.1L12 21.2l7.8-7.7 1-1.1a5.5 5.5 0 0 0 0-7.8z" />
                        </svg>
                    </button>
                </div>

                <div class="mt-1">
                    <input type="range" min="0" :max="dur || 0" step="0.1" :value="time" :disabled="!current"
                        :style="{'--p': pct + '%'}" v-on:input="seek" aria-label="Posisi lagu">
                    <div class="flex justify-between text-xs text-mist mt-1 tabular-nums">
                        <span v-text="fmt(time)"></span><span v-text="fmt(dur)"></span>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 sm:gap-4 mt-1">
                    <button type="button" v-on:click="shuffle=!shuffle" class="w-11 h-11 grid place-items-center rounded-full transition" :class="shuffle ? 'text-sun' : 'text-mist hover:text-white'" :aria-pressed="shuffle" aria-label="Acak">
                        <svg class="stroke ico" viewBox="0 0 24 24">
                            <path d="M16 3h5v5M4 20 21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                        </svg>
                    </button>
                    <button type="button" v-on:click="step(-1)" :disabled="!current" class="w-12 h-12 grid place-items-center rounded-full hover:bg-white/10 disabled:opacity-40" aria-label="Sebelumnya">
                        <svg class="ico" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 6h2v12H6zM9.5 12 18 18V6z" />
                        </svg>
                    </button>
                    <button type="button" v-on:click="toggle" :disabled="!current" class="w-16 h-16 rounded-full bg-sun text-ink grid place-items-center active:scale-95 transition disabled:opacity-40" :aria-label="isPlaying ? 'Jeda' : 'Putar'">
                        <svg v-if="isPlaying" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 5h4v14H6zM14 5h4v14h-4z" />
                        </svg>
                        <svg v-else class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                    <button type="button" v-on:click="step(1)" :disabled="!current" class="w-12 h-12 grid place-items-center rounded-full hover:bg-white/10 disabled:opacity-40" aria-label="Selanjutnya">
                        <svg class="ico" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 6h2v12h-2zM6 18l8.5-6L6 6z" />
                        </svg>
                    </button>
                    <button type="button" v-on:click="repeat=!repeat" class="w-11 h-11 grid place-items-center rounded-full transition" :class="repeat ? 'text-sun' : 'text-mist hover:text-white'" :aria-pressed="repeat" aria-label="Ulangi lagu">
                        <svg class="stroke ico" viewBox="0 0 24 24">
                            <path d="m17 2 4 4-4 4M3 11V9a3 3 0 0 1 3-3h15M7 22l-4-4 4-4M21 13v2a3 3 0 0 1-3 3H3" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center gap-2 text-mist">
                    <template v-if="canVolume">
                        <button type="button" v-on:click="toggleMute" class="w-11 h-11 -ml-2 grid place-items-center rounded-full shrink-0 hover:text-white" :aria-label="volume === 0 ? 'Aktifkan suara' : 'Bisukan'">
                            <svg class="stroke ico" viewBox="0 0 24 24">
                                <path d="M11 5 6 9H2v6h4l5 4z" />
                                <path v-if="volume > 0" d="M16 9a4 4 0 0 1 0 6" />
                                <path v-else d="m17 9 5 6m0-6-5 6" />
                            </svg>
                        </button>
                        <input type="range" min="0" max="1" step="0.01" v-model.number="volume" :style="{'--p': (volume*100) + '%'}" aria-label="Volume" class="flex-1 min-w-0">
                    </template>
                    <p v-else class="flex-1 text-xs">Atur volume dengan tombol volume di sisi HP.</p>
                    <button type="button" v-on:click="showLyrics = !showLyrics" :disabled="!current" :aria-pressed="showLyrics" aria-label="Lirik"
                        class="relative w-11 h-11 -mr-1 grid place-items-center rounded-full shrink-0 transition active:scale-90 disabled:opacity-40"
                        :class="showLyrics ? 'text-sun' : 'text-mist hover:text-white'">
                        <svg class="stroke ico" viewBox="0 0 24 24">
                            <path d="m11 7.601-5.994 8.19a1 1 0 0 0 .1 1.298l.817.818a1 1 0 0 0 1.314.087L15.09 12" />
                            <path d="M16.5 21.174C15.5 20.5 14.372 20 13 20c-2.058 0-3.928 2.356-6 2-2.072-.356-2.775-3.369-1.5-4.5" />
                            <circle cx="16" cy="7" r="5" />
                        </svg>
                        <span v-if="showLyrics" class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-sun"></span>
                    </button>
                </div>

                <audio ref="audio" preload="none"
                    v-on:play="isPlaying=true" v-on:pause="onPause"
                    v-on:timeupdate="time=$event.target.currentTime"
                    v-on:loadedmetadata="dur=$event.target.duration"
                    v-on:ended="ended"></audio>
            </section>
        </div>

        <!-- Mini player (mobile): geser kiri/kanan untuk ganti lagu, ketuk untuk membuka -->
        <div v-if="current && !expanded" class="lg:hidden fixed left-3 right-3 bottom-[calc(4.5rem+env(safe-area-inset-bottom))] z-40">
            <div class="relative overflow-hidden rounded-2xl bg-panel/95 backdrop-blur-xl border border-line shadow-2xl"
                v-on:touchstart.passive="tStart" v-on:touchend="tEnd">
                <div class="absolute top-0 left-0 h-0.5 bg-sun" :style="{width: pct + '%'}"></div>
                <div class="flex items-center gap-2 p-2">
                    <button type="button" v-on:click="openSheet" class="flex items-center gap-3 flex-1 min-w-0 text-left" aria-label="Buka pemutar">
                        <img :src="cover(current,'150x150')" v-on:error.once="$event.target.src = '/icons/icon-192.png'" alt="" class="w-11 h-11 rounded-lg object-cover">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-bold" v-text="current.title"></p>
                            <p class="truncate text-xs text-mist" v-text="current.user.name"></p>
                        </div>
                    </button>
                    <button type="button" v-on:click="toggle" class="w-11 h-11 rounded-full bg-sun text-ink grid place-items-center active:scale-95 transition" :aria-label="isPlaying ? 'Jeda' : 'Putar'">
                        <svg v-if="isPlaying" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 5h4v14H6zM14 5h4v14h-4z" />
                        </svg>
                        <svg v-else class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Navigasi bawah (mobile) -->
        <nav class="lg:hidden fixed inset-x-0 bottom-0 z-40 bg-ink/90 backdrop-blur-xl border-t border-line pb-[env(safe-area-inset-bottom)]" aria-label="Navigasi utama">
            <div class="grid grid-cols-3 max-w-md mx-auto">
                <button v-for="n in navItems" :key="n.id" type="button" v-on:click="go(n.id)"
                    class="flex flex-col items-center justify-center gap-1 h-16 text-xs transition" :class="tab===n.id ? 'text-sun font-bold' : 'text-mist'" :aria-current="tab===n.id ? 'page' : null">
                    <svg class="stroke ico" :class="n.id==='fav' && tab==='fav' ? 'liked' : ''" viewBox="0 0 24 24">
                        <path :d="n.d" />
                        <circle v-if="n.id==='search'" cx="11" cy="11" r="0" />
                    </svg>
                    <span v-text="n.label"></span>
                </button>
            </div>
        </nav>
    </div>

    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script>
        const {
            createApp,
            ref,
            computed,
            watch,
            onMounted,
            nextTick
        } = Vue;

        createApp({
            setup() {
                const API = 'https://discoveryprovider.audius.co';
                const APP = 'TedzMusic';
                const FALLBACK = '/icons/icon-512.png';

                const store = (k, d) => {
                    try {
                        const v = JSON.parse(localStorage.getItem(k));
                        return v === null ? d : v;
                    } catch (e) {
                        return d;
                    }
                };
                const put = (k, v) => {
                    try {
                        localStorage.setItem(k, JSON.stringify(v));
                    } catch (e) {}
                };
                const buzz = () => {
                    if (navigator.vibrate) navigator.vibrate(10);
                };

                const songs = ref([]),
                    searchResults = ref([]),
                    current = ref(null),
                    isPlaying = ref(false);
                const loading = ref(true),
                    searching = ref(false),
                    error = ref(false),
                    query = ref('');
                const audio = ref(null),
                    sheet = ref(null),
                    searchEl = ref(null);
                const time = ref(0),
                    dur = ref(0),
                    volume = ref(store('tedz_vol', 0.8));
                const genre = ref(''),
                    canVolume = ref(true);
                let lastVol = 0.8,
                    searchTimer = null,
                    abortCtrl = null;
                const genres = [{
                        v: '',
                        l: 'Semua'
                    }, {
                        v: 'Electronic',
                        l: 'Electronic'
                    }, {
                        v: 'Hip-Hop/Rap',
                        l: 'Hip-Hop'
                    },
                    {
                        v: 'Pop',
                        l: 'Pop'
                    }, {
                        v: 'Rock',
                        l: 'Rock'
                    }, {
                        v: 'Lo-Fi',
                        l: 'Lo-Fi'
                    }, {
                        v: 'Ambient',
                        l: 'Ambient'
                    }, {
                        v: 'R&B/Soul',
                        l: 'R&B'
                    }
                ];
                const shuffle = ref(false),
                    repeat = ref(false),
                    expanded = ref(false);
                const tab = ref('home'),
                    favs = ref(store('tedz_favs', [])),
                    dragY = ref(0);

                const navItems = [{
                        id: 'home',
                        label: 'Beranda',
                        d: 'M3 11 12 3l9 8v10h-6v-6H9v6H3z'
                    },
                    {
                        id: 'search',
                        label: 'Cari',
                        d: 'M20 20l-3.5-3.5M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14z'
                    },
                    {
                        id: 'fav',
                        label: 'Disukai',
                        d: 'M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1 1.1L12 21.2l7.8-7.7 1-1.1a5.5 5.5 0 0 0 0-7.8z'
                    }
                ];
                const heading = computed(() => {
                    if (tab.value === 'fav') return 'Lagu disukai';
                    if (query.value.trim()) return 'Hasil pencarian';
                    return tab.value === 'search' ? 'Cari lagu' : 'Lagu trending';
                });
                const subHeading = computed(() => {
                    if (searching.value && tab.value !== 'fav') return 'Mencari di database Audius...';
                    if (query.value.trim() && tab.value !== 'fav') return `${filtered.value.length} hasil untuk “${query.value.trim()}”`;
                    return `${filtered.value.length} lagu`;
                });

                const cover = (s, size) => (s && s.artwork && (s.artwork[size] || s.artwork['480x480'])) || FALLBACK;
                const isCur = s => !!current.value && current.value.id === s.id;
                const fmt = t => {
                    if (!isFinite(t)) return '0:00';
                    t = Math.floor(t);
                    return Math.floor(t / 60) + ':' + String(t % 60).padStart(2, '0');
                };

                // Hapus lagu dari daftar jika cover error / 404 (dilewati saat offline)
                const drop = id => {
                    if (!navigator.onLine) return;
                    songs.value = songs.value.filter(s => s.id !== id);
                    searchResults.value = searchResults.value.filter(s => s.id !== id);
                };

                const hasArtwork = s => s && s.artwork && (s.artwork['150x150'] || s.artwork['480x480']);

                const load = async () => {
                    loading.value = true;
                    error.value = false;
                    try {
                        const g = genre.value ? `&genre=${encodeURIComponent(genre.value)}` : '';
                        const r = await fetch(`${API}/v1/tracks/trending?app_name=${APP}&limit=50${g}`);
                        if (!r.ok) throw new Error('HTTP ' + r.status);
                        const raw = (await r.json()).data || [];
                        // Hanya simpan lagu yang memiliki artwork
                        songs.value = raw.filter(hasArtwork);
                    } catch (e) {
                        console.error('Gagal mengambil lagu:', e);
                        error.value = true;
                    } finally {
                        loading.value = false;
                    }
                };

                // Pencarian global ke server Audius
                const runSearch = async q => {
                    if (abortCtrl) abortCtrl.abort();
                    abortCtrl = new AbortController();
                    searching.value = true;
                    error.value = false;
                    try {
                        const r = await fetch(`${API}/v1/tracks/search?query=${encodeURIComponent(q)}&app_name=${APP}&limit=50`, {
                            signal: abortCtrl.signal
                        });
                        if (!r.ok) throw new Error('HTTP ' + r.status);
                        searchResults.value = ((await r.json()).data || []).filter(hasArtwork);
                    } catch (e) {
                        if (e.name === 'AbortError') return;
                        console.error('Gagal mencari lagu:', e);
                        error.value = true;
                    } finally {
                        searching.value = false;
                    }
                };
                const retry = () => {
                    const q = query.value.trim();
                    if (q && tab.value !== 'fav') runSearch(q);
                    else load();
                };
                // Debounce 400ms saat mengetik
                watch(query, val => {
                    clearTimeout(searchTimer);
                    const q = val.trim();
                    if (!q) {
                        if (abortCtrl) abortCtrl.abort();
                        searching.value = false;
                        error.value = false;
                        searchResults.value = [];
                        return;
                    }
                    if (tab.value === 'fav') return;
                    searching.value = true;
                    searchTimer = setTimeout(() => runSearch(q), 400);
                });
                // Pindah dari tab Disukai saat masih ada kata kunci: jalankan pencarian global
                watch(tab, t => {
                    const q = query.value.trim();
                    if (t !== 'fav' && q && !searchResults.value.length && !searching.value) runSearch(q);
                });

                const filtered = computed(() => {
                    const q = query.value.trim().toLowerCase();
                    if (tab.value === 'fav') {
                        if (!q) return favs.value;
                        return favs.value.filter(s => s.title.toLowerCase().includes(q) || s.user.name.toLowerCase().includes(q));
                    }
                    return q ? searchResults.value : songs.value;
                });
                const pct = computed(() => (dur.value ? Math.min(100, (time.value / dur.value) * 100) : 0));

                // ===== Lirik (LRCLIB) =====
                const LRC = 'https://lrclib.net/api';
                const showLyrics = ref(store('tedz_lyrics', false));
                const lyrics = ref({
                    status: 'idle',
                    lines: [],
                    synced: false
                });
                const lyricsEl = ref(null);
                const lyricCache = new Map();
                let lyricCtrl = null;

                const lyricQueries = s => {
                    const clean = x => x.replace(/\(.*?\)|\[.*?\]/g, '').replace(/\s+(feat|ft)\.?\s.*$/i, '').replace(/\s+/g, ' ').trim();
                    const artist = clean(s.user.name),
                        title = clean(s.title);
                    const parts = s.title.split(/\s[-–—]\s/).map(clean).filter(Boolean);
                    const rest = parts.length > 1 ? parts.slice(1).join(' - ') : title;
                    const enc = encodeURIComponent,
                        tracks = new Set([title, rest]),
                        urls = new Set();
                    if (parts.length > 1) tracks.add(parts[0]);
                    // artis + judul (dari "Artis - Judul" maupun nama akun), lalu judul saja, lalu pencarian bebas
                    if (parts.length > 1) urls.add(`${LRC}/search?track_name=${enc(rest)}&artist_name=${enc(parts[0])}`);
                    urls.add(`${LRC}/search?track_name=${enc(rest)}&artist_name=${enc(artist)}`);
                    tracks.forEach(t => {
                        if (t) urls.add(`${LRC}/search?track_name=${enc(t)}`);
                    });
                    urls.add(`${LRC}/search?q=${enc(artist + ' ' + rest)}`);
                    return {
                        urls: [...urls],
                        tracks: [...tracks],
                        artists: [artist, ...(parts.length > 1 ? [parts[0]] : [])].filter(Boolean)
                    };
                };
                const norm = x => (x || '').toLowerCase().replace(/[^\p{L}\p{N}]+/gu, ' ').trim();
                const baseName = x => norm((x || '').replace(/\(.*?\)|\[.*?\]/g, '').replace(/\s+(feat|ft)\.?\s.*$/i, ''));
                const artistMatch = (a, b) => {
                    a = norm(a);
                    b = norm(b);
                    return !!a && !!b && (a === b || (Math.min(a.length, b.length) >= 3 && (a.includes(b) || b.includes(a))));
                };
                const findLyrics = async (s, signal) => {
                    const {
                        urls,
                        tracks,
                        artists
                    } = lyricQueries(s);
                    let fails = 0;
                    const lists = await Promise.all(urls.map(u => fetch(u, {
                            signal
                        })
                        .then(r => {
                            if (!r.ok) {
                                fails++;
                                return [];
                            }
                            return r.json();
                        })
                        .catch(e => {
                            if (e.name === 'AbortError') throw e;
                            fails++;
                            return [];
                        })));
                    if (fails === urls.length) throw new Error('Semua permintaan lirik gagal');
                    const seen = new Set(),
                        all = [];
                    lists.flat().forEach(x => {
                        if (x && !seen.has(x.id)) {
                            seen.add(x.id);
                            all.push(x);
                        }
                    });
                    const names = tracks.map(baseName).filter(Boolean);
                    // Ketat: judul harus sama persis. Artis cocok -> durasi maks 6 dtk; artis beda (mis. cover) -> durasi maks 3 dtk.
                    const cand = all
                        .filter(x => (x.syncedLyrics || x.plainLyrics || x.instrumental) && names.includes(baseName(x.trackName)))
                        .map(x => ({
                            x,
                            art: artists.some(a => artistMatch(a, x.artistName)),
                            gap: Math.abs((x.duration || 0) - (s.duration || 0))
                        }))
                        .filter(c => (s.duration && c.x.duration) ?
                            (c.art ? c.gap <= 6 : (c.gap <= 3 && baseName(c.x.trackName).length >= 5)) :
                            c.art);
                    cand.sort((p, q) => (q.art - p.art) || ((p.x.syncedLyrics ? 0 : 1) - (q.x.syncedLyrics ? 0 : 1)) || (p.gap - q.gap));
                    console.debug('[Lirik]', s.title, '|', s.user.name, '| durasi', s.duration, '| kandidat', all.length, '| lolos', cand.length, cand[0] ? cand[0].x : '');
                    return cand[0] ? cand[0].x : null;
                };
                // Lirik ditampilkan statis: pakai teks biasa, atau teks dari lirik bertanda waktu tanpa penandanya
                const parseLyrics = hit => {
                    if (!hit) return {
                        status: 'none',
                        lines: [],
                        synced: false
                    };
                    const raw = hit.plainLyrics || (hit.syncedLyrics || '').replace(/\[[^\]]*\]/g, '');
                    if (!raw.trim()) return {
                        status: hit.instrumental ? 'instrumental' : 'none',
                        lines: [],
                        synced: false
                    };
                    const lines = raw.split('\n').map(text => ({
                        text: text.trim()
                    }));
                    while (lines.length && !lines[0].text) lines.shift();
                    while (lines.length && !lines[lines.length - 1].text) lines.pop();
                    return {
                        status: 'ok',
                        lines,
                        synced: false
                    };
                };
                const loadLyrics = async () => {
                    const s = current.value;
                    if (!showLyrics.value || !s) return;
                    if (lyricCache.has(s.id)) {
                        lyrics.value = lyricCache.get(s.id);
                        return;
                    }
                    if (lyricCtrl) lyricCtrl.abort();
                    lyricCtrl = new AbortController();
                    lyrics.value = {
                        status: 'loading',
                        lines: [],
                        synced: false
                    };
                    let out;
                    try {
                        out = parseLyrics(await findLyrics(s, lyricCtrl.signal));
                        lyricCache.set(s.id, out);
                    } catch (e) {
                        if (e.name === 'AbortError') return;
                        console.error('Gagal memuat lirik:', e);
                        out = {
                            status: 'error',
                            lines: [],
                            synced: false
                        };
                    }
                    if (current.value && current.value.id === s.id) lyrics.value = out;
                };

                watch([showLyrics, () => current.value && current.value.id], () => loadLyrics());
                watch(showLyrics, v => put('tedz_lyrics', v));

                // Favorit
                const slim = s => ({
                    id: s.id,
                    title: s.title,
                    duration: s.duration,
                    artwork: s.artwork && {
                        '150x150': s.artwork['150x150'],
                        '480x480': s.artwork['480x480']
                    },
                    user: {
                        name: s.user.name
                    }
                });
                const isFav = s => favs.value.some(f => f.id === s.id);
                const toggleFav = s => {
                    buzz();
                    favs.value = isFav(s) ? favs.value.filter(f => f.id !== s.id) : [slim(s), ...favs.value];
                    put('tedz_favs', favs.value);
                };

                // Navigasi
                const go = t => {
                    tab.value = t;
                    if (t === 'home') query.value = '';
                    if (t === 'search') nextTick(() => searchEl.value && searchEl.value.focus());
                    window.scrollTo({
                        top: 0
                    });
                };

                // Pemutar
                const streamUrl = s => `${API}/v1/tracks/${s.id}/stream?app_name=${APP}`;
                const setMedia = s => {
                    if (!('mediaSession' in navigator)) return;
                    navigator.mediaSession.metadata = new MediaMetadata({
                        title: s.title,
                        artist: s.user.name,
                        artwork: [{
                            src: cover(s, '480x480'),
                            sizes: '480x480'
                        }]
                    });
                    navigator.mediaSession.setActionHandler('previoustrack', () => step(-1));
                    navigator.mediaSession.setActionHandler('nexttrack', () => step(1));
                };
                const play = s => {
                    buzz();
                    current.value = s;
                    time.value = 0;
                    dur.value = s.duration || 0;
                    audio.value.src = streamUrl(s);
                    audio.value.play().catch(err => console.error('Gagal memutar audio:', err));
                    setMedia(s);
                    saveLast();
                };
                const toggle = () => {
                    if (!current.value) return;
                    buzz();
                    const a = audio.value;
                    a.paused ? a.play() : a.pause();
                };
                const step = d => {
                    const list = filtered.value;
                    if (!current.value || !list.length) return;
                    if (shuffle.value && d > 0) {
                        play(list[Math.floor(Math.random() * list.length)]);
                        return;
                    }
                    const i = list.findIndex(s => s.id === current.value.id);
                    play(list[(i + d + list.length) % list.length]);
                };
                const ended = () => {
                    if (repeat.value) {
                        audio.value.currentTime = 0;
                        audio.value.play();
                    } else step(1);
                };
                const seek = e => {
                    audio.value.currentTime = +e.target.value;
                };
                const saveLast = () => {
                    if (current.value) put('tedz_last', {
                        song: slim(current.value),
                        time: time.value
                    });
                };
                const onPause = () => {
                    isPlaying.value = false;
                    saveLast();
                };

                // Gestur: geser kiri = lagu berikutnya, kanan = sebelumnya
                let t0 = null,
                    swiped = false;
                const tStart = e => {
                    const t = e.touches[0];
                    t0 = {
                        x: t.clientX,
                        y: t.clientY
                    };
                };
                const tEnd = e => {
                    if (!t0 || !current.value) return;
                    const t = e.changedTouches[0],
                        dx = t.clientX - t0.x,
                        dy = t.clientY - t0.y;
                    t0 = null;
                    if (Math.abs(dx) > 60 && Math.abs(dx) > Math.abs(dy) * 1.5) {
                        swiped = true;
                        setTimeout(() => {
                            swiped = false;
                        }, 350);
                        step(dx < 0 ? 1 : -1);
                    }
                };
                const openSheet = () => {
                    if (!swiped) expanded.value = true;
                };

                // Gestur: tarik sheet ke bawah untuk menutup
                let dStart = null;
                const dS = e => {
                    if (e.target.closest && e.target.closest('[data-lyrics]')) return;
                    if (expanded.value && sheet.value.scrollTop <= 0) dStart = e.touches[0].clientY;
                };
                const dM = e => {
                    if (dStart !== null) dragY.value = Math.max(0, e.touches[0].clientY - dStart);
                };
                const dE = () => {
                    if (dStart === null) return;
                    if (dragY.value > 120) expanded.value = false;
                    dragY.value = 0;
                    dStart = null;
                };
                const sheetStyle = computed(() => dragY.value > 0 ? {
                    transform: `translateY(${dragY.value}px)`,
                    transition: 'none'
                } : {});

                const toggleMute = () => {
                    if (volume.value > 0) {
                        lastVol = volume.value;
                        volume.value = 0;
                    } else volume.value = lastVol || 0.8;
                };
                const setGenre = g => {
                    genre.value = g;
                    load();
                };
                watch(volume, v => {
                    if (audio.value) audio.value.volume = v;
                    put('tedz_vol', v);
                });
                watch(current, s => {
                    document.getElementById('glow').style.setProperty('--g', s ? `url(${cover(s, '150x150')})` : 'none');
                    if (s) document.title = `${s.title} · Tedz Music`;
                });
                watch(expanded, v => {
                    document.body.style.overflow = v && window.innerWidth < 1024 ? 'hidden' : '';
                });

                onMounted(() => {
                    audio.value.volume = 0.5;
                    canVolume.value = audio.value.volume === 0.5;
                    audio.value.volume = volume.value;
                    const last = store('tedz_last', null);
                    if (last && last.song) { // lanjut dari lagu terakhir (tanpa auto-play)
                        current.value = last.song;
                        dur.value = last.song.duration || 0;
                        time.value = last.time || 0;
                        audio.value.src = streamUrl(last.song);
                        try {
                            audio.value.currentTime = time.value;
                        } catch (e) {}
                        setMedia(last.song);
                    }
                    window.addEventListener('pagehide', saveLast);
                    load();
                });

                return {
                    songs,
                    current,
                    isPlaying,
                    loading,
                    searching,
                    error,
                    query,
                    audio,
                    sheet,
                    searchEl,
                    showLyrics,
                    lyrics,
                    lyricsEl,
                    loadLyrics,
                    time,
                    dur,
                    volume,
                    shuffle,
                    repeat,
                    expanded,
                    tab,
                    navItems,
                    heading,
                    subHeading,
                    genre,
                    genres,
                    canVolume,
                    toggleMute,
                    setGenre,
                    filtered,
                    pct,
                    sheetStyle,
                    cover,
                    isCur,
                    fmt,
                    drop,
                    load,
                    retry,
                    isFav,
                    toggleFav,
                    go,
                    play,
                    toggle,
                    step,
                    ended,
                    seek,
                    onPause,
                    tStart,
                    tEnd,
                    openSheet,
                    dS,
                    dM,
                    dE
                };
            }
        }).mount('#app');
    </script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => navigator.serviceWorker.register('/sw.js').catch(() => {}));
        }
    </script>
</body>

</html>

@endverbatim