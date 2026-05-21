<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GameVault | Voucher</title>
        <meta name="description" content="Klaim dan gunakan voucher diskon untuk top up game di GameVault.">

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

            /* Toast Notification Style */
            #toast-container {
                position: fixed;
                bottom: 30px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
                pointer-events: none;
            }

            .toast-notification {
                background: rgba(22, 25, 32, 0.95);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(34, 211, 238, 0.5);
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5), 0 0 15px rgba(34, 211, 238, 0.3);
                transform: translateY(100%);
                opacity: 0;
                transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .toast-notification.show {
                transform: translateY(0);
                opacity: 1;
            }

            .toast-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 24px;
                height: 24px;
                background: rgba(34, 211, 238, 0.2);
                color: #22d3ee;
                border-radius: 50%;
            }

            /* Mobile Tab Styles */
            .mobile-tab-btn {
                color: #9ca3af;
                font-weight: 500;
                font-style: italic;
                opacity: 0.5;
                transition: all 0.3s ease;
                position: relative;
                padding-bottom: 4px;
            }
            .mobile-tab-btn:hover {
                color: #e5e7eb;
                opacity: 0.8;
            }
            .mobile-tab-btn.is-active {
                color: #ffffff;
                font-weight: 900;
                opacity: 1;
                text-shadow: 0 2px 10px rgba(0,0,0,0.5);
            }
            @keyframes animate-underline {
                0% { background-position: 0% center; }
                100% { background-position: -200% center; }
            }
            .mobile-tab-btn::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 2px;
                background: linear-gradient(90deg, #22d3ee, #ec4899, #22d3ee);
                background-size: 200% auto;
                transform: scaleX(0);
                transition: transform 0.5s ease;
                transform-origin: left;
                box-shadow: 0 0 8px rgba(236, 72, 153, 0.6);
            }
            .mobile-tab-btn.is-active::after {
                transform: scaleX(1);
                animation: animate-underline 4s linear infinite;
            }

            /* Slide Animations for Mobile Panels */
            @keyframes animateSlideLeft {
                0% { opacity: 0; transform: translateX(-30px); }
                100% { opacity: 1; transform: translateX(0); }
            }
            @keyframes animateSlideRight {
                0% { opacity: 0; transform: translateX(30px); }
                100% { opacity: 1; transform: translateX(0); }
            }
            .slide-animate-left { animation: animateSlideLeft 0.4s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
            .slide-animate-right { animation: animateSlideRight 0.4s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
        </style>
    </head>
    <body class="min-h-screen bg-[#344050] text-white font-sans selection:bg-cyan-500 selection:text-white overflow-x-hidden">

        <div class="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
            
            @include('partials.navbar')

            {{-- Smoky War-Zone Background Atmosphere --}}
            <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
                <div class="moving-smoke-1"></div>
                <div class="moving-smoke-2"></div>
                
                <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/50"></div>
                
                <div class="smoke-a absolute top-[-5%] left-[-20%] w-[80vw] h-[70vw] max-w-[1000px] max-h-[800px] rounded-full bg-slate-500/15 blur-[120px]"></div>
                <div class="smoke-b absolute top-[25%] right-[-25%] w-[90vw] h-[80vw] max-w-[1100px] max-h-[900px] rounded-full bg-slate-400/12 blur-[140px]"></div>
                <div class="smoke-c absolute bottom-[5%] left-[5%] w-[70vw] h-[60vw] max-w-[900px] max-h-[700px] rounded-full bg-slate-600/12 blur-[110px]"></div>
                <div class="smoke-d absolute top-[55%] left-[25%] w-[55vw] h-[45vw] max-w-[750px] max-h-[600px] rounded-full bg-slate-500/10 blur-[100px]"></div>
                
                <div class="smoke-e absolute top-[20%] left-[8%] w-[25vw] h-[25vw] max-w-[350px] max-h-[350px] rounded-full bg-cyan-400/5 blur-[70px]"></div>
                <div class="smoke-c absolute bottom-[15%] right-[8%] w-[30vw] h-[30vw] max-w-[400px] max-h-[400px] rounded-full bg-pink-400/4 blur-[80px]"></div>
            </div>

            <div class="relative z-10 flex flex-col flex-grow pt-24 sm:pt-32 pb-12">
                <main class="mx-auto w-full max-w-[1440px] px-3 sm:px-4 lg:px-6 flex-grow">
                    
                    {{-- Page Header --}}
                    <div class="mb-8 pb-4 border-b border-white/5 relative">
                        <div class="absolute -bottom-[1px] left-0 w-32 h-[1px] bg-gradient-to-r from-cyan-400 to-transparent"></div>
                        <h1 class="text-3xl sm:text-4xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Voucher</h1>
                    </div>

                    {{-- Mobile Tab Navigation (Hidden on lg screens) --}}
                    <div class="lg:hidden mb-8 flex items-center justify-center gap-4 max-w-sm mx-auto">
                        <button id="mobile-tab-voucher-saya" onclick="toggleVoucherPanel('voucher-saya')" class="mobile-tab-btn is-active text-[13px] tracking-widest uppercase outline-none">
                            Voucher Saya
                        </button>
                        
                        <span class="text-white/20 font-black italic text-lg select-none">/</span>
                        
                        <button id="mobile-tab-klaim-voucher" onclick="toggleVoucherPanel('klaim-voucher')" class="mobile-tab-btn text-[13px] tracking-widest uppercase outline-none">
                            Klaim Voucher
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start relative">
                        
                        {{-- Desktop Divider --}}
                        <div class="hidden lg:block absolute left-1/2 top-0 bottom-0 w-[1px] -translate-x-1/2 pointer-events-none opacity-60" style="background: linear-gradient(to bottom, transparent, #22d3ee, #ec4899, transparent); box-shadow: 0 0 12px rgba(236, 72, 153, 0.5);"></div>

                        {{-- Kiri: Voucher Saya (Setengah Halaman - lg:col-span-6) --}}
                        <section id="voucher-saya-panel" class="lg:col-span-6">
                            <div class="mb-5 hidden lg:flex items-center gap-3">
                                <div class="w-1.5 h-1.5 bg-pink-500 rotate-45 animate-pulse shadow-[0_0_8px_rgba(236,72,153,0.8)]"></div>
                                <h2 class="text-xl font-black text-white uppercase tracking-widest drop-shadow">Voucher Saya</h2>
                            </div>
                            
                            <div class="space-y-4">
                                {{-- Card Voucher Saya 1 --}}
                                <div class="relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d flex items-stretch group hover:border-pink-500/30 transition-all duration-300">
                                    {{-- Accent Left Border --}}
                                    <div class="w-2 bg-gradient-to-b from-pink-500 to-purple-600"></div>
                                    
                                    {{-- Icon/Value Area --}}
                                    <div class="w-24 sm:w-32 bg-[#1a1f2e] border-r border-dashed border-white/10 flex flex-col items-center justify-center p-3 relative">
                                        {{-- Semicircle cutouts for ticket effect --}}
                                        <div class="absolute -top-3 -right-3 w-6 h-6 rounded-full bg-[#161920]/80 border-b border-l border-white/5 z-10"></div>
                                        <div class="absolute -bottom-3 -right-3 w-6 h-6 rounded-full bg-[#161920]/80 border-t border-l border-white/5 z-10"></div>
                                        
                                        <span class="text-2xl sm:text-3xl font-black text-pink-500 drop-shadow-[0_0_8px_rgba(236,72,153,0.5)]">20%</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Diskon</span>
                                    </div>
                                    
                                    {{-- Content Area --}}
                                    <div class="p-4 flex-grow flex flex-col justify-center">
                                        <div class="flex justify-between items-start mb-1">
                                            <h3 class="text-base sm:text-lg font-extrabold text-white">Diskon Top Up MLBB</h3>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-500/20 text-green-400 border border-green-500/30">Aktif</span>
                                        </div>
                                        <p class="text-[11px] sm:text-xs text-gray-400 mb-3">Maksimal diskon Rp 25.000. Berlaku hingga 30 Mei 2026.</p>
                                        
                                        <div>
                                            <a href="{{ route('topup.ml') }}" class="inline-flex items-center gap-2 px-4 py-1.5 sm:py-2 bg-pink-500 hover:bg-pink-400 rounded-lg text-white text-[11px] sm:text-xs font-bold transition-all shadow-[0_0_10px_rgba(236,72,153,0.4)] hover:shadow-[0_0_15px_rgba(236,72,153,0.6)]">
                                                Gunakan Sekarang
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card Voucher Saya 2 --}}
                                <div class="relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d flex items-stretch group hover:border-cyan-500/30 transition-all duration-300">
                                    <div class="w-2 bg-gradient-to-b from-cyan-400 to-blue-600"></div>
                                    
                                    <div class="w-24 sm:w-32 bg-[#1a1f2e] border-r border-dashed border-white/10 flex flex-col items-center justify-center p-3 relative">
                                        <div class="absolute -top-3 -right-3 w-6 h-6 rounded-full bg-[#161920]/80 border-b border-l border-white/5 z-10"></div>
                                        <div class="absolute -bottom-3 -right-3 w-6 h-6 rounded-full bg-[#161920]/80 border-t border-l border-white/5 z-10"></div>
                                        
                                        <span class="text-xl sm:text-2xl font-black text-cyan-400 drop-shadow-[0_0_8px_rgba(34,211,238,0.5)]">10k</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">Potongan</span>
                                    </div>
                                    
                                    <div class="p-4 flex-grow flex flex-col justify-center">
                                        <div class="flex justify-between items-start mb-1">
                                            <h3 class="text-base sm:text-lg font-extrabold text-white">Potongan Harga Steam</h3>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-500/20 text-green-400 border border-green-500/30">Aktif</span>
                                        </div>
                                        <p class="text-[11px] sm:text-xs text-gray-400 mb-3">Minimal transaksi Rp 50.000. Berlaku hingga 15 Jun 2026.</p>
                                        
                                        <div>
                                            <a href="{{ route('cart') }}" class="inline-flex items-center gap-2 px-4 py-1.5 sm:py-2 bg-cyan-500 hover:bg-cyan-400 rounded-lg text-black text-[11px] sm:text-xs font-bold transition-all shadow-[0_0_10px_rgba(34,211,238,0.4)] hover:shadow-[0_0_15px_rgba(34,211,238,0.6)]">
                                                Gunakan Sekarang
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- Kanan: Voucher Tersedia (Setengah Halaman - lg:col-span-6) --}}
                        <section id="klaim-voucher-panel" class="lg:col-span-6">
                            <div class="mb-5 hidden lg:flex items-center gap-3">
                                <div class="w-1.5 h-1.5 bg-cyan-400 rotate-45 animate-pulse shadow-[0_0_8px_rgba(34,211,238,0.8)]"></div>
                                <h2 class="text-xl font-black text-white uppercase tracking-widest drop-shadow">Klaim Voucher</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Card Tersedia 1 --}}
                                <div class="relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d p-5 flex flex-col justify-between group hover:border-cyan-500/30 transition-all duration-300">
                                    <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-500/5 rounded-full blur-2xl pointer-events-none group-hover:bg-cyan-500/10 transition-all"></div>
                                    
                                    <div class="relative z-10">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="inline-block px-2.5 py-1 rounded-md bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 text-[10px] font-bold shadow-[0_0_8px_rgba(34,211,238,0.2)]">Terbatas</div>
                                            <span class="text-xs font-bold text-gray-500"><svg class="inline w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>12 Jam Lagi</span>
                                        </div>
                                        <h3 class="text-base font-extrabold text-white mb-2">Cashback 50% OVO</h3>
                                        <p class="text-xs text-gray-400 line-clamp-2 mb-3">Dapatkan cashback 50% hingga 20.000 OVO Points untuk setiap pembelian voucher game.</p>
                                        
                                        <div class="bg-black/30 rounded p-3 mb-4 border border-white/5">
                                            <h4 class="text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-1">Syarat & Ketentuan:</h4>
                                            <ul class="text-[10px] text-gray-400 list-disc list-outside ml-3 space-y-1">
                                                <li>Khusus pengguna baru</li>
                                                <li>Metode pembayaran OVO</li>
                                                <li>Kuota terbatas tiap hari</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="relative z-10 pt-2 border-t border-white/5">
                                        <button onclick="claimVoucher(this, 'Cashback 50% OVO', 'cyan')" class="w-full py-2.5 border border-cyan-500/50 bg-cyan-500/10 text-cyan-400 hover:bg-cyan-500 hover:text-black rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                                            Klaim Voucher
                                        </button>
                                    </div>
                                </div>
                                
                                {{-- Card Tersedia 2 --}}
                                <div class="relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d p-5 flex flex-col justify-between group hover:border-pink-500/30 transition-all duration-300">
                                    <div class="absolute top-0 right-0 w-24 h-24 bg-pink-500/5 rounded-full blur-2xl pointer-events-none group-hover:bg-pink-500/10 transition-all"></div>
                                    
                                    <div class="relative z-10">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="inline-block px-2.5 py-1 rounded-md bg-pink-500/10 border border-pink-500/30 text-pink-400 text-[10px] font-bold shadow-[0_0_8px_rgba(236,72,153,0.2)]">Event Spesial</div>
                                            <span class="text-xs font-bold text-gray-500"><svg class="inline w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>3 Hari Lagi</span>
                                        </div>
                                        <h3 class="text-base font-extrabold text-white mb-2">Diskon 10% All Games</h3>
                                        <p class="text-xs text-gray-400 line-clamp-2 mb-3">Nikmati potongan langsung 10% tanpa minimum pembelian untuk semua produk.</p>
                                        
                                        <div class="bg-black/30 rounded p-3 mb-4 border border-white/5">
                                            <h4 class="text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-1">Syarat & Ketentuan:</h4>
                                            <ul class="text-[10px] text-gray-400 list-disc list-outside ml-3 space-y-1">
                                                <li>Berlaku untuk semua game</li>
                                                <li>Maks. potongan Rp 50.000</li>
                                                <li>Hanya dapat diklaim 1x</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="relative z-10 pt-2 border-t border-white/5">
                                        <button onclick="claimVoucher(this, 'Diskon 10% All Games', 'pink')" class="w-full py-2.5 border border-pink-500/50 bg-pink-500/10 text-pink-400 hover:bg-pink-500 hover:text-white rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                                            Klaim Voucher
                                        </button>
                                    </div>
                                </div>

                                {{-- Card Tersedia 3 --}}
                                <div class="relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d p-5 flex flex-col justify-between group hover:border-purple-500/30 transition-all duration-300 sm:col-span-2 lg:col-span-1">
                                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/5 rounded-full blur-2xl pointer-events-none group-hover:bg-purple-500/10 transition-all"></div>
                                    
                                    <div class="relative z-10">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="inline-block px-2.5 py-1 rounded-md bg-purple-500/10 border border-purple-500/30 text-purple-400 text-[10px] font-bold shadow-[0_0_8px_rgba(168,85,247,0.2)]">Pengguna Baru</div>
                                        </div>
                                        <h3 class="text-base font-extrabold text-white mb-2">Welcome Bonus Rp 5k</h3>
                                        <p class="text-xs text-gray-400 line-clamp-2 mb-3">Khusus untuk kamu yang baru mendaftar di GameVault. Langsung dapat potongan.</p>
                                        
                                        <div class="bg-black/30 rounded p-3 mb-4 border border-white/5">
                                            <h4 class="text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-1">Syarat & Ketentuan:</h4>
                                            <ul class="text-[10px] text-gray-400 list-disc list-outside ml-3 space-y-1">
                                                <li>Min. transaksi Rp 20.000</li>
                                                <li>Hanya untuk akun baru (max 7 hari)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="relative z-10 pt-2 border-t border-white/5">
                                        <button onclick="claimVoucher(this, 'Welcome Bonus Rp 5k', 'purple')" class="w-full py-2.5 border border-purple-500/50 bg-purple-500/10 text-purple-400 hover:bg-purple-500 hover:text-white rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                                            Klaim Voucher
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </main>

                @include('partials.footer')
            </div>
        </div>

        {{-- Toast Container --}}
        <div id="toast-container"></div>

        <script>
            function claimVoucher(btn, voucherName, colorTheme) {
                // Change button state
                btn.innerText = 'Diklaim';
                btn.className = 'w-full py-2.5 bg-gray-800 text-gray-500 border border-gray-700 rounded-lg text-xs font-black uppercase tracking-widest cursor-not-allowed opacity-70';
                btn.disabled = true;
                
                // Determine icon color based on theme
                let iconColorClass = 'text-cyan-400';
                let iconBgClass = 'bg-cyan-500/20';
                let borderGlowClass = 'border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.3)]';
                
                if (colorTheme === 'pink') {
                    iconColorClass = 'text-pink-400';
                    iconBgClass = 'bg-pink-500/20';
                    borderGlowClass = 'border-pink-500/50 shadow-[0_0_15px_rgba(236,72,153,0.3)]';
                } else if (colorTheme === 'purple') {
                    iconColorClass = 'text-purple-400';
                    iconBgClass = 'bg-purple-500/20';
                    borderGlowClass = 'border-purple-500/50 shadow-[0_0_15px_rgba(168,85,247,0.3)]';
                }

                // Create toast notification element
                const toastContainer = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = `toast-notification ${borderGlowClass}`;
                
                toast.innerHTML = `
                    <div class="toast-icon ${iconBgClass} ${iconColorClass}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-300 font-medium leading-none mb-1">Berhasil Klaim</p>
                        <p class="text-sm font-bold text-white leading-none">${voucherName}</p>
                    </div>
                `;
                
                toastContainer.appendChild(toast);
                
                // Trigger animation
                setTimeout(() => {
                    toast.classList.add('show');
                }, 10);
                
                // Remove toast after 3 seconds
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        toast.remove();
                    }, 400); // Wait for transition out
                }, 3000);
            }

            function toggleVoucherPanel(panelName) {
                const voucherSayaPanel = document.getElementById('voucher-saya-panel');
                const klaimVoucherPanel = document.getElementById('klaim-voucher-panel');
                const voucherSayaTab = document.getElementById('mobile-tab-voucher-saya');
                const klaimVoucherTab = document.getElementById('mobile-tab-klaim-voucher');

                if (!voucherSayaPanel || !klaimVoucherPanel || !voucherSayaTab || !klaimVoucherTab) {
                    return;
                }

                const showVoucherSaya = panelName === 'voucher-saya';

                if (window.innerWidth < 1024) {
                    if (showVoucherSaya) {
                        klaimVoucherPanel.classList.add('hidden');
                        
                        if (voucherSayaPanel.classList.contains('hidden')) {
                            voucherSayaPanel.classList.remove('hidden');
                            voucherSayaPanel.classList.remove('slide-animate-left', 'slide-animate-right');
                            void voucherSayaPanel.offsetWidth; // trigger reflow
                            voucherSayaPanel.classList.add('slide-animate-left');
                        }
                    } else {
                        voucherSayaPanel.classList.add('hidden');
                        
                        if (klaimVoucherPanel.classList.contains('hidden')) {
                            klaimVoucherPanel.classList.remove('hidden');
                            klaimVoucherPanel.classList.remove('slide-animate-left', 'slide-animate-right');
                            void klaimVoucherPanel.offsetWidth; // trigger reflow
                            klaimVoucherPanel.classList.add('slide-animate-right');
                        }
                    }
                }

                voucherSayaTab.classList.toggle('is-active', showVoucherSaya);
                klaimVoucherTab.classList.toggle('is-active', !showVoucherSaya);
            }

            function syncVoucherPanelsWithViewport() {
                const voucherSayaPanel = document.getElementById('voucher-saya-panel');
                const klaimVoucherPanel = document.getElementById('klaim-voucher-panel');

                if (!voucherSayaPanel || !klaimVoucherPanel) {
                    return;
                }

                if (window.innerWidth >= 1024) {
                    voucherSayaPanel.classList.remove('hidden', 'slide-animate-left', 'slide-animate-right');
                    klaimVoucherPanel.classList.remove('hidden', 'slide-animate-left', 'slide-animate-right');
                    return;
                }

                const activePanel = document.getElementById('mobile-tab-klaim-voucher')?.classList.contains('is-active') ? 'klaim-voucher' : 'voucher-saya';
                toggleVoucherPanel(activePanel);
            }

            document.addEventListener('DOMContentLoaded', syncVoucherPanelsWithViewport);
            window.addEventListener('resize', syncVoucherPanelsWithViewport);
        </script>
    </body>
</html>
