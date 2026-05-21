{{-- =====================================================
     HERO BANNER SECTION
     - Mobile: 16:9 aspect ratio, clean below-banner flash sale
     - Desktop: fixed height, flash sale overlaps banner bottom
     ===================================================== --}}

{{-- ====== BANNER + FLASH SALE WRAPPER ====== --}}
{{-- On desktop: section has bottom padding to accommodate the overlapping flash sale --}}
<div class="mb-6 w-full">

    {{-- ====== BANNER ====== --}}
    <section class="relative w-full bg-transparent overflow-hidden aspect-[4/3] sm:aspect-[16/9] lg:aspect-[21/9] min-h-[250px] md:min-h-[400px] lg:min-h-[500px]">

        {{-- bg image with mask to fade to 0% opacity at the bottom --}}
        <div class="absolute inset-0" style="-webkit-mask-image: linear-gradient(to bottom, black 40%, transparent 100%); mask-image: linear-gradient(to bottom, black 40%, transparent 100%);">
            <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=2070&auto=format&fit=crop"
                 alt="Hero Background"
                 class="w-full h-full object-cover object-center opacity-60" />
            
            {{-- Darkening overlay to ensure text readability --}}
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>
        </div>

        {{-- arrows – desktop only --}}
        <button class="hidden md:flex absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-white items-center justify-center hover:bg-white/10 hover:border-cyan-500/50 transition-all z-20 group">
            <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="hidden md:flex absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-white items-center justify-center hover:bg-white/10 hover:border-cyan-500/50 transition-all z-20 group">
            <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- content --}}
        <div class="relative z-10 w-full max-w-[1440px] mx-auto h-full flex flex-col justify-center px-5 sm:px-10 md:px-16 lg:px-24 pt-20 pb-6">
            <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-white tracking-tighter leading-none drop-shadow-[0_0_15px_rgba(255,255,255,0.4)]">GAME</h1>
            <h2 class="text-xl sm:text-3xl md:text-5xl font-bold tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-pink-500 mt-0.5">VAULT</h2>
            <p class="text-xs sm:text-base md:text-xl text-gray-300 font-light tracking-wide mt-1">Marketplace Top Up & Voucher Digital Termurah</p>

            <div class="mt-4 sm:mt-6 flex flex-row gap-2 sm:gap-4 w-fit">
                <a href="#games"
                   class="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-cyan-400 text-black font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(34,211,238,0.6)] hover:bg-cyan-300 transition-colors text-center whitespace-nowrap">
                    LIHAT GAMES
                </a>
                <a href="#voucher"
                   class="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-pink-500 text-white font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(236,72,153,0.6)] hover:bg-pink-400 transition-colors text-center whitespace-nowrap">
                    LIHAT VOUCHER
                </a>
            </div>
        </div>
    </section>

    {{-- ====== FLASH SALE ======
         Mobile: normal below the banner (mt-6)
         Desktop (md+): absolutely/negatively positioned to overlap banner bottom
    --}}
    <div class="mt-6 md:-mt-20 relative z-20 w-full max-w-[1440px] mx-auto px-3 sm:px-4 lg:px-6">

        {{-- header --}}
        <div class="flex items-center justify-between mb-4 px-1">
            <h3 class="text-base font-black text-cyan-400 uppercase tracking-widest flex items-center gap-2 drop-shadow-[0_0_8px_rgba(34,211,238,0.5)]">
                <span class="w-2.5 h-2.5 rounded-full bg-pink-500 animate-pulse shadow-[0_0_8px_rgba(236,72,153,0.8)]"></span>
                FLASH SALE
            </h3>
        </div>

        {{-- cards --}}
        <div class="flex gap-10 md:gap-12 overflow-x-auto lg:justify-center px-6 pt-4 pb-12 scrollbar-hide snap-x snap-mandatory"
             style="-ms-overflow-style:none;scrollbar-width:none;">

            {{-- Card 1: Valorant VP --}}
            <div class="flex-shrink-0 snap-center w-[155px] sm:w-[175px] md:w-[195px] cursor-pointer">
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-pink-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(236,72,153,0.8)]">20% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Valorant</h4>
                        <p class="font-black text-white text-xs mt-0.5">1120 VP</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 150.000</span>
                            <span class="text-cyan-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,211,238,0.5)]">Rp 120.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Mobile Legends --}}
            <div class="flex-shrink-0 snap-center w-[155px] sm:w-[175px] md:w-[195px] cursor-pointer" onclick="openFlashSaleModal()">
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(236,72,153,0.25)] hover:border-pink-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556438064-2d7646166914?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-pink-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(236,72,153,0.8)]">15% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Mobile Legends</h4>
                        <p class="font-black text-white text-xs mt-0.5">86 Diamonds</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 25.000</span>
                            <span class="text-cyan-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,211,238,0.5)]">Rp 21.250</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 3: Free Fire --}}
            <div class="flex-shrink-0 snap-center w-[155px] sm:w-[175px] md:w-[195px] cursor-pointer" >
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-cyan-500 text-black text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(34,211,238,0.8)]">10% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Free Fire</h4>
                        <p class="font-black text-white text-xs mt-0.5">355 Diamonds</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 50.000</span>
                            <span class="text-pink-400 font-black text-xs drop-shadow-[0_0_5px_rgba(236,72,153,0.5)]">Rp 45.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 4: Genshin Impact --}}
            <div class="flex-shrink-0 snap-center w-[155px] sm:w-[175px] md:w-[195px] cursor-pointer" >
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(236,72,153,0.25)] hover:border-pink-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-pink-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(236,72,153,0.8)]">25% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Genshin Impact</h4>
                        <p class="font-black text-white text-xs mt-0.5">Welkin Moon</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 80.000</span>
                            <span class="text-cyan-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,211,238,0.5)]">Rp 60.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 5: PUBG Mobile --}}
            <div class="flex-shrink-0 snap-center w-[155px] sm:w-[175px] md:w-[195px] cursor-pointer" >
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-cyan-500 text-black text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(34,211,238,0.8)]">30% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">PUBG Mobile</h4>
                        <p class="font-black text-white text-xs mt-0.5">325 UC</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 75.000</span>
                            <span class="text-pink-400 font-black text-xs drop-shadow-[0_0_5px_rgba(236,72,153,0.5)]">Rp 52.500</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Pagination Dots --}}
        <div class="flex justify-center gap-2 mt-1">
            <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-white/20 cursor-pointer hover:bg-white/40 transition-colors"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-white/20 cursor-pointer hover:bg-white/40 transition-colors"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-white/20 cursor-pointer hover:bg-white/40 transition-colors"></span>
        </div>
    </div>

</div>

