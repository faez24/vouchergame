<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran QRIS | GameVault</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
        }
    </script>
    <style>
        .bg-noise { background-image: radial-gradient(rgba(255,255,255,0.025) 0.8px, transparent 0.8px); background-size: 18px 18px; }
        @keyframes scan { 0% { top: 1rem; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { top: calc(100% - 1.2rem); opacity: 0; } }
    </style>
</head>
<body class="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden flex flex-col">

    {{-- Background --}}
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-[#1e2433] to-[#344050]"></div>
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-cyan-500/10 blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] rounded-full bg-blue-500/10 blur-[100px]"></div>
    </div>

    @include('partials.navbar')

    <div class="relative z-10 flex-1 max-w-[500px] mx-auto w-full px-4 pt-28 pb-20 flex flex-col justify-center">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Selesaikan Pembayaran</h1>
            <p class="text-gray-400 text-sm mt-2">Pindai kode QR di bawah ini menggunakan aplikasi e-wallet atau m-banking kamu.</p>
        </div>

        <div class="bg-[#252d40]/90 backdrop-blur-xl border border-white/10 rounded-3xl p-6 sm:p-8 shadow-[0_30px_80px_rgba(0,0,0,0.8)] relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-blue-500"></div>
            
            <div class="flex justify-between items-center mb-6 pb-6 border-b border-white/10">
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Pembayaran</p>
                    <p class="text-2xl sm:text-3xl font-black text-cyan-400" id="payment-total">Rp -</p>
                </div>
                <div class="w-16 h-10 bg-white rounded-lg p-1.5 flex items-center justify-center shadow-inner">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png" class="max-w-full max-h-full object-contain" alt="QRIS">
                </div>
            </div>

            <div class="flex flex-col items-center justify-center py-4">
                <div id="qr-container" class="bg-white p-4 rounded-2xl shadow-[0_0_40px_rgba(34,211,238,0.2)] mb-6 relative overflow-hidden transition-all duration-500 w-[232px] h-[232px]">
                    <img id="qr-img" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=GameVault-Dummy-Payment" alt="QR Code" class="w-full h-full rounded-lg transition-opacity duration-300">
                    
                    {{-- Scanner line animation --}}
                    <div id="qr-scan-line" class="absolute top-4 left-4 right-4 h-1 bg-cyan-400/80 shadow-[0_0_15px_#22d3ee] z-10 rounded-full" style="animation: scan 2.5s ease-in-out infinite alternate;"></div>

                    {{-- Success Icon (Hidden initially) --}}
                    <div id="success-icon" class="hidden absolute inset-0 bg-emerald-500 flex flex-col items-center justify-center transition-all duration-500 scale-90 opacity-0">
                        <svg class="w-24 h-24 text-white drop-shadow-lg mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-white font-bold text-sm tracking-wide">BERHASIL</span>
                    </div>
                </div>

                <div id="status-box" class="flex items-center gap-3 text-sm text-gray-300 bg-white/5 px-5 py-2.5 rounded-full border border-white/10 transition-all duration-300">
                    <div id="status-dot" class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse transition-colors duration-300"></div>
                    <span id="status-text">Menunggu Pembayaran...</span>
                </div>
                
                {{-- Payment ID (Hidden initially) --}}
                <div id="payment-id" class="hidden mt-5 text-center">
                    <p class="text-[11px] text-gray-400 uppercase tracking-widest font-semibold mb-1.5">No. ID Transaksi</p>
                    <p class="text-sm font-black text-white bg-[#1e2433] px-4 py-1.5 rounded-lg border border-white/5 shadow-inner">TRX-...</p>
                </div>

                <p id="helper-text" class="text-center text-xs text-gray-500 mt-5 max-w-[250px] transition-opacity duration-300">Pembayaran akan dikonfirmasi otomatis setelah berhasil di-scan.</p>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ url('/') }}" class="block w-full py-4 rounded-xl border border-white/10 text-center text-gray-400 font-bold text-sm hover:bg-white/5 hover:text-white transition-all">
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dummyTotal = localStorage.getItem('gv_checkout_total') || 'Rp 50.000';
            document.getElementById('payment-total').textContent = dummyTotal;

            // Simulate automatic success after 5 seconds
            setTimeout(() => {
                // Hide QR and show success overlay inside the box
                document.getElementById('qr-img').style.opacity = '0';
                document.getElementById('qr-scan-line').style.display = 'none';
                
                const successIcon = document.getElementById('success-icon');
                successIcon.classList.remove('hidden');
                setTimeout(() => {
                    document.getElementById('qr-container').classList.remove('p-4');
                    successIcon.classList.remove('scale-90', 'opacity-0');
                    successIcon.classList.add('scale-100', 'opacity-100');
                }, 50);

                // Update Status Pill
                const statusBox = document.getElementById('status-box');
                statusBox.classList.replace('bg-white/5', 'bg-emerald-500/20');
                statusBox.classList.replace('border-white/10', 'border-emerald-500/30');
                statusBox.classList.replace('text-gray-300', 'text-emerald-400');
                
                const dot = document.getElementById('status-dot');
                dot.classList.replace('bg-amber-400', 'bg-emerald-400');
                dot.classList.remove('animate-pulse');
                
                const txt = document.getElementById('status-text');
                txt.textContent = 'Pembayaran Sukses!';
                txt.classList.add('font-bold');

                // Generate and Show Transaction ID
                const randomId = 'TRX-' + Math.random().toString(36).substr(2, 9).toUpperCase();
                document.querySelector('#payment-id p:last-child').textContent = randomId;
                document.getElementById('payment-id').classList.remove('hidden');

                // Change helper text
                const helper = document.getElementById('helper-text');
                helper.style.opacity = '0';
                setTimeout(() => {
                    helper.textContent = 'Pesanan kamu sedang diproses dan akan segera dikirimkan. Terima kasih!';
                    helper.classList.add('text-emerald-500/80');
                    helper.style.opacity = '1';
                }, 300);

            }, 5000);
        });
    </script>
</body>
</html>
