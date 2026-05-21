<header id="navbar" class="fixed top-0 z-50 w-full bg-transparent transition-all duration-300 border-b border-transparent">
    <div class="mx-auto flex w-full max-w-[1440px] items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <a href="/" class="flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-r from-cyan-400 to-blue-500 text-[15px] font-extrabold tracking-tight text-black shadow-[0_0_15px_rgba(34,211,238,0.5)]">GV</span>
            <span class="text-[1.6rem] font-bold tracking-tight text-white drop-shadow">GameVault</span>
        </a>

        <nav class="hidden items-center gap-8 md:flex">
            <a href="{{ url('/') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Home</a>
            <a href="{{ url('/#games') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Games</a>
            <a href="{{ url('/#voucher') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Voucher</a>
        </nav>

        <div class="flex items-center gap-3 sm:gap-4">
            <button aria-label="Search" class="p-2 hover:bg-white/5 rounded-lg transition-colors">
                <svg viewBox="0 0 24 24" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-3.5-3.5"></path>
                </svg>
            </button>

            {{-- Cart Icon — Desktop Only --}}
            <a href="{{ url('/cart') }}" aria-label="Keranjang"
               class="hidden md:flex relative items-center justify-center w-10 h-10 rounded-xl border border-white/10 bg-white/[0.04] hover:border-cyan-500/50 hover:bg-cyan-500/10 hover:shadow-[0_0_12px_rgba(34,211,238,0.2)] transition-all group">
                {{-- Shopping cart SVG --}}
                <svg viewBox="0 0 24 24" class="w-[22px] h-[22px] text-gray-300 group-hover:text-cyan-400 transition-colors" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                {{-- Badge --}}
                <span id="cart-badge" class="hidden absolute -top-1.5 -right-1.5 min-w-[18px] h-[18px] px-1 rounded-full bg-pink-500 text-white text-[10px] font-black flex items-center justify-center shadow-[0_0_8px_rgba(236,72,153,0.8)] border border-[#344050]">0</span>
            </a>

            <a href="{{ url('/login') }}" class="hidden md:inline-block px-5 py-2 bg-pink-500 hover:bg-pink-400 rounded-lg text-white text-sm font-bold transition-all shadow-[0_0_15px_rgba(236,72,153,0.5)]">Masuk</a>

            {{-- Mobile Hamburger Menu Button --}}
            <button id="mobile-menu-btn" aria-label="Menu" class="md:hidden relative p-2 text-gray-300 hover:text-white transition-colors">
                <svg viewBox="0 0 24 24" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                {{-- Notification Badge for Hamburger --}}
                <span id="hamburger-badge" class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full bg-pink-500 text-white text-[10px] font-black flex items-center justify-center shadow-[0_0_8px_rgba(236,72,153,0.8)] border border-[#344050]">0</span>
            </button>
        </div>
    </div>

    {{-- Mobile Menu Overlay --}}
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[55] hidden transition-opacity duration-300 opacity-0 md:hidden"></div>

    {{-- Mobile Menu Drawer --}}
    <div id="mobile-menu" class="fixed top-0 right-0 h-screen w-[280px] bg-[#050810] border-l border-white/5 shadow-[-10px_0_30px_rgba(0,0,0,0.8)] z-[60] transform translate-x-full transition-transform duration-300 md:hidden flex flex-col">
        <div class="flex items-center justify-between p-5 border-b border-white/10">
            <span class="text-white font-bold text-lg">Menu</span>
            <button id="close-menu-btn" aria-label="Tutup Menu" class="p-2 text-gray-400 hover:text-white transition-colors rounded-lg hover:bg-white/5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <nav class="flex flex-col p-6 gap-8 overflow-y-auto">
            {{-- Home --}}
            <a href="{{ url('/') }}" onclick="setActiveMobileMenu(this)" class="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                <span class="italic font-bold text-white text-[1.3rem]">Home</span>
                <span class="underline-bar h-[3px] w-full bg-gradient-to-r from-cyan-400 to-pink-500 rounded-full mt-1.5 opacity-0 transition-all duration-300"></span>
            </a>
            
            {{-- Cart --}}
            <a href="{{ url('/cart') }}" onclick="setActiveMobileMenu(this)" class="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                <div class="flex items-center gap-3">
                    <span class="italic font-bold text-white text-[1.3rem]">Cart</span>
                    {{-- Notification badge --}}
                    <span id="mobile-cart-badge" class="hidden min-w-[22px] h-[22px] px-1 rounded-full bg-pink-500 text-white text-xs font-black flex items-center justify-center shadow-[0_0_8px_rgba(236,72,153,0.8)]">0</span>
                </div>
                <span class="underline-bar h-[3px] w-full bg-gradient-to-r from-cyan-400 to-pink-500 rounded-full mt-1.5 opacity-0 transition-all duration-300"></span>
            </a>

            {{-- Voucher --}}
            <a href="{{ url('/#voucher') }}" onclick="setActiveMobileMenu(this)" class="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                <div class="flex items-center gap-3">
                    <span class="italic font-bold text-white text-[1.3rem]">Voucher</span>
                    {{-- Notification badge (Optional) --}}
                    <span id="mobile-voucher-badge" class="hidden min-w-[22px] h-[22px] px-1 rounded-full bg-pink-500 text-white text-xs font-black flex items-center justify-center shadow-[0_0_8px_rgba(236,72,153,0.8)]">0</span>
                </div>
                <span class="underline-bar h-[3px] w-full bg-gradient-to-r from-cyan-400 to-pink-500 rounded-full mt-1.5 opacity-0 transition-all duration-300"></span>
            </a>

            {{-- Games --}}
            <a href="{{ url('/#games') }}" onclick="setActiveMobileMenu(this)" class="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                <span class="italic font-bold text-white text-[1.3rem]">Games</span>
                <span class="underline-bar h-[3px] w-full bg-gradient-to-r from-cyan-400 to-pink-500 rounded-full mt-1.5 opacity-0 transition-all duration-300"></span>
            </a>
        </nav>
    </div>
</header>

<script>
    function openMobileMenu() {
        const overlay = document.getElementById('mobile-menu-overlay');
        const menu = document.getElementById('mobile-menu');
        if (overlay) {
            overlay.classList.remove('hidden');
            // Small delay to allow display block to apply before changing opacity
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');
            }, 10);
        }
        if (menu) {
            menu.classList.remove('translate-x-full');
            menu.classList.add('translate-x-0');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        const overlay = document.getElementById('mobile-menu-overlay');
        const menu = document.getElementById('mobile-menu');
        if (menu) {
            menu.classList.add('translate-x-full');
            menu.classList.remove('translate-x-0');
        }
        if (overlay) {
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);
        }
        document.body.style.overflow = '';
    }

    function setActiveMobileMenu(element) {
        if (!element) return;
        
        // Remove active state from all links
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.classList.remove('opacity-100');
            link.classList.add('opacity-60');
            const bar = link.querySelector('.underline-bar');
            if (bar) {
                bar.classList.remove('opacity-100', 'shadow-[0_0_8px_rgba(34,211,238,0.5)]');
                bar.classList.add('opacity-0');
            }
        });

        // Add active state to the clicked element
        element.classList.remove('opacity-60');
        element.classList.add('opacity-100');
        const bar = element.querySelector('.underline-bar');
        if (bar) {
            bar.classList.remove('opacity-0');
            bar.classList.add('opacity-100', 'shadow-[0_0_8px_rgba(34,211,238,0.5)]');
        }
        
        // Close menu after click
        setTimeout(() => {
            closeMobileMenu();
        }, 300);
    }

    // Function to handle notifications (Call this when data updates)
    function updateNotifications(cartCount, voucherCount) {
        const desktopCartBadge = document.getElementById('cart-badge');
        const mobileCartBadge = document.getElementById('mobile-cart-badge');
        const mobileVoucherBadge = document.getElementById('mobile-voucher-badge');
        const hamburgerBadge = document.getElementById('hamburger-badge');
        
        let hasNotification = false;
        let totalNotif = 0;

        // Cart Notification
        if (cartCount > 0) {
            if (desktopCartBadge) { desktopCartBadge.textContent = cartCount; desktopCartBadge.classList.remove('hidden'); }
            if (mobileCartBadge) { mobileCartBadge.textContent = cartCount; mobileCartBadge.classList.remove('hidden'); }
            hasNotification = true;
            totalNotif += cartCount;
        } else {
            if (desktopCartBadge) desktopCartBadge.classList.add('hidden');
            if (mobileCartBadge) mobileCartBadge.classList.add('hidden');
        }

        // Voucher Notification
        if (voucherCount > 0) {
            if (mobileVoucherBadge) { mobileVoucherBadge.textContent = voucherCount; mobileVoucherBadge.classList.remove('hidden'); }
            hasNotification = true;
            totalNotif += voucherCount;
        } else {
            if (mobileVoucherBadge) mobileVoucherBadge.classList.add('hidden');
        }

        // Hamburger Indicator Dot
        if (hasNotification) {
            if (hamburgerBadge) { 
                hamburgerBadge.textContent = totalNotif;
                hamburgerBadge.classList.remove('hidden'); 
            }
        } else {
            if (hamburgerBadge) hamburgerBadge.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const overlay = document.getElementById('mobile-menu-overlay');
        
        // Setup toggle events
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileMenu);
        }
        if (closeMenuBtn) {
            closeMenuBtn.addEventListener('click', closeMobileMenu);
        }
        if (overlay) {
            overlay.addEventListener('click', closeMobileMenu);
        }

        // Handle navbar background on scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > 150) {
                navbar.classList.remove('bg-transparent', 'border-transparent');
                navbar.classList.add('bg-[#050810]/90', 'backdrop-blur-md', 'border-white/5', 'shadow-[0_10px_30px_rgba(0,0,0,0.8)]');
            } else {
                navbar.classList.add('bg-transparent', 'border-transparent');
                navbar.classList.remove('bg-[#050810]/90', 'backdrop-blur-md', 'border-white/5', 'shadow-[0_10px_30px_rgba(0,0,0,0.8)]');
            }
        });

        // Setup active state on load
        const currentPath = window.location.pathname;
        const currentHash = window.location.hash;
        
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            const urlObj = new URL(link.href, window.location.origin);
            
            if (currentPath.includes('/cart') && urlObj.pathname.includes('/cart')) {
                setActiveMobileMenu(link);
            } else if (!currentPath.includes('/cart') && currentHash && urlObj.hash === currentHash) {
                setActiveMobileMenu(link);
            } else if (!currentPath.includes('/cart') && !currentHash && urlObj.pathname === '/' && !urlObj.hash) {
                setActiveMobileMenu(link);
            }
        });

        // Test Dummy Notification Badge
        updateNotifications(1, 0);
    });
</script>
