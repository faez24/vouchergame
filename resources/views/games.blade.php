<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GameVault | All Games</title>
        <meta name="description" content="Semua game dari GameVault">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Poppins', 'sans-serif'],
                        }
                    }
                }
            }
        </script>

        <style>
            .bg-noise { background-image: radial-gradient(rgba(255,255,255,0.025) 0.8px, transparent 0.8px); background-size: 18px 18px; }
            .card-img-wrap { position: relative; width: 100%; padding-bottom: 133.33%; overflow: hidden; }
            .card-img-wrap img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
            /* 3D card effect */
            .card-3d {
                box-shadow:
                    0 2px 0 rgba(255,255,255,0.07) inset,
                    0 -1px 0 rgba(0,0,0,0.5) inset,
                    6px 18px 30px rgba(0,0,0,0.7),
                    12px 30px 50px rgba(0,0,0,0.4);
                transform: perspective(800px) rotateX(1deg);
            }
            /* Warzone smoke animations */
            @keyframes slide-smoke { 0% { background-position: 0 0; } 100% { background-position: -200vw 0; } }
            .moving-smoke-1 {
                position: absolute;
                top: 0;
                left: 0;
                width: 300%;
                height: 100%;
                background-image: url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog1.png');
                background-repeat: repeat-x;
                background-size: cover;
                opacity: 0.9;
                filter: brightness(1.2) contrast(1.2);
                animation: slide-smoke 60s linear infinite;
                mix-blend-mode: screen;
            }
            .moving-smoke-2 {
                position: absolute;
                top: 0;
                left: 0;
                width: 300%;
                height: 100%;
                background-image: url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog2.png');
                background-repeat: repeat-x;
                background-size: cover;
                opacity: 0.8;
                filter: brightness(1.2) contrast(1.2);
                animation: slide-smoke 40s linear infinite;
                mix-blend-mode: screen;
            }
        </style>
    </head>
    <body class="min-h-screen bg-[#344050] text-white font-sans selection:bg-cyan-500 selection:text-white overflow-x-hidden pt-20">

        <div class="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
            
            @include('partials.navbar')

            {{-- Smoky War-Zone Background Atmosphere --}}
            <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
                {{-- Efek Smoke Berjalan Overlay --}}
                <div class="moving-smoke-1"></div>
                <div class="moving-smoke-2"></div>
                
                {{-- Vignette --}}
                <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/50"></div>
            </div>

            <div class="relative z-10 flex-1">
                <main class="mx-auto w-full max-w-[1440px] px-3 pb-12 sm:px-4 lg:px-6 pt-10">
                    <div class="mb-8">
                        <h1 class="text-3xl sm:text-4xl font-black uppercase italic tracking-wider text-white drop-shadow-md text-center mb-6">Semua Games</h1>
                        
                        {{-- Search Input --}}
                        <div class="max-w-md mx-auto relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-cyan-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="searchInput" class="bg-[#161920]/80 border border-white/10 text-white text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full pl-12 p-3.5 backdrop-blur-md transition-all placeholder-gray-400 shadow-[0_4px_20px_rgba(0,0,0,0.3)]" placeholder="Cari game favoritmu...">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-4" id="gamesContainer">
                        {{-- Game Cards --}}
                        <a href="{{ route('topup.ml') }}" class="block game-card" data-name="mobile legends">
                            <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 h-full">
                                <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1556438064-2d7646166914?w=600&h=800&fit=crop" alt="Mobile Legends"/></div>
                                <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Mobile Legends</h3></div>
                            </article>
                        </a>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="free fire">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop" alt="Free Fire"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Free Fire</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="pubg mobile">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop" alt="PUBG Mobile"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">PUBG Mobile</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="genshin impact">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=600&h=800&fit=crop" alt="Genshin Impact"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Genshin Impact</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="valorant">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1615680022647-99c397cbcaea?w=600&h=800&fit=crop" alt="Valorant"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Valorant</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="honkai star rail">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=600&h=800&fit=crop" alt="Honkai Star Rail"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Honkai Star Rail</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="call of duty mobile">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop" alt="Call of Duty Mobile"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Call of Duty Mobile</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="apex legends">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1536240478700-b869ad10f984?w=600&h=800&fit=crop" alt="Apex Legends"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Apex Legends</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="league of legends">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop" alt="League of Legends"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">League of Legends</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="clash of clans">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop" alt="Clash of Clans"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Clash of Clans</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="fortnite">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop" alt="Fortnite"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Fortnite</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="wuthering waves">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop" alt="Wuthering Waves"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Wuthering Waves</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="solo leveling arise">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop" alt="Solo Leveling Arise"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Solo Leveling Arise</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300 game-card block cursor-pointer h-full" data-name="zenless zone zero">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop" alt="Zenless Zone Zero"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold name-txt line-clamp-1">Zenless Zone Zero</h3></div>
                        </article>
                    </div>

                    {{-- Empty State --}}
                    <div id="emptyState" class="hidden text-center py-20">
                        <svg class="mx-auto h-16 w-16 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-bold text-white mb-2">Game tidak ditemukan</h3>
                        <p class="text-gray-400 text-sm">Coba cari dengan kata kunci lain.</p>
                    </div>

                </main>
            </div>

            @include('partials.footer')
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const gameCards = document.querySelectorAll('.game-card');
                const emptyState = document.getElementById('emptyState');

                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase().trim();
                    let visibleCount = 0;

                    gameCards.forEach(card => {
                        const name = card.getAttribute('data-name');
                        if (name.includes(searchTerm)) {
                            card.style.display = 'block';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    if (visibleCount === 0) {
                        emptyState.classList.remove('hidden');
                    } else {
                        emptyState.classList.add('hidden');
                    }
                });
            });
        </script>
    </body>
</html>