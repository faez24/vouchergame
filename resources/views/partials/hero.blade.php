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
        <button class="hidden md:flex absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-white items-center justify-center hover:bg-white/10 hover:border-green-500/50 transition-all z-20 group">
            <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="hidden md:flex absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-white items-center justify-center hover:bg-white/10 hover:border-green-500/50 transition-all z-20 group">
            <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- content --}}
        <div class="relative z-10 w-full max-w-[1440px] mx-auto h-full flex flex-col justify-center px-5 sm:px-10 md:px-16 lg:px-24 pt-20 pb-6">
            <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-white tracking-tighter leading-none drop-shadow-[0_0_15px_rgba(255,255,255,0.4)]">WAR</h1>
            <h2 class="text-xl sm:text-3xl md:text-5xl font-bold tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-orange-500 mt-0.5">GAME</h2>
            <p class="text-xs sm:text-base md:text-xl text-gray-300 font-light tracking-wide mt-1">Marketplace Top Up & Voucher Digital Termurah</p>

            <div class="hidden mt-4 sm:mt-6 flex-row gap-2 sm:gap-4 w-fit">
                <a href="#games"
                   class="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-green-400 text-white font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(34,197,94,0.6)] hover:bg-green-300 transition-colors text-center whitespace-nowrap">
                    LIHAT GAMES
                </a>
                <a href="#voucher"
                   class="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-orange-500 text-white font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(249,115,22,0.6)] hover:bg-orange-400 transition-colors text-center whitespace-nowrap">
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
            <h3 class="text-base font-black text-green-400 uppercase tracking-widest flex items-center gap-2 drop-shadow-[0_0_8px_rgba(34,197,94,0.5)]">
                <span class="w-2.5 h-2.5 rounded-full bg-orange-500 animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
                FLASH SALE
            </h3>
        </div>

        <div class="relative w-full group/slider overflow-visible">

            {{-- Prev Arrow --}}
            <button onclick="document.getElementById('flash-sale-slider').scrollBy({ left: -250, behavior: 'smooth' })" class="absolute -left-2 sm:-left-5 top-[38%] -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-[#1c2030]/90 backdrop-blur-md border border-white/10 text-white flex items-center justify-center hover:bg-white/10 hover:border-cyan-500/50 transition-all z-30 group shadow-[0_4px_15px_rgba(0,0,0,0.5)]">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>

            {{-- cards --}}
            <div id="flash-sale-slider" class="flex gap-3 sm:gap-6 overflow-x-auto px-1 sm:px-6 pt-4 pb-12 scrollbar-hide snap-x snap-mandatory"
                 style="-ms-overflow-style:none;scrollbar-width:none;">

                {{-- Card 1: Valorant VP --}}
            <div class="shrink-0 snap-center w-[calc(33.333%-0.5rem)] sm:w-[calc(33.333%-1rem)] cursor-pointer">
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-orange-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(249,115,22,0.8)]">20% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Valorant</h4>
                        <p class="font-black text-white text-xs mt-0.5">1120 VP</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 150.000</span>
                            <span class="text-green-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,197,94,0.5)]">Rp 120.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Mobile Legends --}}
            <div class="shrink-0 snap-center w-[calc(33.333%-0.5rem)] sm:w-[calc(33.333%-1rem)] cursor-pointer" onclick="openFlashSaleModal()">
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(236,72,153,0.25)] hover:border-pink-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556438064-2d7646166914?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-orange-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(249,115,22,0.8)]">15% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Mobile Legends</h4>
                        <p class="font-black text-white text-xs mt-0.5">86 Diamonds</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 25.000</span>
                            <span class="text-green-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,197,94,0.5)]">Rp 21.250</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 3: Free Fire --}}
            <div class="shrink-0 snap-center w-[calc(33.333%-0.5rem)] sm:w-[calc(33.333%-1rem)] cursor-pointer" >
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-green-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(34,197,94,0.8)]">10% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Free Fire</h4>
                        <p class="font-black text-white text-xs mt-0.5">355 Diamonds</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 50.000</span>
                            <span class="text-orange-400 font-black text-xs drop-shadow-[0_0_5px_rgba(249,115,22,0.5)]">Rp 45.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 4: Genshin Impact --}}
            <div class="shrink-0 snap-center w-[calc(33.333%-0.5rem)] sm:w-[calc(33.333%-1rem)] cursor-pointer" >
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(236,72,153,0.25)] hover:border-pink-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-orange-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(249,115,22,0.8)]">25% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">Genshin Impact</h4>
                        <p class="font-black text-white text-xs mt-0.5">Welkin Moon</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 80.000</span>
                            <span class="text-green-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,197,94,0.5)]">Rp 60.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 5: PUBG Mobile --}}
            <div class="shrink-0 snap-center w-[calc(33.333%-0.5rem)] sm:w-[calc(33.333%-1rem)] cursor-pointer" >
                <div class="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full" >
                    <div class="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=400&fit=crop" class="w-full h-full object-cover opacity-70" />
                        <div class="absolute top-2 right-2 bg-green-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(34,197,94,0.8)]">30% OFF</div>
                    </div>
                    <div class="p-3 flex flex-col items-center text-center">
                        <h4 class="font-bold text-[11px] text-gray-300">PUBG Mobile</h4>
                        <p class="font-black text-white text-xs mt-0.5">325 UC</p>
                        <div class="mt-2 w-full h-px bg-white/5"></div>
                        <div class="mt-1.5 flex flex-col items-center">
                            <span class="text-[9px] text-gray-500 line-through">Rp 75.000</span>
                            <span class="text-orange-400 font-black text-xs drop-shadow-[0_0_5px_rgba(249,115,22,0.5)]">Rp 52.500</span>
                        </div>
                    </div>
                </div>
            </div>

            </div>

            {{-- Next Arrow --}}
            <button onclick="document.getElementById('flash-sale-slider').scrollBy({ left: 250, behavior: 'smooth' })" class="absolute -right-2 sm:-right-5 top-[38%] -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-[#1c2030]/90 backdrop-blur-md border border-white/10 text-white flex items-center justify-center hover:bg-white/10 hover:border-pink-500/50 transition-all z-30 group shadow-[0_4px_15px_rgba(0,0,0,0.5)]">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

        {{-- Pagination Dots --}}
        <div class="flex justify-center items-center gap-2 mt-1 min-h-3" id="flash-sale-dots">
            <!-- Dots will be dynamically generated by JS -->
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slider = document.getElementById('flash-sale-slider');
        const dotsContainer = document.getElementById('flash-sale-dots');
        
        if (slider && dotsContainer) {
            let numDots = 0;

            const setupDots = () => {
                const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
                // If scroll is not necessary, hide/clear dots
                if (maxScrollLeft <= 0) {
                    dotsContainer.innerHTML = '';
                    numDots = 0;
                    return;
                }
                
                // Calculate how many "pages" we have based on container width
                const newNumDots = Math.ceil(slider.scrollWidth / slider.clientWidth);
                
                if (numDots !== newNumDots) {
                    numDots = newNumDots;
                    dotsContainer.innerHTML = '';
                    
                    for (let i = 0; i < numDots; i++) {
                        const dot = document.createElement('span');
                        dot.className = 'w-2.5 h-2.5 rounded-full bg-white/20 hover:bg-white/40 transition-colors cursor-pointer';
                        dot.addEventListener('click', () => {
                            const maxLeft = slider.scrollWidth - slider.clientWidth;
                            slider.scrollTo({
                                left: Math.round((i / (numDots - 1)) * maxLeft),
                                behavior: 'smooth'
                            });
                        });
                        dotsContainer.appendChild(dot);
                    }
                }
                updateActiveDot();
            };
            
            const updateActiveDot = () => {
                if (numDots <= 0) return;
                const dots = dotsContainer.querySelectorAll('span');
                const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
                
                if (maxScrollLeft <= 0) return;
                
                const scrollPercentage = slider.scrollLeft / maxScrollLeft;
                // Clamp activeIndex between 0 and numDots - 1
                const activeIndex = Math.max(0, Math.min(numDots - 1, Math.round(scrollPercentage * (numDots - 1))));
                
                dots.forEach((dot, index) => {
                    if (index === activeIndex) {
                        dot.className = 'w-2.5 h-2.5 rounded-full bg-cyan-400 shadow-[0_0_8px_rgba(34,211,238,0.8)] transition-all cursor-pointer scale-110';
                    } else {
                        dot.className = 'w-2.5 h-2.5 rounded-full bg-white/20 hover:bg-white/40 transition-colors cursor-pointer';
                    }
                });
            };

            // Allow layout to render before calculating dots
            setTimeout(() => {
                setupDots();
            }, 150);

            // Re-calculate on resize in case viewport changes
            window.addEventListener('resize', setupDots);
            
            // Listen to scroll to update active dot
            slider.addEventListener('scroll', updateActiveDot, { passive: true });
        }
    });
</script>

