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
            /* keep only if necessary for tiny noise texture (fallback) */
            .bg-noise { background-image: radial-gradient(rgba(255,255,255,0.04) 0.8px, transparent 0.8px); background-size: 18px 18px; }
            /* Cross-browser safe image card fix */
            .card-img-wrap { position: relative; width: 100%; padding-bottom: 133.33%; /* 3:4 ratio */ overflow: hidden; }
            .card-img-wrap img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        </style>
    </head>
    <body class="min-h-screen bg-[#2A3845] text-white font-sans selection:bg-cyan-500 selection:text-white">

        @include('partials.navbar')

        <div class="relative min-h-screen bg-[#2A3845] overflow-hidden">
            
            {{-- Ambient Glowing Background Orbs --}}
            <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
                <div class="absolute top-[20%] left-[-10%] w-[50vw] h-[50vw] max-w-[600px] max-h-[600px] rounded-full bg-cyan-500/5 blur-[120px]"></div>
                <div class="absolute top-[50%] right-[-10%] w-[60vw] h-[60vw] max-w-[700px] max-h-[700px] rounded-full bg-pink-500/5 blur-[150px]"></div>
                <div class="absolute bottom-[-10%] left-[20%] w-[40vw] h-[40vw] max-w-[500px] max-h-[500px] rounded-full bg-blue-500/5 blur-[120px]"></div>
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
                        <article class="relative rounded-lg overflow-hidden bg-[#0a101d]/60 backdrop-blur-md border border-white/5 hover:border-cyan-500/50 hover:shadow-[0_0_20px_rgba(34,211,238,0.15)] group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1556438064-2d7646166914?w=600&h=800&fit=crop" alt="Mobile Legends"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Mobile Legends</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#0a101d]/60 backdrop-blur-md border border-white/5 hover:border-cyan-500/50 hover:shadow-[0_0_20px_rgba(34,211,238,0.15)] group transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop" alt="Free Fire"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Populer</div><h3 class="mt-2 text-sm font-extrabold">Free Fire</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40 transition-all duration-300">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop" alt="PUBG Mobile"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">PUBG Mobile</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#0a101d]/60 backdrop-blur-md border border-white/5 hover:border-cyan-500/50 hover:shadow-[0_0_20px_rgba(34,211,238,0.15)] group transition-all duration-300">
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
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop" alt="Steam Wallet"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Promo</div><h3 class="mt-2 text-sm font-extrabold">Steam Wallet</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1542751110-97427bbecf20?w=600&h=800&fit=crop" alt="PlayStation Network"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">PlayStation Network</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop" alt="Xbox Game Pass"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Xbox Game Pass</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop" alt="Razer Gold"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Razer Gold</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
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
                        <article class="relative rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop" alt="Wuthering Waves"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Wuthering Waves</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap bg-[#1a1f2e]"><img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop" alt="Solo Leveling Arise"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-cyan-500 text-black text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.6)]">Baru</div><h3 class="mt-2 text-sm font-extrabold">Solo Leveling Arise</h3></div>
                        </article>
                        <article class="relative rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
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
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1589241062272-c0a000072dfa?w=600&h=800&fit=crop" alt="Steam Wallet"/></div>
                            <div class="p-3 bg-transparent"><div class="inline-block px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.6)]">Promo</div><h3 class="mt-2 text-sm font-extrabold">Steam Wallet</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1542751110-97427bbecf20?w=600&h=800&fit=crop" alt="Google Play"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Google Play</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop" alt="PlayStation Network"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">PlayStation Network</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
                            <div class="card-img-wrap"><img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop" alt="Xbox Game Pass"/></div>
                            <div class="p-3 bg-transparent"><h3 class="mt-2 text-sm font-extrabold">Xbox Game Pass</h3></div>
                        </article>
                        <article class="rounded-lg overflow-hidden bg-[#242938] border border-gray-700/40">
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
