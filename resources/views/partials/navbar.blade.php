<header id="navbar" class="fixed top-0 z-50 w-full bg-transparent transition-all duration-300 border-b border-transparent">
    <div class="mx-auto flex w-full max-w-[1440px] items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <a href="/" class="flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-r from-cyan-400 to-blue-500 text-[15px] font-extrabold tracking-tight text-black shadow-[0_0_15px_rgba(34,211,238,0.5)]">GV</span>
            <span class="text-[1.6rem] font-bold tracking-tight text-white drop-shadow">GameVault</span>
        </a>

        <nav class="hidden items-center gap-8 md:flex">
            <a href="{{ url('/#home') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Home</a>
            <a href="{{ url('/#games') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Games</a>
            <a href="{{ url('/#voucher') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Voucher</a>
            <a href="{{ url('/#promo') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Promo</a>
        </nav>

        <div class="flex items-center gap-3 sm:gap-4">
            <button aria-label="Search" class="p-2 hover:bg-white/5 rounded-lg transition-colors">
                <svg viewBox="0 0 24 24" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-3.5-3.5"></path>
                </svg>
            </button>

            {{-- Cart Icon — Shopee/Tokped style shopping bag --}}
            <a href="{{ url('/cart') }}" aria-label="Keranjang"
               class="relative flex items-center justify-center w-10 h-10 rounded-xl border border-white/10 bg-white/[0.04] hover:border-cyan-500/50 hover:bg-cyan-500/10 hover:shadow-[0_0_12px_rgba(34,211,238,0.2)] transition-all group">
                {{-- Shopping bag SVG (Shopee/Tokped style) --}}
                <svg viewBox="0 0 24 24" class="w-[22px] h-[22px] text-gray-300 group-hover:text-cyan-400 transition-colors" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    {{-- Bag body --}}
                    <path d="M6 2h12l2 5v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7l2-5z"/>
                    {{-- Handle arc --}}
                    <path d="M9 7a3 3 0 006 0"/>
                </svg>
                {{-- Badge --}}
                <span id="cart-badge" class="hidden absolute -top-1.5 -right-1.5 min-w-[18px] h-[18px] px-1 rounded-full bg-pink-500 text-white text-[10px] font-black flex items-center justify-center shadow-[0_0_8px_rgba(236,72,153,0.8)] border border-[#344050]">0</span>
            </a>

            <a href="{{ url('/login') }}" class="hidden sm:inline-block px-5 py-2 bg-pink-500 hover:bg-pink-400 rounded-lg text-white text-sm font-bold transition-all shadow-[0_0_15px_rgba(236,72,153,0.5)]">Masuk</a>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 150) {
                navbar.classList.remove('bg-transparent', 'border-transparent');
                navbar.classList.add('bg-[#050810]/90', 'backdrop-blur-md', 'border-white/5', 'shadow-[0_10px_30px_rgba(0,0,0,0.8)]');
            } else {
                navbar.classList.add('bg-transparent', 'border-transparent');
                navbar.classList.remove('bg-[#050810]/90', 'backdrop-blur-md', 'border-white/5', 'shadow-[0_10px_30px_rgba(0,0,0,0.8)]');
            }
        });
    });
</script>
