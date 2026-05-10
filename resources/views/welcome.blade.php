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
        </style>

    </head>
    <body class="min-h-screen bg-[#344050] text-white font-sans selection:bg-cyan-500 selection:text-white">

        @include('partials.navbar')

        <div class="relative min-h-screen bg-[#344050] bg-noise overflow-hidden">
            
            {{-- Smoky War-Zone Background Atmosphere --}}
            <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
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
                    <div class="flex items-end justify-between gap-4 mb-4">
                        <div>
                            <p class="inline-flex w-fit rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 px-3 py-1 text-xs font-bold uppercase tracking-wide shadow-[0_0_10px_rgba(34,211,238,0.1)]">Game Populer</p>
                            <h2 class="mt-2 text-2xl font-extrabold">🔥 Game Populer</h2>
                        </div>
                        <a href="#footer" class="text-sm text-pink-400 hover:text-pink-300 font-medium transition-all hover:drop-shadow-[0_0_8px_rgba(236,72,153,0.8)]">Lihat Semua</a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1556438064-2d7646166914?w=600&h=800&fit=crop" alt="Mobile Legends"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Mobile Legends</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop" alt="Free Fire"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Free Fire</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop" alt="PUBG Mobile"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">PUBG Mobile</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-cyan-500/50 group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=600&h=800&fit=crop" alt="Genshin Impact"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Genshin Impact</h3></div>
                        </article>
                    </div>
                </section>

                <section class="mt-8">
                    <div class="flex items-end justify-between gap-4 mb-4">
                        <div>
                            <p class="inline-flex w-fit rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 px-3 py-1 text-xs font-bold uppercase tracking-wide shadow-[0_0_10px_rgba(34,211,238,0.1)]">Kategori Lain</p>
                            <h2 class="mt-2 text-xl font-extrabold">Web Store</h2>
                        </div>
                        <a href="#footer" class="text-sm text-pink-400 hover:text-pink-300 font-medium transition-all hover:drop-shadow-[0_0_8px_rgba(236,72,153,0.8)]">Lihat Semua</a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
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
                </section>

                <section class="mt-8">
                    <div class="flex items-end justify-between gap-4 mb-4">
                        <div>
                            <p class="inline-flex w-fit rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 px-3 py-1 text-xs font-bold uppercase tracking-wide shadow-[0_0_10px_rgba(34,211,238,0.1)]">Baru Ditambahkan</p>
                            <h2 class="mt-2 text-2xl font-extrabold">✨ Baru Ditambahkan</h2>
                        </div>
                        <a href="#footer" class="text-sm text-pink-400 hover:text-pink-300 font-medium transition-all hover:drop-shadow-[0_0_8px_rgba(236,72,153,0.8)]">Lihat Semua</a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
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
                </section>

                <section class="mt-8">
                    <div class="flex items-end justify-between gap-4 mb-4" id="voucher">
                        <div>
                            <p class="inline-flex w-fit rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 px-3 py-1 text-xs font-bold uppercase tracking-wide shadow-[0_0_10px_rgba(34,211,238,0.1)]">Voucher Populer</p>
                            <h2 class="mt-2 text-xl font-extrabold">Voucher Populer</h2>
                        </div>
                        <a href="#footer" class="text-sm text-pink-400 hover:text-pink-300 font-medium transition-all hover:drop-shadow-[0_0_8px_rgba(236,72,153,0.8)]">Lihat Semua</a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
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
                </section>
            </main>

            @include('partials.footer')
            </div>
        </div>
    </body>
</html>
