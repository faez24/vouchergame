<!-- Game Shortcuts: horizontal scrollable icon row -->
<section class="mt-6">
    <div class="flex items-center lg:justify-center gap-3 mb-4">
        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Populer Games</h2>
        <div class="flex-1 lg:hidden h-px bg-gradient-to-r from-white/10 to-transparent"></div>
    </div>
    <div class="flex gap-4 overflow-x-auto lg:justify-center pb-3 scrollbar-hide snap-x snap-mandatory" style="-ms-overflow-style:none;scrollbar-width:none;">
        <!-- ML -->
        <a href="{{ route('topup.ml') }}" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(249,115,22,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-orange-400/50">
                <span class="text-white font-black text-lg">ML</span>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">Mobile Legends</span>
        </a>
        <!-- FF -->
        <a href="#" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-gradient-to-br from-green-600 to-green-700 grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(59,130,246,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-green-500/50">
                <span class="text-white font-black text-lg">FF</span>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">Free Fire</span>
        </a>
        <!-- Valorant -->
        <a href="#" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-[#ef4444] grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(239,68,68,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-red-400/50">
                <span class="text-white font-black text-xl italic">V</span>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">Valorant</span>
        </a>
        <!-- Genshin -->
        <a href="#" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(168,85,247,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-purple-400/50">
                <span class="text-white font-black text-sm">GI</span>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">Genshin</span>
        </a>
        <!-- PUBG -->
        <a href="#" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-gradient-to-br from-yellow-500 to-amber-600 grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(234,179,8,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-yellow-400/50">
                <span class="text-white font-black text-sm">PB</span>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">PUBG</span>
        </a>
        <!-- Steam -->
        <a href="#" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-gradient-to-br from-slate-600 to-slate-800 grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(100,116,139,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-slate-400/50">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.04 2 11.04c0 2.97 1.56 5.58 3.91 7.17L7.5 13.5l3.38 1.45c.36-.04.73-.04 1.12 0l2.88-4.17v-.06c0-1.89 1.53-3.42 3.42-3.42s3.42 1.53 3.42 3.42-1.53 3.42-3.42 3.42h-.12L14.5 17.5l.04.72c0 1.64-1.34 2.98-2.98 2.98-1.39 0-2.55-.96-2.87-2.25L2.24 16C3.75 19.44 7.57 22 12 22c5.52 0 10-4.04 10-9.04S17.52 2 12 2z"/></svg>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">Steam</span>
        </a>
        <!-- Google Play -->
        <a href="#" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(34,197,94,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-green-400/50">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 20.5v-17c0-.59.34-1.11.84-1.35L13.69 12l-9.85 9.85c-.5-.24-.84-.76-.84-1.35zm13.81-5.38L6.05 21.34l8.49-8.49 2.27 2.27zm.91-.91L19.59 12l-1.87-2.21-2.27 2.27 2.27 2.15zM6.05 2.66l10.76 6.22-2.27 2.27-8.49-8.49z"/></svg>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">Google Play</span>
        </a>
        <!-- PlayStation -->
        <a href="#" class="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
            <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-gradient-to-br from-green-700 to-green-900 grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(21,128,61,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-green-600/50">
                <span class="text-white font-black text-sm">PS</span>
            </div>
            <span class="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">PlayStation</span>
        </a>
    </div>
</section>
