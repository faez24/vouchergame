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
                        <h1 class="text-2xl font-black text-white">Selamat Datang Kembali</h1>
                        <p class="text-gray-400 text-sm mt-1.5">Masuk untuk melanjutkan top up favoritmu</p>
                    </div>

                    {{-- Social Login --}}
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button id="btn-google" class="social-btn flex items-center justify-center gap-2.5 py-2.5 rounded-xl text-sm font-semibold text-gray-200">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#EA4335" d="M5.27 9.77A7.5 7.5 0 0 1 12 4.5c1.96 0 3.73.73 5.08 1.92l3.78-3.78A12 12 0 0 0 12 0C7.37 0 3.36 2.55 1.23 6.3l4.04 3.47Z"/>
                                <path fill="#34A853" d="M16.04 18.01A7.48 7.48 0 0 1 12 19.5a7.5 7.5 0 0 1-6.72-4.23L1.22 18.7A12 12 0 0 0 12 24c3.06 0 5.96-1.1 8.15-3.08l-4.11-2.91Z"/>
                                <path fill="#FBBC05" d="M19.5 12c0-.67-.07-1.32-.18-1.95H12v3.72h4.23a3.6 3.6 0 0 1-1.57 2.36l4.1 2.9C20.4 17.23 19.5 14.8 19.5 12Z"/>
                                <path fill="#4285F4" d="M5.28 14.27A7.43 7.43 0 0 1 4.5 12c0-.8.14-1.57.38-2.3L.85 6.23A12 12 0 0 0 0 12c0 1.97.48 3.83 1.32 5.47l3.96-3.2Z"/>
                            </svg>
                            Google
                        </button>
                        <button id="btn-discord" class="social-btn flex items-center justify-center gap-2.5 py-2.5 rounded-xl text-sm font-semibold text-gray-200">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#5865F2">
                                <path d="M20.32 4.37A19.8 19.8 0 0 0 15.56 3c-.21.38-.46.9-.63 1.3a18.27 18.27 0 0 0-5.86 0C8.9 3.9 8.64 3.38 8.43 3A19.74 19.74 0 0 0 3.67 4.38C.53 9.15-.32 13.8.1 18.38a19.9 19.9 0 0 0 6.07 3.07c.49-.67.93-1.38 1.3-2.13a12.97 12.97 0 0 1-2.05-1c.17-.12.34-.25.5-.38a14.15 14.15 0 0 0 12.16 0l.5.38c-.65.39-1.34.72-2.05 1 .37.75.81 1.46 1.3 2.13a19.84 19.84 0 0 0 6.08-3.07c.5-5.22-.84-9.74-3.59-13.01ZM8.02 15.67c-1.26 0-2.3-1.16-2.3-2.6s1.01-2.61 2.3-2.61c1.28 0 2.33 1.17 2.3 2.61 0 1.44-1.02 2.6-2.3 2.6Zm7.96 0c-1.26 0-2.3-1.16-2.3-2.6s1.02-2.61 2.3-2.61c1.28 0 2.33 1.17 2.3 2.61 0 1.44-1.01 2.6-2.3 2.6Z"/>
                            </svg>
                            Discord
                        </button>
                    </div>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3 mb-6">
                        <div class="divider-line"></div>
                        <span class="text-gray-500 text-xs font-medium whitespace-nowrap">atau masuk dengan email</span>
                        <div class="divider-line"></div>
                    </div>

                    {{-- Form --}}
                    <form id="login-form" onsubmit="handleLogin(event)" class="space-y-4">

                        <div>
                            <label for="email" class="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">Email</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <input id="email" type="email" placeholder="nama@email.com" required
                                    class="input-field w-full rounded-xl pl-10 pr-4 py-3 text-white text-sm placeholder-gray-600">
                            </div>
                            <p id="email-error" class="hidden text-pink-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01"/></svg>
                                Format email tidak valid
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="block text-gray-400 text-xs font-semibold uppercase tracking-wider">Password</label>
                                <a href="#" class="text-cyan-400 text-xs hover:text-cyan-300 transition-colors">Lupa password?</a>
                            </div>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                <input id="password" type="password" placeholder="Minimal 8 karakter" required
                                    class="input-field w-full rounded-xl pl-10 pr-12 py-3 text-white text-sm placeholder-gray-600">
                                <button type="button" id="toggle-pass" class="eye-toggle absolute right-3.5 top-1/2 -translate-y-1/2" onclick="togglePassword()">
                                    <svg id="eye-icon" class="w-4 h-4 text-gray-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            <p id="pass-error" class="hidden text-pink-500 text-xs mt-1.5">Password minimal 8 karakter</p>
                        </div>

                        <div class="flex items-center gap-2.5 pt-1">
                            <input id="remember" type="checkbox" class="w-4 h-4 rounded accent-cyan-400 cursor-pointer">
                            <label for="remember" class="text-gray-400 text-sm cursor-pointer select-none">Ingat saya</label>
                        </div>

                        <button id="btn-login" type="submit"
                            class="btn-login w-full py-3.5 rounded-xl text-white font-black text-sm tracking-wider mt-2 flex items-center justify-center gap-2">
                            <span id="btn-text">MASUK SEKARANG</span>
                            <svg id="btn-spinner" class="hidden w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.37 0 0 5.37 0 12h4z"></path>
                            </svg>
                        </button>

                    </form>

                    {{-- Register link --}}
                    <p class="text-center text-sm text-gray-500 mt-6">
                        Belum punya akun?
                        <a href="{{ url('/register') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">Daftar gratis</a>
                    </p>

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
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }

        function handleLogin(e) {
            e.preventDefault();
            let valid = true;

            const email = document.getElementById('email').value.trim();
            const pass = document.getElementById('password').value;
            const emailErr = document.getElementById('email-error');
            const passErr = document.getElementById('pass-error');

            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                emailErr.classList.remove('hidden');
                valid = false;
            } else {
                emailErr.classList.add('hidden');
            }

            // Validate password
            if (pass.length < 8) {
                passErr.classList.remove('hidden');
                valid = false;
            } else {
                passErr.classList.add('hidden');
            }

            if (!valid) return;

            // Show loading state
            const btn = document.getElementById('btn-login');
            const btnText = document.getElementById('btn-text');
            const spinner = document.getElementById('btn-spinner');
            btn.disabled = true;
            btn.style.opacity = '0.7';
            btnText.textContent = 'Memproses...';
            spinner.classList.remove('hidden');

            // Simulate API call
            setTimeout(() => {
                btn.disabled = false;
                btn.style.opacity = '1';
                btnText.textContent = 'MASUK SEKARANG';
                spinner.classList.add('hidden');
                showToast('✅', 'Login berhasil! Mengarahkan...');
                setTimeout(() => { window.location.href = '/'; }, 1500);
            }, 1800);
        }

        function showToast(icon, msg) {
            const t = document.getElementById('toast');
            document.getElementById('toast-icon').textContent = icon;
            document.getElementById('toast-msg').textContent = msg;
            t.classList.remove('hidden');
            clearTimeout(window._toastTimer);
            window._toastTimer = setTimeout(() => t.classList.add('hidden'), 3000);
        }

        // Social button placeholders
        document.getElementById('btn-google').addEventListener('click', () => showToast('🔧', 'Login Google belum tersedia'));
        document.getElementById('btn-discord').addEventListener('click', () => showToast('🔧', 'Login Discord belum tersedia'));
    </script>
</body>
</html>
