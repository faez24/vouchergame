<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GameVault | Marketplace Game</title>
        <meta name="description" content="Marketplace game top up dan voucher digital dengan tampilan premium dark.">

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
            .card-img-wrap { position: relative; width: 100%; padding-bottom: 100%; overflow: hidden; }
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
            @keyframes smoke-a { 0%{transform:translate(0,0) scale(1);opacity:.5} 33%{transform:translate(-40px,-25px) scale(1.1);opacity:.3} 66%{transform:translate(20px,-10px) scale(1.05);opacity:.4} 100%{transform:translate(0,0) scale(1);opacity:.5} }
            @keyframes smoke-b { 0%{transform:translate(0,0) scale(1);opacity:.4} 40%{transform:translate(30px,30px) scale(1.15);opacity:.2} 70%{transform:translate(-15px,10px) scale(0.95);opacity:.35} 100%{transform:translate(0,0) scale(1);opacity:.4} }
            @keyframes smoke-c { 0%{transform:translate(0,0) scale(1) rotate(0deg);opacity:.35} 50%{transform:translate(-25px,-40px) scale(1.08) rotate(3deg);opacity:.18} 100%{transform:translate(0,0) scale(1) rotate(0deg);opacity:.35} }
            @keyframes smoke-d { 0%{transform:translate(0,0) scale(1);opacity:.3} 45%{transform:translate(35px,-20px) scale(1.2);opacity:.15} 100%{transform:translate(0,0) scale(1);opacity:.3} }
            @keyframes smoke-e { 0%,100%{opacity:.25;transform:scale(1)} 50%{opacity:.1;transform:scale(1.1)} }
            .smoke-a { animation: smoke-a 14s ease-in-out infinite; }
            .smoke-b { animation: smoke-b 18s ease-in-out infinite; }
            .smoke-c { animation: smoke-c 22s ease-in-out infinite; }
            .smoke-d { animation: smoke-d 16s ease-in-out infinite reverse; }
            .smoke-e { animation: smoke-e 10s ease-in-out infinite; }
            
            /* Efek Smoke Berjalan */
            @keyframes slide-smoke {
                0% { background-position: 0 0; }
                100% { background-position: -200vw 0; }
            }
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

            /* === Expand/Collapse Grid === */
            .games-extra-grid {
                display: grid;
                grid-template-rows: 0fr;
                opacity: 0;
                transition: grid-template-rows 0.45s cubic-bezier(.4,0,.2,1),
                            opacity 0.35s ease,
                            margin-top 0.35s ease;
                margin-top: 0;
            }
            .games-extra-grid.expanded {
                grid-template-rows: 1fr;
                opacity: 1;
                margin-top: 0.5rem;
            }
            .games-extra-grid > div {
                overflow: hidden;
            }
            /* Arrow rotate animation */
            .btn-lihat-semua .arrow-icon {
                transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            }
            .btn-lihat-semua.expanded .arrow-icon {
                transform: rotate(90deg);
            }
            /* Card pop-in animation */
            @keyframes card-pop {
                from { opacity: 0; transform: translateY(14px) scale(0.97); }
                to   { opacity: 1; transform: translateY(0)   scale(1);    }
            }
            .games-extra-grid.expanded article {
                animation: card-pop 0.35s ease forwards;
            }
            .games-extra-grid.expanded article:nth-child(1) { animation-delay: 0.05s; }
            .games-extra-grid.expanded article:nth-child(2) { animation-delay: 0.10s; }
            .games-extra-grid.expanded article:nth-child(3) { animation-delay: 0.15s; }
            .games-extra-grid.expanded article:nth-child(4) { animation-delay: 0.20s; }
            .games-extra-grid.expanded article:nth-child(5) { animation-delay: 0.25s; }
            .games-extra-grid.expanded article:nth-child(6) { animation-delay: 0.30s; }
        </style>

    </head>
    <body class="min-h-screen bg-[#344050] text-white font-sans selection:bg-cyan-500 selection:text-white overflow-x-hidden">

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
                {{-- Large smoke masses --}}
                <div class="smoke-a absolute top-[-5%] left-[-20%] w-[80vw] h-[70vw] max-w-[1000px] max-h-[800px] rounded-full bg-slate-500/15 blur-[120px]"></div>
                <div class="smoke-b absolute top-[25%] right-[-25%] w-[90vw] h-[80vw] max-w-[1100px] max-h-[900px] rounded-full bg-slate-400/12 blur-[140px]"></div>
                <div class="smoke-c absolute bottom-[5%] left-[5%] w-[70vw] h-[60vw] max-w-[900px] max-h-[700px] rounded-full bg-slate-600/12 blur-[110px]"></div>
                <div class="smoke-d absolute top-[55%] left-[25%] w-[55vw] h-[45vw] max-w-[750px] max-h-[600px] rounded-full bg-slate-500/10 blur-[100px]"></div>
                {{-- Mid smoke --}}
                <div class="smoke-b absolute top-[10%] left-[40%] w-[40vw] h-[35vw] max-w-[550px] max-h-[450px] rounded-full bg-slate-300/8 blur-[80px]"></div>
                <div class="smoke-a absolute bottom-[30%] right-[10%] w-[45vw] h-[38vw] max-w-[600px] max-h-[500px] rounded-full bg-slate-400/8 blur-[90px]"></div>
                {{-- Faint accent glows --}}
                <div class="smoke-e absolute top-[20%] left-[8%] w-[25vw] h-[25vw] max-w-[350px] max-h-[350px] rounded-full bg-cyan-400/5 blur-[70px]"></div>
                <div class="smoke-c absolute bottom-[15%] right-[8%] w-[30vw] h-[30vw] max-w-[400px] max-h-[400px] rounded-full bg-pink-400/4 blur-[80px]"></div>
                <div class="smoke-d absolute top-[45%] right-[30%] w-[20vw] h-[20vw] max-w-[280px] max-h-[280px] rounded-full bg-blue-400/5 blur-[60px]"></div>
            </div>


            <div class="relative z-10">
                @include('partials.hero')
                
                <main id="home" class="mx-auto w-full max-w-[1440px] px-3 pb-12 sm:px-4 lg:px-6">
                @include('partials.game-shortcuts')



                <section class="mt-8">
                    <div class="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col justify-center items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-pink-500 rotate-45 animate-pulse shadow-[0_0_8px_rgba(236,72,153,0.8)]"></div>
                                <div class="w-0.5 h-6 bg-gradient-to-b from-pink-500 to-transparent"></div>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-pink-500 uppercase tracking-[0.2em] mb-0.5">Top Picks</p>
                                <h2 class="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Game Populer</h2>
                            </div>
                        </div>

                    </div>

                    {{-- Baris pertama: selalu tampil --}}
                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4" id="games-populer-first">
                        <a href="{{ route('topup.ml') }}" class="block">
                            <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                                <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1556438064-2d7646166914?w=600&h=800&fit=crop" alt="Mobile Legends"/></div>
                                <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Mobile Legends</h3></div>
                            </article>
                        </a>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop" alt="Free Fire"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Free Fire</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop" alt="PUBG Mobile"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">PUBG Mobile</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=600&h=800&fit=crop" alt="Genshin Impact"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Genshin Impact</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1615680022647-99c397cbcaea?w=600&h=800&fit=crop" alt="Valorant"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Valorant</h3></div>
                        </article>
                        <article class="relative lg:hidden rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=600&h=800&fit=crop" alt="Honkai Star Rail"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Honkai Star Rail</h3></div>
                        </article>
                    </div>

                    {{-- Baris extra: tersembunyi, expand saat klik Lihat Semua --}}
                    <div class="games-extra-grid" id="games-populer-extra">
                        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                            <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                                <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop" alt="Call of Duty Mobile"/></div>
                                <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Call of Duty Mobile</h3></div>
                            </article>
                            <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                                <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1536240478700-b869ad10f984?w=600&h=800&fit=crop" alt="Apex Legends"/></div>
                                <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Apex Legends</h3></div>
                            </article>
                            <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                                <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop" alt="League of Legends"/></div>
                                <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">League of Legends</h3></div>
                            </article>
                            <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                                <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop" alt="Clash of Clans"/></div>
                                <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Clash of Clans</h3></div>
                            </article>
                            <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                                <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop" alt="Fortnite"/></div>
                                <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Fortnite</h3></div>
                            </article>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <button
                            id="btn-lihat-semua-populer"
                            onclick="toggleGamesSection('games-populer-extra', 'btn-lihat-semua-populer', 'label-lihat-populer')"
                            class="btn-lihat-semua group flex items-center gap-2 text-sm font-bold text-pink-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(236,72,153,0.8)] cursor-pointer bg-transparent border-none outline-none"
                        >
                            <span id="label-lihat-populer">Lihat Semua</span>
                            <svg class="arrow-icon w-4 h-4 text-pink-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>


                </section>

                <section class="mt-8">
                    <div class="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col justify-center items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-cyan-400 rotate-45 animate-pulse shadow-[0_0_8px_rgba(34,211,238,0.8)]"></div>
                                <div class="w-0.5 h-6 bg-gradient-to-b from-cyan-400 to-transparent"></div>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-cyan-400 uppercase tracking-[0.2em] mb-0.5">Kategori Lain</p>
                                <h2 class="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Web Store</h2>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop" alt="Steam Wallet"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Promo</div><h3 class="mt-2 text-sm font-extrabold">Steam Wallet</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1542751110-97427bbecf20?w=600&h=800&fit=crop" alt="PlayStation Network"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">PlayStation Network</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop" alt="Xbox Game Pass"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Xbox Game Pass</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop" alt="Razer Gold"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Razer Gold</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1589241062272-c0a000072dfa?w=600&h=800&fit=crop" alt="Google Play"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Google Play</h3></div>
                        </article>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <a href="#footer" class="group flex items-center gap-2 text-sm font-bold text-cyan-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(34,211,238,0.8)]">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 text-cyan-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>


                </section>

                <section class="mt-8">
                    <div class="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col justify-center items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-pink-500 rotate-45 animate-pulse shadow-[0_0_8px_rgba(236,72,153,0.8)]"></div>
                                <div class="w-0.5 h-6 bg-gradient-to-b from-pink-500 to-transparent"></div>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-pink-500 uppercase tracking-[0.2em] mb-0.5">Fresh Drops</p>
                                <h2 class="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Baru Ditambahkan</h2>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop" alt="Wuthering Waves"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Wuthering Waves</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop" alt="Solo Leveling Arise"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Solo Leveling Arise</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop" alt="Zenless Zone Zero"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Zenless Zone Zero</h3></div>
                        </article>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <a href="#footer" class="group flex items-center gap-2 text-sm font-bold text-pink-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(236,72,153,0.8)]">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 text-pink-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>


                </section>

                <section class="mt-8">
                    <div class="mb-5 flex items-end justify-between border-b border-white/5 pb-3" id="voucher">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col justify-center items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-cyan-400 rotate-45 animate-pulse shadow-[0_0_8px_rgba(34,211,238,0.8)]"></div>
                                <div class="w-0.5 h-6 bg-gradient-to-b from-cyan-400 to-transparent"></div>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-cyan-400 uppercase tracking-[0.2em] mb-0.5">Best Deals</p>
                                <h2 class="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Voucher Populer</h2>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1589241062272-c0a000072dfa?w=600&h=800&fit=crop" alt="Steam Wallet"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Promo</div><h3 class="mt-2 text-sm font-extrabold">Steam Wallet</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1542751110-97427bbecf20?w=600&h=800&fit=crop" alt="Google Play"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Google Play</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop" alt="PlayStation Network"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">PlayStation Network</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop" alt="Xbox Game Pass"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Xbox Game Pass</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 shadow-[0_10px_20px_rgba(0,0,0,0.6)] hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop" alt="Garena Shells"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Garena Shells</h3></div>
                        </article>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <a href="#footer" class="group flex items-center gap-2 text-sm font-bold text-cyan-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(34,211,238,0.8)]">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 text-cyan-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>


                </section>
            </main>

            @include('partials.flashsale-checkout')
            @include('partials.footer')
            </div>
        </div>

        <script>
            function toggleGamesSection(extraId, btnId, labelId) {
                const extra  = document.getElementById(extraId);
                const btn    = document.getElementById(btnId);
                const label  = document.getElementById(labelId);
                const isOpen = extra.classList.contains('expanded');

                if (isOpen) {
                    extra.classList.remove('expanded');
                    btn.classList.remove('expanded');
                    label.textContent = 'Lihat Semua';
                } else {
                    extra.classList.add('expanded');
                    btn.classList.add('expanded');
                    label.textContent = 'Tutup';

                    // Smooth scroll ke baris extra agar kelihatan
                    setTimeout(() => {
                        extra.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }, 100);
                }
            }
        </script>
    </body>
</html>
