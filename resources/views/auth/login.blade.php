<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk | GameVault</title>
    <meta name="description" content="Login ke akun GameVault kamu untuk top up game favorit dengan mudah dan aman.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
        }
    </script>

    <style>
        .bg-noise { background-image: radial-gradient(rgba(255,255,255,0.025) 0.8px, transparent 0.8px); background-size: 18px 18px; }

        @keyframes smoke-a { 0%{transform:translate(0,0) scale(1);opacity:.5} 33%{transform:translate(-40px,-25px) scale(1.1);opacity:.3} 66%{transform:translate(20px,-10px) scale(1.05);opacity:.4} 100%{transform:translate(0,0) scale(1);opacity:.5} }
        @keyframes smoke-b { 0%{transform:translate(0,0) scale(1);opacity:.4} 40%{transform:translate(30px,30px) scale(1.15);opacity:.2} 70%{transform:translate(-15px,10px) scale(0.95);opacity:.35} 100%{transform:translate(0,0) scale(1);opacity:.4} }
        @keyframes smoke-c { 0%{transform:translate(0,0) scale(1) rotate(0deg);opacity:.35} 50%{transform:translate(-25px,-40px) scale(1.08) rotate(3deg);opacity:.18} 100%{transform:translate(0,0) scale(1) rotate(0deg);opacity:.35} }
        .smoke-a { animation: smoke-a 14s ease-in-out infinite; }
        .smoke-b { animation: smoke-b 18s ease-in-out infinite; }
        .smoke-c { animation: smoke-c 22s ease-in-out infinite; }

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

        @keyframes float-card { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        .float-card { animation: float-card 6s ease-in-out infinite; }

        @keyframes glow-pulse { 0%,100%{box-shadow:0 0 30px rgba(34,211,238,0.2)} 50%{box-shadow:0 0 60px rgba(34,211,238,0.4),0 0 100px rgba(139,92,246,0.2)} }
        .card-glow { animation: glow-pulse 4s ease-in-out infinite; }

        .input-field {
            background: rgba(30,36,51,0.8);
            border: 1px solid rgba(255,255,255,0.08);
            transition: all 0.25s;
        }
        .input-field:focus {
            outline: none;
            border-color: rgba(34,211,238,0.5);
            box-shadow: 0 0 0 3px rgba(34,211,238,0.1);
            background: rgba(30,36,51,1);
        }

        .btn-login {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
        }
        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            opacity: 0;
            transition: opacity 0.25s;
        }
        .btn-login:hover::after { opacity: 1; }
        .btn-login span { position: relative; z-index: 1; }

        @keyframes modal-in { from{opacity:0;transform:translateY(20px) scale(0.97)} to{opacity:1;transform:translateY(0) scale(1)} }
        .card-appear { animation: modal-in 0.5s cubic-bezier(.4,0,.2,1) forwards; }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
        }

        .social-btn {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            transition: all 0.2s;
        }
        .social-btn:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.15);
            transform: translateY(-1px);
        }

        .eye-toggle { cursor: pointer; }
        .eye-toggle:hover svg { color: #22d3ee; }
    </style>
</head>
<body class="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden">

    <div class="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col items-center justify-center">

        {{-- Background Atmosphere --}}
        <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
            <div class="moving-smoke-1"></div>
            <div class="moving-smoke-2"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-black/60"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/50"></div>
            <div class="smoke-a absolute top-[-5%] left-[-20%] w-[80vw] h-[70vw] max-w-[1000px] max-h-[800px] rounded-full bg-slate-500/15 blur-[120px]"></div>
            <div class="smoke-b absolute top-[25%] right-[-25%] w-[90vw] h-[80vw] max-w-[1100px] max-h-[900px] rounded-full bg-slate-400/12 blur-[140px]"></div>
            <div class="smoke-c absolute bottom-[5%] left-[5%] w-[70vw] h-[60vw] max-w-[900px] max-h-[700px] rounded-full bg-slate-600/12 blur-[110px]"></div>
            {{-- Accent glows --}}
            <div class="smoke-a absolute top-[20%] left-[5%] w-[30vw] h-[30vw] max-w-[400px] max-h-[400px] rounded-full bg-cyan-400/6 blur-[80px]"></div>
            <div class="smoke-b absolute bottom-[10%] right-[5%] w-[30vw] h-[30vw] max-w-[400px] max-h-[400px] rounded-full bg-purple-500/6 blur-[80px]"></div>
        </div>

        {{-- Back link --}}
        <div class="relative z-10 w-full max-w-[440px] px-4 mb-6">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        {{-- Login Card --}}
        <div class="relative z-10 w-full max-w-[440px] px-4 pb-12">
            <div class="card-appear card-glow bg-[#1e2433]/90 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-[0_30px_80px_rgba(0,0,0,0.7)]">

                {{-- Top gradient bar --}}
                <div class="h-1 w-full" style="background:linear-gradient(90deg,#3b82f6,#8b5cf6,#ec4899)"></div>

                <div class="p-8">

                    {{-- Logo & Title --}}
                    <div class="text-center mb-8">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3 mb-5">
                            <span class="grid h-12 w-12 place-items-center rounded-2xl bg-gradient-to-r from-cyan-400 to-blue-500 text-[16px] font-extrabold tracking-tight text-black shadow-[0_0_20px_rgba(34,211,238,0.5)]">GV</span>
                            <span class="text-2xl font-bold tracking-tight text-white drop-shadow">GameVault</span>
                        </a>
                        <h1 class="text-2xl font-black text-white">Selamat Datang</h1>
                        <p class="text-gray-400 text-sm mt-1.5">Masuk untuk melanjutkan top up favoritmu</p>
                    </div>

                    {{-- Social Login --}}
                    <div class="mb-6">
                        <a href="{{ url('/auth/google') }}" id="btn-google" class="btn-login flex w-full items-center justify-center gap-3 py-3.5 rounded-xl text-sm font-semibold text-white tracking-wider cursor-pointer">
                            <span class="bg-white p-1 rounded-full relative z-10 flex items-center justify-center">
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="#EA4335" d="M5.27 9.77A7.5 7.5 0 0 1 12 4.5c1.96 0 3.73.73 5.08 1.92l3.78-3.78A12 12 0 0 0 12 0C7.37 0 3.36 2.55 1.23 6.3l4.04 3.47Z"/>
                                    <path fill="#34A853" d="M16.04 18.01A7.48 7.48 0 0 1 12 19.5a7.5 7.5 0 0 1-6.72-4.23L1.22 18.7A12 12 0 0 0 12 24c3.06 0 5.96-1.1 8.15-3.08l-4.11-2.91Z"/>
                                    <path fill="#FBBC05" d="M19.5 12c0-.67-.07-1.32-.18-1.95H12v3.72h4.23a3.6 3.6 0 0 1-1.57 2.36l4.1 2.9C20.4 17.23 19.5 14.8 19.5 12Z"/>
                                    <path fill="#4285F4" d="M5.28 14.27A7.43 7.43 0 0 1 4.5 12c0-.8.14-1.57.38-2.3L.85 6.23A12 12 0 0 0 0 12c0 1.97.48 3.83 1.32 5.47l3.96-3.2Z"/>
                                </svg>
                            </span>
                            <span class="relative z-10 font-black">MASUK DENGAN GOOGLE</span>
                        </a>
                    </div>
                    
                    {{-- Divider --}}
                </div>
            </div>

            {{-- Trust badges --}}
            <div class="flex items-center justify-center gap-6 mt-6">
                <div class="flex items-center gap-1.5 text-gray-500 text-[11px]">
                    <svg class="w-3.5 h-3.5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    SSL Terenkripsi
                </div>
                <div class="flex items-center gap-1.5 text-gray-500 text-[11px]">
                    <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Data Aman
                </div>
                <div class="flex items-center gap-1.5 text-gray-500 text-[11px]">
                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Proses Instan
                </div>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div id="toast" class="fixed top-6 left-1/2 -translate-x-1/2 z-[110] hidden transition-all">
        <div class="bg-[#252d40] border border-white/10 rounded-xl px-5 py-3 text-sm font-semibold text-white shadow-xl backdrop-blur-md flex items-center gap-2">
            <span id="toast-icon"></span>
            <span id="toast-msg"></span>
        </div>
    </div>

    <script>
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
