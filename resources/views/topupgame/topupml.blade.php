<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Top Up {{ $product['title'] ?? 'Mobile Legends' }} | WarGame</title>
    <meta name="description" content="Top up {{ $product['title'] ?? 'Mobile Legends' }} murah, cepat, dan aman di WarGame.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>

    <style>
        .bg-noise { background-image: radial-gradient(rgba(255,255,255,0.025) 0.8px, transparent 0.8px); background-size: 18px 18px; }

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

        @keyframes slide-smoke {
            0% { background-position: 0 0; }
            100% { background-position: -200vw 0; }
        }
        .moving-smoke-1 {
            position: absolute; top: 0; left: 0;
            width: 300%; height: 100%;
            background-image: url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog1.png');
            background-repeat: repeat-x; background-size: cover;
            opacity: 0.9; filter: brightness(1.2) contrast(1.2);
            animation: slide-smoke 60s linear infinite;
            mix-blend-mode: screen;
        }
        .moving-smoke-2 {
            position: absolute; top: 0; left: 0;
            width: 300%; height: 100%;
            background-image: url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog2.png');
            background-repeat: repeat-x; background-size: cover;
            opacity: 0.8; filter: brightness(1.2) contrast(1.2);
            animation: slide-smoke 40s linear infinite;
            mix-blend-mode: screen;
        }

        .pkg-card { transition: all .25s cubic-bezier(.4,0,.2,1); }
        .pkg-card:hover { transform: translateY(-4px); box-shadow: 0 0 28px rgba(245,158,11,.35), 0 12px 30px rgba(0,0,0,.6); }
        .pkg-card.selected { border-color: #f59e0b !important; box-shadow: 0 0 0 2px #f59e0b66, 0 12px 30px rgba(0,0,0,.6); background: rgba(245, 158, 11, 0.1); }
        .pkg-card.disabled { opacity: .35; pointer-events: none; }

        .pay-card input:checked ~ div.border-2 { border-color: #4ade80; box-shadow: 0 0 15px rgba(34,197,94,0.2); }
        .pay-card input:checked ~ .bg-white { border: 2px solid #4ade80; }

        @keyframes modal-in { from{opacity:0;transform:scale(.95) translateY(12px)} to{opacity:1;transform:scale(1) translateY(0)} }
        .modal-box { animation: modal-in .25s cubic-bezier(.4,0,.2,1) forwards; }

        @keyframes pulse-badge { 0%,100%{box-shadow:0 0 0 0 rgba(249,115,22,.7)} 70%{box-shadow:0 0 0 6px rgba(249,115,22,0)} }
        .pulse-badge { animation: pulse-badge 2s infinite; }

        .step-num { background: linear-gradient(135deg, #f59e0b, #ef4444); }

        .scrollbar-hide { -ms-overflow-style:none; scrollbar-width:none; }
        .scrollbar-hide::-webkit-scrollbar { display:none; }
    </style>
</head>
<body class="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden">

    <div class="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">

        <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
            <div class="moving-smoke-1"></div>
            <div class="moving-smoke-2"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/50"></div>
            <div class="smoke-a absolute top-[-5%] left-[-20%] w-[80vw] h-[70vw] max-w-[1000px] max-h-[800px] rounded-full bg-slate-500/15 blur-[120px]"></div>
            <div class="smoke-b absolute top-[25%] right-[-25%] w-[90vw] h-[80vw] max-w-[1100px] max-h-[900px] rounded-full bg-slate-400/12 blur-[140px]"></div>
            <div class="smoke-c absolute bottom-[5%] left-[5%] w-[70vw] h-[60vw] max-w-[900px] max-h-[700px] rounded-full bg-slate-600/12 blur-[110px]"></div>
            <div class="smoke-d absolute top-[55%] left-[25%] w-[55vw] h-[45vw] max-w-[750px] max-h-[600px] rounded-full bg-slate-500/10 blur-[100px]"></div>
            <div class="smoke-b absolute top-[10%] left-[40%] w-[40vw] h-[35vw] max-w-[550px] max-h-[450px] rounded-full bg-slate-300/8 blur-[80px]"></div>
            <div class="smoke-a absolute bottom-[30%] right-[10%] w-[45vw] h-[38vw] max-w-[600px] max-h-[500px] rounded-full bg-slate-400/8 blur-[90px]"></div>
            <div class="smoke-e absolute top-[20%] left-[8%] w-[25vw] h-[25vw] max-w-[350px] max-h-[350px] rounded-full bg-green-400/5 blur-[70px]"></div>
            <div class="smoke-c absolute bottom-[15%] right-[8%] w-[30vw] h-[30vw] max-w-[400px] max-h-[400px] rounded-full bg-orange-400/4 blur-[80px]"></div>
            <div class="smoke-d absolute top-[45%] right-[30%] w-[20vw] h-[20vw] max-w-[280px] max-h-[280px] rounded-full bg-green-500/5 blur-[60px]"></div>
        </div>

        @include('partials.navbar')

        <div class="relative z-10 flex-1">
        <div class="max-w-[1200px] mx-auto px-4 pt-24 pb-10 space-y-6">

            {{-- Hero Banner --}}
            <div class="relative rounded-2xl overflow-hidden border border-white/10 shadow-[0_8px_40px_rgba(0,0,0,0.6)]">
                <div class="absolute inset-0">
                    <img src="{{ $product['helperUrl'] ?? 'https://images.unsplash.com/photo-1556438064-2d7646166914?w=1200&h=400&fit=crop' }}"
                         alt="{{ $product['title'] ?? '' }}" class="w-full h-full object-cover opacity-40"/>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#1e2433] via-[#1e2433]/70 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1e2433] via-transparent to-transparent"></div>
                </div>
                <div class="relative z-10 p-6 sm:p-8 flex items-center gap-5">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-br from-orange-400 to-orange-600 grid place-items-center shadow-[0_0_30px_rgba(249,115,22,0.5)] flex-shrink-0 border border-orange-400/30 overflow-hidden">
                        @if(!empty($product['logoUrl']))
                            <img src="{{ $product['logoUrl'] }}" alt="{{ $product['title'] }}" class="w-full h-full object-cover" />
                        @else
                            <span class="text-white font-black text-3xl sm:text-4xl">ML</span>
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-orange-500 text-white text-[10px] font-black pulse-badge shadow-[0_0_8px_rgba(249,115,22,0.6)]">POPULER</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">{{ $product['title'] ?? 'Mobile Legends' }}</h1>
                        <p class="text-gray-400 text-xs sm:text-sm mt-1">Top Up {{ $product['title'] ?? '' }} langsung ke akun</p>
                    </div>
                </div>
            </div>

            {{-- Form Layout --}}
            <div class="flex flex-col lg:grid lg:grid-cols-5 gap-5 items-stretch lg:items-start">

                {{-- KIRI: Akun & Pembayaran --}}
                <div class="contents lg:block lg:col-span-2 lg:space-y-5">

                    {{-- 1. Data Akun --}}
                    <div class="order-1 lg:order-none w-full bg-[#252d40]/80 border border-white/8 rounded-2xl p-5 backdrop-blur-md">
                        <h2 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 rounded-full bg-gradient-to-b from-amber-400 to-orange-500 inline-block"></span>
                            1. Data Akun
                        </h2>

                        @if(!empty($product['userInput']['instructionText']))
                            <p class="text-gray-400 text-xs mb-3">{{ strip_tags($product['userInput']['instructionText']) }}</p>
                        @endif

                        <div class="grid grid-cols-2 gap-3">
                            @foreach(($product['userInput']['fields'] ?? []) as $field)
                                @php $name = $field['attrs']['name'] ?? 'field'; @endphp
                                <div>
                                    <label class="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                        {{ $field['attrs']['placeholder'] ?? $name }} <span class="text-orange-500">*</span>
                                    </label>
                                    <input id="input-{{ $name }}" type="text" placeholder="{{ $field['attrs']['placeholder'] ?? '' }}"
                                        class="w-full bg-[#1e2433] border border-white/10 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 outline-none focus:border-amber-500/60 focus:ring-1 focus:ring-amber-500/30 transition-all" oninput="updateSummaryBar()"/>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- 3. Pilih Pembayaran --}}
                    <div class="order-3 lg:order-none w-full bg-[#252d40]/80 border border-white/8 rounded-2xl p-5 backdrop-blur-md">
                        <h2 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 rounded-full bg-gradient-to-b from-green-400 to-green-600 inline-block"></span>
                            3. Pilih Pembayaran
                        </h2>

                        <div class="space-y-3">
                            @php
                            $payments = [
                                ['id' => 'qris', 'name' => 'QRIS', 'desc' => 'Gopay, OVO, Dana, LinkAja', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png'],
                                ['id' => 'gopay', 'name' => 'GoPay', 'desc' => 'Bayar pakai aplikasi Gojek', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/1200px-Gopay_logo.svg.png'],
                                ['id' => 'dana', 'name' => 'DANA', 'desc' => 'Bayar pakai DANA', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1200px-Logo_dana_blue.svg.png'],
                            ];
                            @endphp

                            @foreach($payments as $pay)
                            <label class="pay-card cursor-pointer relative block bg-[#1e2433] border-2 border-white/10 rounded-xl p-3 hover:border-green-500/50 transition-all [&:has(input:checked)]:border-green-400 [&:has(input:checked)]:bg-green-900/20">
                                <input type="radio" name="payment" value="{{ $pay['id'] }}" class="hidden" onchange="selectPayment('{{ $pay['name'] }}')">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-10 bg-white rounded-lg p-1.5 flex items-center justify-center relative z-10 transition-colors">
                                        <img src="{{ $pay['icon'] }}" class="max-w-full max-h-full object-contain" alt="{{ $pay['name'] }}">
                                    </div>
                                    <div class="relative z-10 flex-1">
                                        <p class="text-white font-bold text-sm">{{ $pay['name'] }}</p>
                                        <p class="text-gray-500 text-xs">{{ $pay['desc'] }}</p>
                                    </div>
                                    <div class="outer-circle w-5 h-5 rounded-full border-2 border-gray-600 flex items-center justify-center relative z-10 transition-colors">
                                        <div class="inner-circle w-2.5 h-2.5 rounded-full bg-green-400 scale-0 transition-transform"></div>
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>

                        <style>
                            .pay-card:has(input:checked) .outer-circle { border-color: #4ade80; }
                            .pay-card:has(input:checked) .inner-circle { transform: scale(1); }
                        </style>
                    </div>

                </div>

                {{-- KANAN: Nominal --}}
                <div class="order-2 lg:order-none lg:col-span-3 w-full bg-[#252d40]/80 border border-white/8 rounded-2xl p-5 backdrop-blur-md">
                    <h2 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                        <span class="w-1 h-5 rounded-full bg-gradient-to-b from-orange-500 to-purple-500 inline-block"></span>
                        2. Pilih Nominal
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-3" id="packages-grid">
                        @forelse($items as $item)
                        <div class="pkg-card relative bg-[#1e2433] border border-white/8 rounded-xl p-3 cursor-pointer select-none text-center flex flex-col items-center justify-center min-h-[100px] {{ (!($item['isActive'] ?? true) || ($item['isMaintenance'] ?? false)) ? 'disabled' : '' }}"
                             id="pkg-{{ $item['id'] }}"
                             onclick="selectPackage({{ $item['id'] }}, '{{ addslashes($item['name']) }}', {{ (int) $item['price'] }})">

                            @if($item['isMaintenance'] ?? false)
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-full text-[9px] font-black bg-gray-500 text-white shadow whitespace-nowrap">
                                MAINTENANCE
                            </div>
                            @endif

                            <span class="text-white font-bold text-sm">{{ $item['name'] }}</span>
                            <p class="text-amber-400 font-bold text-sm mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                            <div class="check-icon absolute top-2 right-2 w-4 h-4 rounded-full bg-amber-500 items-center justify-center hidden">
                                <svg class="w-2.5 h-2.5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-400 text-sm col-span-full text-center py-8">Belum ada nominal tersedia untuk produk ini.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
        </div>

        @include('partials.footer')
    </div>

    {{-- FLOATING BOTTOM BAR --}}
    <div id="floating-bar" class="fixed bottom-0 left-0 w-full z-[90] translate-y-[120%] transition-transform duration-300 pointer-events-none">
        <div class="max-w-[1200px] mx-auto p-4 sm:p-6 pointer-events-auto">
            <div class="bg-[#252d40]/95 backdrop-blur-xl rounded-2xl shadow-[0_-5px_40px_rgba(0,0,0,0.8)] p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border border-white/10">

                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-white" id="float-product">Pilih Produk</span>
                        <span class="text-gray-400 text-xs">•</span>
                        <span class="text-sm font-semibold text-gray-300" id="float-payment">Pilih Metode</span>
                    </div>

                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-2xl font-black text-green-500" id="float-price">Rp -</span>
                        <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Pajak sudah termasuk</span>
                    </div>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button onclick="openCheckoutModal()" id="btn-beli" disabled
                        class="flex-1 sm:flex-none sm:w-[180px] py-3.5 rounded-xl bg-gray-300 text-gray-500 font-bold text-sm transition-all shadow-none flex items-center justify-center gap-2 disabled:cursor-not-allowed">
                        Beli Sekarang
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- Checkout Modal --}}
    <div id="checkout-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeCheckoutModal()"></div>
        <div class="modal-box relative w-full max-w-md bg-[#1e2433] border border-white/10 rounded-3xl shadow-[0_30px_80px_rgba(0,0,0,0.8)] overflow-hidden">
            <div class="h-1 w-full" style="background:linear-gradient(90deg,#3b82f6,#8b5cf6,#ec4899)"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-white font-black text-lg">Konfirmasi Pembelian</h3>
                        <p class="text-gray-500 text-xs mt-0.5">Periksa detail pesanan Anda</p>
                    </div>
                    <button onclick="closeCheckoutModal()" class="w-8 h-8 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="bg-[#252d40] rounded-xl px-4 py-3 flex items-center justify-between">
                        <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Item</span>
                        <span class="text-white font-bold text-sm" id="modal-product">—</span>
                    </div>

                    <div class="bg-[#252d40] rounded-xl px-4 py-3 flex items-center justify-between">
                        <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Metode Bayar</span>
                        <span class="text-white font-bold text-sm" id="modal-payment">—</span>
                    </div>

                    <div class="bg-gradient-to-r from-green-600/10 to-purple-500/10 border border-green-600/20 rounded-xl px-4 py-4 flex items-center justify-between mt-2">
                        <span class="text-gray-300 text-sm font-bold">Total Pembayaran</span>
                        <span class="text-green-500 font-black text-xl" id="modal-price">—</span>
                    </div>
                </div>

                <p id="modal-error" class="hidden text-red-400 text-xs mb-3"></p>

                <button onclick="confirmOrder()" id="btn-confirm" class="w-full py-3.5 rounded-xl bg-green-700 hover:bg-green-700 text-white font-black text-sm tracking-wider transition-all shadow-[0_0_20px_rgba(22,163,74,0.4)]">
                    KONFIRMASI
                </button>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div id="toast" class="fixed top-20 left-1/2 -translate-x-1/2 z-[110] hidden">
        <div class="bg-[#252d40] border border-white/10 rounded-xl px-5 py-3 text-sm font-semibold text-white shadow-xl backdrop-blur-md flex items-center gap-2">
            <span id="toast-icon">✅</span>
            <span id="toast-msg"></span>
        </div>
    </div>

    <form id="checkout-form" method="POST" action="{{ route('topup.checkout', $product['id'] ?? 0) }}" class="hidden">
        @csrf
        <input type="hidden" name="product_item_id" id="form-item-id">
        <input type="hidden" name="price" id="form-price">
        <input type="hidden" name="user_id_ingame" id="form-user-id">
        <input type="hidden" name="zone_id" id="form-zone-id">
    </form>

    <script>
        // ─── State ───────────────────────────────────────────────
        let selectedItem = null; // { id, label, priceNum }
        let selectedPayName = null;

        function formatRupiah(num) {
            return 'Rp ' + num.toLocaleString('id-ID');
        }

        function fieldValues() {
            const values = {};
            document.querySelectorAll('[id^="input-"]').forEach(el => {
                values[el.id.replace('input-', '')] = el.value.trim();
            });
            return values;
        }

        // ─── Select single package ─────────────────────────────
        function selectPackage(id, label, priceNum) {
            document.querySelectorAll('.pkg-card').forEach(card => {
                card.classList.remove('selected');
                card.querySelector('.check-icon')?.classList.add('hidden');
                card.querySelector('.check-icon')?.classList.remove('flex');
            });

            const card = document.getElementById('pkg-' + id);
            card.classList.add('selected');
            const check = card.querySelector('.check-icon');
            check?.classList.remove('hidden');
            check?.classList.add('flex');

            selectedItem = { id, label, priceNum };
            updateSummaryBar();
        }

        function selectPayment(name) {
            selectedPayName = name;
            updateSummaryBar();
        }

        // ─── Update floating bar ──────────────────────────────────
        function updateSummaryBar() {
            const bar = document.getElementById('floating-bar');
            const btnBuy = document.getElementById('btn-beli');

            if (selectedItem || selectedPayName) {
                bar.classList.remove('translate-y-[120%]');
                bar.classList.add('translate-y-0');
            } else {
                bar.classList.add('translate-y-[120%]');
                bar.classList.remove('translate-y-0');
            }

            document.getElementById('float-product').textContent = selectedItem ? selectedItem.label : 'Pilih Nominal';
            document.getElementById('float-payment').textContent = selectedPayName || 'Pilih Metode Pembayaran';
            document.getElementById('float-price').textContent = selectedItem ? formatRupiah(selectedItem.priceNum) : 'Rp -';

            if (selectedItem && selectedPayName) {
                btnBuy.disabled = false;
                btnBuy.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                btnBuy.classList.add('bg-green-700', 'hover:bg-green-700', 'text-white', 'shadow-lg', 'shadow-green-700/30');
            } else {
                btnBuy.disabled = true;
                btnBuy.classList.add('bg-gray-300', 'text-gray-500');
                btnBuy.classList.remove('bg-green-700', 'hover:bg-green-700', 'text-white', 'shadow-lg', 'shadow-green-700/30');
            }
        }

        // ─── Checkout modal ───────────────────────────────────────
        function openCheckoutModal() {
            if (!selectedItem || !selectedPayName) return;

            document.getElementById('modal-product').textContent = selectedItem.label;
            document.getElementById('modal-payment').textContent = selectedPayName;
            document.getElementById('modal-price').textContent = formatRupiah(selectedItem.priceNum);
            document.getElementById('modal-error').classList.add('hidden');

            const modal = document.getElementById('checkout-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkout-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function confirmOrder() {
            const values = fieldValues();
            const missing = Object.entries(values).filter(([k, v]) => !v);
            if (missing.length > 0) {
                const el = document.getElementById('modal-error');
                el.textContent = 'Mohon lengkapi semua data akun terlebih dahulu.';
                el.classList.remove('hidden');
                return;
            }

            document.getElementById('form-item-id').value = selectedItem.id;
            document.getElementById('form-price').value = selectedItem.priceNum;
            document.getElementById('form-user-id').value = values.userId || '';
            document.getElementById('form-zone-id').value = values.zoneId || '';

            const btn = document.getElementById('btn-confirm');
            btn.disabled = true;
            btn.textContent = 'Memproses...';

            document.getElementById('checkout-form').submit();
        }

        function showToast(icon, msg) {
            const t = document.getElementById('toast');
            document.getElementById('toast-icon').textContent = icon;
            document.getElementById('toast-msg').textContent = msg;
            t.classList.remove('hidden');
            clearTimeout(window._toastTimer);
            window._toastTimer = setTimeout(() => t.classList.add('hidden'), 3000);
        }
    </script>
</body>
</html>
