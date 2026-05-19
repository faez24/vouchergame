<footer id="footer" class="mt-16 border-t border-white/5 relative w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/footer.png') }}');">
    {{-- Dark overlay to ensure text remains readable --}}
    <div class="absolute inset-0 bg-[#050810]/70 backdrop-blur-sm z-0"></div>
    <!-- Footer Decorative Elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-pink-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>

    <div class="max-w-[1440px] mx-auto w-full px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16 pb-6">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 lg:grid-cols-5 xl:gap-16 relative z-10">
        <div class="col-span-2 md:col-span-3 lg:col-span-2">
            <a href="/" class="flex items-center gap-3 w-fit mb-6">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 text-sm font-extrabold tracking-tight text-black shadow-[0_0_15px_rgba(34,211,238,0.5)]">GV</span>
                <span class="text-2xl font-bold tracking-tight text-white drop-shadow">GameVault</span>
            </a>
            <p class="text-gray-400 text-sm leading-relaxed max-w-md mb-8">Platform top up game dan voucher digital terpercaya di Indonesia. Memberikan layanan instan, aman, dan harga terbaik untuk setiap transaksi Anda.</p>
            <div class="flex gap-3">
                <a href="#" aria-label="Facebook" class="w-10 h-10 rounded-xl bg-white/[0.03] hover:bg-cyan-500/10 hover:text-cyan-400 border border-white/5 hover:border-cyan-500/30 flex items-center justify-center transition-all duration-300 text-gray-400 hover:shadow-[0_0_10px_rgba(34,211,238,0.2)]">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                </a>
                <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-xl bg-white/[0.03] hover:bg-pink-500/10 hover:text-pink-400 border border-white/5 hover:border-pink-500/30 flex items-center justify-center transition-all duration-300 text-gray-400 hover:shadow-[0_0_10px_rgba(236,72,153,0.2)]">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg>
                </a>
                <a href="#" aria-label="Twitter" class="w-10 h-10 rounded-xl bg-white/[0.03] hover:bg-cyan-500/10 hover:text-cyan-400 border border-white/5 hover:border-cyan-500/30 flex items-center justify-center transition-all duration-300 text-gray-400 hover:shadow-[0_0_10px_rgba(34,211,238,0.2)]">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                </a>
                <a href="#" aria-label="YouTube" class="w-10 h-10 rounded-xl bg-white/[0.03] hover:bg-pink-500/10 hover:text-pink-400 border border-white/5 hover:border-pink-500/30 flex items-center justify-center transition-all duration-300 text-gray-400 hover:shadow-[0_0_10px_rgba(236,72,153,0.2)]">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"></path><path d="m10 15 5-3-5-3z"></path></svg>
                </a>
            </div>
        </div>

        <div class="col-span-1">
            <h3 class="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Bantuan</h3>
            <ul class="space-y-4">
                <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm font-medium flex justify-between items-center group">Cara Top Up <svg viewBox="0 0 24 24" class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a></li>
                <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm font-medium flex justify-between items-center group">FAQ <svg viewBox="0 0 24 24" class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a></li>
                <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm font-medium flex justify-between items-center group">Hubungi Kami <svg viewBox="0 0 24 24" class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a></li>
                <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm font-medium flex justify-between items-center group">Syarat & Ketentuan <svg viewBox="0 0 24 24" class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a></li>
            </ul>
        </div>

        <div class="col-span-1">
            <h3 class="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Game Populer</h3>
            <ul class="space-y-4">
                <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-cyan-500/50 shadow-[0_0_5px_rgba(34,211,238,0.8)]"></span>Mobile Legends</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-pink-500/50 shadow-[0_0_5px_rgba(236,72,153,0.8)]"></span>Free Fire</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500/50 shadow-[0_0_5px_rgba(59,130,246,0.8)]"></span>PUBG Mobile</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-purple-500/50 shadow-[0_0_5px_rgba(168,85,247,0.8)]"></span>Genshin Impact</a></li>
            </ul>
        </div>

        <div class="col-span-2 sm:col-span-1">
            <h3 class="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Metode Pembayaran</h3>
            <div class="grid grid-cols-2 gap-2">
                <div class="h-10 bg-white/[0.03] rounded-xl flex items-center justify-center border border-white/5 text-gray-300 text-xs font-bold hover:bg-white/[0.06] transition-colors cursor-default">DANA</div>
                <div class="h-10 bg-white/[0.03] rounded-xl flex items-center justify-center border border-white/5 text-gray-300 text-xs font-bold hover:bg-white/[0.06] transition-colors cursor-default">OVO</div>
                <div class="h-10 bg-white/[0.03] rounded-xl flex items-center justify-center border border-white/5 text-gray-300 text-xs font-bold hover:bg-white/[0.06] transition-colors cursor-default">GOPAY</div>
                <div class="h-10 bg-white/[0.03] rounded-xl flex items-center justify-center border border-white/5 text-gray-300 text-xs font-bold hover:bg-white/[0.06] transition-colors cursor-default">QRIS</div>
                <div class="col-span-2 h-10 bg-white/[0.03] rounded-xl flex items-center justify-center border border-white/5 text-gray-300 text-xs font-bold hover:bg-white/[0.06] transition-colors cursor-default tracking-wide uppercase">Virtual Account</div>
            </div>
        </div>
    </div>

    <div class="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4 relative z-10">
        <p class="text-gray-500 text-sm font-medium">© 2026 GameVault. All rights reserved.</p>
        <div class="flex items-center gap-6">
            <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors">Privacy Policy</a>
            <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors">Terms of Service</a>
        </div>
    </div>
        </div>
</footer>
