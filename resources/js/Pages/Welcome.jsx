import { useState } from 'react';

const shortcutItems = [
    { name: 'Mobile Legends', short: 'ML', gradient: 'linear-gradient(135deg, #f97316, #ea580c)' },
    { name: 'Free Fire', short: 'FF', gradient: 'linear-gradient(135deg, #16a34a, #15803d)' },
    { name: 'Valorant', short: 'V', gradient: 'linear-gradient(135deg, #ef4444, #dc2626)' },
    { name: 'Genshin', short: 'GI', gradient: 'linear-gradient(135deg, #8b5cf6, #7c3aed)' },
    { name: 'PUBG', short: 'PB', gradient: 'linear-gradient(135deg, #f59e0b, #d97706)' },
    { name: 'Steam', short: 'ST', gradient: 'linear-gradient(135deg, #475569, #1e293b)' },
    { name: 'Google Play', short: 'GP', gradient: 'linear-gradient(135deg, #22c55e, #16a34a)' },
    { name: 'PlayStation', short: 'PS', gradient: 'linear-gradient(135deg, #15803d, #14532d)' },
];

const flashDeals = [
    { title: 'Valorant', subtitle: '1120 VP', oldPrice: 'Rp 150.000', newPrice: 'Rp 120.000', badge: '20% OFF', image: 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=400&fit=crop', accent: '#22d3ee' },
    { title: 'Mobile Legends', subtitle: '86 Diamonds', oldPrice: 'Rp 25.000', newPrice: 'Rp 21.250', badge: '15% OFF', image: 'https://images.unsplash.com/photo-1556438064-2d7646166914?w=400&h=400&fit=crop', accent: '#f472b6' },
    { title: 'Free Fire', subtitle: '355 Diamonds', oldPrice: 'Rp 50.000', newPrice: 'Rp 45.000', badge: '10% OFF', image: 'https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=400&h=400&fit=crop', accent: '#67e8f9' },
    { title: 'Genshin Impact', subtitle: 'Welkin Moon', oldPrice: 'Rp 80.000', newPrice: 'Rp 60.000', badge: '25% OFF', image: 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=400&h=400&fit=crop', accent: '#f472b6' },
    { title: 'PUBG Mobile', subtitle: '325 UC', oldPrice: 'Rp 75.000', newPrice: 'Rp 52.500', badge: '30% OFF', image: 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=400&fit=crop', accent: '#22d3ee' },
];

const popularGames = [
    { name: 'Mobile Legends', image: 'https://images.unsplash.com/photo-1556438064-2d7646166914?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Free Fire', image: 'https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'PUBG Mobile', image: 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Genshin Impact', image: 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
    { name: 'Valorant', image: 'https://images.unsplash.com/photo-1615680022647-99c397cbcaea?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Honkai Star Rail', image: 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
    { name: 'Call of Duty Mobile', image: 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Apex Legends', image: 'https://images.unsplash.com/photo-1536240478700-b869ad10f984?w=600&h=800&fit=crop', badge: '', badgeStyle: '' },
    { name: 'League of Legends', image: 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop', badge: '', badgeStyle: '' },
    { name: 'Clash of Clans', image: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop', badge: '', badgeStyle: '' },
    { name: 'Fortnite', image: 'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
];

const voucherItems = [
    { name: 'Steam Wallet', image: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop', badge: 'Promo', badgeStyle: 'bg-orange-500' },
    { name: 'Google Play', image: 'https://images.unsplash.com/photo-1542751110-97427bbecf20?w=600&h=800&fit=crop', badge: '', badgeStyle: '' },
    { name: 'PlayStation Network', image: 'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop', badge: '', badgeStyle: '' },
    { name: 'Xbox Game Pass', image: 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop', badge: '', badgeStyle: '' },
    { name: 'Garena Shells', image: 'https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
];

export default function Welcome({ appName, message }) {
    const [expanded, setExpanded] = useState(false);

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <style>{`
                .bg-noise { background-image: radial-gradient(rgba(255,255,255,0.025) 0.8px, transparent 0.8px); background-size: 18px 18px; }
                .card-img-wrap { position: relative; width: 100%; padding-bottom: 100%; overflow: hidden; }
                .card-img-wrap img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
                .card-3d {
                    box-shadow: 0 2px 0 rgba(255,255,255,0.07) inset, 0 -1px 0 rgba(0,0,0,0.5) inset, 6px 18px 30px rgba(0,0,0,0.7), 12px 30px 50px rgba(0,0,0,0.4);
                    transform: perspective(800px) rotateX(1deg);
                }
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
                @keyframes slide-smoke { 0% { background-position: 0 0; } 100% { background-position: -200vw 0; } }
                .moving-smoke-1 { position: absolute; top: 0; left: 0; width: 300%; height: 100%; background-image: url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog1.png'); background-repeat: repeat-x; background-size: cover; opacity: 0.9; filter: brightness(1.2) contrast(1.2); animation: slide-smoke 60s linear infinite; mix-blend-mode: screen; }
                .moving-smoke-2 { position: absolute; top: 0; left: 0; width: 300%; height: 100%; background-image: url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog2.png'); background-repeat: repeat-x; background-size: cover; opacity: 0.8; filter: brightness(1.2) contrast(1.2); animation: slide-smoke 40s linear infinite; mix-blend-mode: screen; }
                .games-extra-grid { display: grid; grid-template-rows: 0fr; opacity: 0; transition: grid-template-rows 0.45s cubic-bezier(.4,0,.2,1), opacity 0.35s ease, margin-top 0.35s ease; margin-top: 0; }
                .games-extra-grid.expanded { grid-template-rows: 1fr; opacity: 1; margin-top: 0.5rem; }
                .games-extra-grid > div { overflow: hidden; }
                .btn-lihat-semua .arrow-icon { transition: transform 0.3s cubic-bezier(.4,0,.2,1); }
                .btn-lihat-semua.expanded .arrow-icon { transform: rotate(90deg); }
                @keyframes card-pop { from { opacity: 0; transform: translateY(14px) scale(0.97); } to { opacity: 1; transform: translateY(0) scale(1); } }
                .games-extra-grid.expanded article { animation: card-pop 0.35s ease forwards; }
                .games-extra-grid.expanded article:nth-child(1) { animation-delay: 0.05s; }
                .games-extra-grid.expanded article:nth-child(2) { animation-delay: 0.10s; }
                .games-extra-grid.expanded article:nth-child(3) { animation-delay: 0.15s; }
                .games-extra-grid.expanded article:nth-child(4) { animation-delay: 0.20s; }
                .games-extra-grid.expanded article:nth-child(5) { animation-delay: 0.25s; }
                .games-extra-grid.expanded article:nth-child(6) { animation-delay: 0.30s; }
            `}</style>

            <div className="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
                <header id="navbar" className="fixed top-0 z-50 w-full bg-transparent transition-all duration-300 border-b border-transparent">
                    <div className="mx-auto flex w-full max-w-[1440px] items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                        <a href="/" className="flex items-center gap-3">
                            <span className="hidden h-11 w-11 place-items-center rounded-2xl bg-gradient-to-r from-green-400 to-green-600 text-[15px] font-extrabold tracking-tight text-white shadow-[0_0_15px_rgba(34,197,94,0.5)] md:grid">GV</span>
                            <span className="text-[1.6rem] font-bold tracking-tight text-white drop-shadow">{appName}</span>
                        </a>

                        <nav className="hidden items-center gap-8 md:flex">
                            <a href="/" className="desktop-nav-link relative text-sm font-bold transition-colors text-gray-300 hover:text-white group py-1">
                                Home
                                <span className="absolute bottom-0 left-0 h-[2px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left" />
                            </a>
                            <a href="/games" className="desktop-nav-link relative text-sm font-bold transition-colors text-gray-300 hover:text-white group py-1">
                                Games
                                <span className="absolute bottom-0 left-0 h-[2px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left" />
                            </a>
                            <a href="/voucher" className="desktop-nav-link relative text-sm font-bold transition-colors text-gray-300 hover:text-white group py-1">
                                Voucher
                                <span className="absolute bottom-0 left-0 h-[2px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left" />
                            </a>
                        </nav>

                        <div className="flex items-center gap-3 sm:gap-4">
                            <button aria-label="Search" className="p-2 hover:bg-white/5 rounded-lg transition-colors">
                                <svg viewBox="0 0 24 24" className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" strokeWidth="2">
                                    <circle cx="11" cy="11" r="7" />
                                    <path d="m20 20-3.5-3.5" />
                                </svg>
                            </button>

                            <a href="/cart" aria-label="Keranjang" className="hidden md:flex relative items-center justify-center w-10 h-10 rounded-xl border border-white/10 bg-white/[0.04] hover:border-green-500/50 hover:bg-green-500/10 hover:shadow-[0_0_12px_rgba(34,197,94,0.2)] transition-all group">
                                <svg viewBox="0 0 24 24" className="w-[22px] h-[22px] text-gray-300 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                                    <circle cx="9" cy="21" r="1" />
                                    <circle cx="20" cy="21" r="1" />
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                </svg>
                                <span className="absolute -top-1.5 -right-1.5 min-w-[18px] h-[18px] px-1 rounded-full bg-orange-500 text-white text-[10px] font-black flex items-center justify-center shadow-[0_0_8px_rgba(249,115,22,0.8)] border border-[#344050]">0</span>
                            </a>

                            <div className="relative" id="user-menu-container">
                                <a href="/login" className="hidden md:inline-block px-5 py-2 bg-orange-500 hover:bg-orange-400 rounded-lg text-white text-sm font-bold transition-all shadow-[0_0_15px_rgba(249,115,22,0.5)]">Masuk</a>
                                <button className="user-menu-button md:hidden relative flex items-center justify-center w-8 h-8 rounded-full border border-white/10 bg-white/[0.04] text-gray-300 hover:text-white hover:bg-white/10 transition-colors focus:outline-none" aria-label="User menu">
                                    <svg viewBox="0 0 24 24" className="w-[18px] h-[18px]" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </button>
                            </div>

                            <button id="mobile-menu-btn" aria-label="Menu" className="md:hidden relative p-2 text-gray-300 hover:text-white transition-colors">
                                <svg viewBox="0 0 24 24" className="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                    <line x1="3" y1="12" x2="21" y2="12" />
                                    <line x1="3" y1="6" x2="21" y2="6" />
                                    <line x1="3" y1="18" x2="21" y2="18" />
                                </svg>
                                <span className="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full bg-orange-500 text-white text-[10px] font-black flex items-center justify-center shadow-[0_0_8px_rgba(249,115,22,0.8)] border border-[#344050]">0</span>
                            </button>
                        </div>
                    </div>
                </header>

                <div id="mobile-menu-overlay" className="fixed inset-0 bg-black/60 backdrop-blur-sm z-[55] hidden transition-opacity duration-300 opacity-0 md:hidden" />

                <div id="mobile-menu" className="fixed top-0 right-0 h-screen w-[280px] bg-[#050810] border-l border-white/5 shadow-[-10px_0_30px_rgba(0,0,0,0.8)] z-[60] transform translate-x-full transition-transform duration-300 md:hidden flex flex-col">
                    <div className="flex items-center justify-between p-5 border-b border-white/10">
                        <span className="text-white font-bold text-lg">Menu</span>
                        <button id="close-menu-btn" aria-label="Tutup Menu" className="p-2 text-gray-400 hover:text-white transition-colors rounded-lg hover:bg-white/5">
                            <svg className="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24" strokeLinecap="round" strokeLinejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </div>

                    <nav className="flex flex-col p-6 gap-8 overflow-y-auto">
                        <a href="/" className="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                            <span className="italic font-bold text-white text-[1.3rem]">Home</span>
                            <span className="underline-bar h-[3px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full mt-1.5 opacity-0 transition-all duration-300" />
                        </a>
                        <a href="/cart" className="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                            <div className="flex items-center gap-3">
                                <span className="italic font-bold text-white text-[1.3rem]">Cart</span>
                                <span id="mobile-cart-badge" className="hidden min-w-[22px] h-[22px] px-1 rounded-full bg-orange-500 text-white text-xs font-black flex items-center justify-center shadow-[0_0_8px_rgba(249,115,22,0.8)]">0</span>
                            </div>
                            <span className="underline-bar h-[3px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full mt-1.5 opacity-0 transition-all duration-300" />
                        </a>
                        <a href="/voucher" className="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                            <div className="flex items-center gap-3">
                                <span className="italic font-bold text-white text-[1.3rem]">Voucher</span>
                                <span id="mobile-voucher-badge" className="hidden min-w-[22px] h-[22px] px-1 rounded-full bg-orange-500 text-white text-xs font-black flex items-center justify-center shadow-[0_0_8px_rgba(249,115,22,0.8)]">0</span>
                            </div>
                            <span className="underline-bar h-[3px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full mt-1.5 opacity-0 transition-all duration-300" />
                        </a>
                        <a href="/games" className="mobile-nav-link opacity-60 flex flex-col w-max group transition-opacity duration-300">
                            <span className="italic font-bold text-white text-[1.3rem]">Games</span>
                            <span className="underline-bar h-[3px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full mt-1.5 opacity-0 transition-all duration-300" />
                        </a>
                    </nav>
                </div>

                <div className="pointer-events-none fixed inset-0 overflow-hidden z-0">
                    <div className="moving-smoke-1" />
                    <div className="moving-smoke-2" />
                    <div className="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60" />
                    <div className="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/50" />
                    <div className="smoke-a absolute top-[-5%] left-[-20%] w-[80vw] h-[70vw] max-w-[1000px] max-h-[800px] rounded-full bg-slate-500/15 blur-[120px]" />
                    <div className="smoke-b absolute top-[25%] right-[-25%] w-[90vw] h-[80vw] max-w-[1100px] max-h-[900px] rounded-full bg-slate-400/12 blur-[140px]" />
                    <div className="smoke-c absolute bottom-[5%] left-[5%] w-[70vw] h-[60vw] max-w-[900px] max-h-[700px] rounded-full bg-slate-600/12 blur-[110px]" />
                    <div className="smoke-d absolute top-[55%] left-[25%] w-[55vw] h-[45vw] max-w-[750px] max-h-[600px] rounded-full bg-slate-500/10 blur-[100px]" />
                    <div className="smoke-b absolute top-[10%] left-[40%] w-[40vw] h-[35vw] max-w-[550px] max-h-[450px] rounded-full bg-slate-300/8 blur-[80px]" />
                    <div className="smoke-a absolute bottom-[30%] right-[10%] w-[45vw] h-[38vw] max-w-[600px] max-h-[500px] rounded-full bg-slate-400/8 blur-[90px]" />
                    <div className="smoke-e absolute top-[20%] left-[8%] w-[25vw] h-[25vw] max-w-[350px] max-h-[350px] rounded-full bg-green-400/5 blur-[70px]" />
                    <div className="smoke-c absolute bottom-[15%] right-[8%] w-[30vw] h-[30vw] max-w-[400px] max-h-[400px] rounded-full bg-orange-400/4 blur-[80px]" />
                    <div className="smoke-d absolute top-[45%] right-[30%] w-[20vw] h-[20vw] max-w-[280px] max-h-[280px] rounded-full bg-green-500/5 blur-[60px]" />
                </div>

                <div className="relative z-10">
                    <div className="mb-6 w-full pt-20">
                        <section className="relative w-full bg-transparent overflow-hidden aspect-[4/3] sm:aspect-[16/9] lg:aspect-[21/9] min-h-[250px] md:min-h-[400px] lg:min-h-[500px]">
                            <div className="absolute inset-0" style={{ WebkitMaskImage: 'linear-gradient(to bottom, black 40%, transparent 100%)', maskImage: 'linear-gradient(to bottom, black 40%, transparent 100%)' }}>
                                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=2070&auto=format&fit=crop" alt="Hero Background" className="w-full h-full object-cover object-center opacity-60" />
                                <div className="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent" />
                            </div>

                            <div className="relative z-10 w-full max-w-[1440px] mx-auto h-full flex flex-col justify-center px-5 sm:px-10 md:px-16 lg:px-24 pt-20 pb-6">
                                <h1 className="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-white tracking-tighter leading-none drop-shadow-[0_0_15px_rgba(255,255,255,0.4)]">WAR</h1>
                                <h2 className="text-xl sm:text-3xl md:text-5xl font-bold tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-orange-500 mt-0.5">GAME</h2>
                                <p className="text-xs sm:text-base md:text-xl text-gray-300 font-light tracking-wide mt-1">{message}</p>

                                <div className="hidden mt-4 sm:mt-6 flex-row gap-2 sm:gap-4 w-fit">
                                    <a href="#games" className="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-green-400 text-white font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(34,197,94,0.6)] hover:bg-green-300 transition-colors text-center whitespace-nowrap">LIHAT GAMES</a>
                                    <a href="#voucher" className="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-orange-500 text-white font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(249,115,22,0.6)] hover:bg-orange-400 transition-colors text-center whitespace-nowrap">LIHAT VOUCHER</a>
                                </div>
                            </div>
                        </section>

                        <div className="mt-6 md:-mt-20 relative z-20 w-full max-w-[1440px] mx-auto px-3 sm:px-4 lg:px-6">
                            <div className="flex items-center justify-between mb-4 px-1">
                                <h3 className="text-base font-black text-green-400 uppercase tracking-widest flex items-center gap-2 drop-shadow-[0_0_8px_rgba(34,197,94,0.5)]"><span className="w-2.5 h-2.5 rounded-full bg-orange-500 animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]" />FLASH SALE</h3>
                            </div>

                            <div className="relative w-full group/slider overflow-visible">
                                <div id="flash-sale-slider" className="flex gap-3 sm:gap-6 overflow-x-auto px-1 sm:px-6 pt-4 pb-12 scrollbar-hide snap-x snap-mandatory" style={{ scrollbarWidth: 'none', msOverflowStyle: 'none' }}>
                                    {flashDeals.map((deal) => (
                                        <div key={deal.title} className="shrink-0 snap-center w-[calc(33.333%-0.5rem)] sm:w-[calc(33.333%-1rem)] cursor-pointer">
                                            <div className="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full">
                                                <div className="h-28 sm:h-32 bg-[#1a1f2e] relative overflow-hidden">
                                                    <img src={deal.image} className="w-full h-full object-cover opacity-70" alt={deal.title} />
                                                    <div className="absolute top-2 right-2 bg-orange-500 text-white text-[9px] sm:text-[10px] font-black px-1.5 py-0.5 rounded-md shadow-[0_0_8px_rgba(249,115,22,0.8)]">{deal.badge}</div>
                                                </div>
                                                <div className="p-3 flex flex-col items-center text-center">
                                                    <h4 className="font-bold text-[11px] text-gray-300">{deal.title}</h4>
                                                    <p className="font-black text-white text-xs mt-0.5">{deal.subtitle}</p>
                                                    <div className="mt-2 w-full h-px bg-white/5" />
                                                    <div className="mt-1.5 flex flex-col items-center">
                                                        <span className="text-[9px] text-gray-500 line-through">{deal.oldPrice}</span>
                                                        <span className="text-green-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,197,94,0.5)]">{deal.newPrice}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>

                    <main id="home" className="mx-auto w-full max-w-[1440px] px-3 pb-12 sm:px-4 lg:px-6">
                        <section className="mt-6">
                            <div className="flex items-center lg:justify-center gap-3 mb-4">
                                <h2 className="text-sm font-bold text-gray-400 uppercase tracking-wider">Populer Games</h2>
                                <div className="flex-1 lg:hidden h-px bg-gradient-to-r from-white/10 to-transparent" />
                            </div>
                            <div className="flex gap-4 overflow-x-auto lg:justify-center pb-3 scrollbar-hide snap-x snap-mandatory" style={{ scrollbarWidth: 'none', msOverflowStyle: 'none' }}>
                                {shortcutItems.map((item) => (
                                    <a key={item.name} href={item.name === 'Mobile Legends' ? '/topup/mobile-legends' : '#'} className="group flex flex-col items-center gap-2 flex-shrink-0 snap-start">
                                        <div className="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl grid place-items-center shadow-[0_8px_15px_rgba(0,0,0,0.5),0_0_10px_rgba(249,115,22,0.3)] transition-all duration-300 ring-2 ring-transparent group-hover:ring-orange-400/50" style={{ background: item.gradient }}>
                                            <span className="text-white font-black text-lg">{item.short}</span>
                                        </div>
                                        <span className="text-[11px] text-gray-400 group-hover:text-white font-semibold transition-colors">{item.name}</span>
                                    </a>
                                ))}
                            </div>
                        </section>

                        <section className="mt-8">
                            <div className="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                                <div className="flex items-center gap-3">
                                    <div className="flex flex-col justify-center items-center gap-1">
                                        <div className="w-1.5 h-1.5 bg-orange-500 rotate-45 animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]" />
                                        <div className="w-0.5 h-6 bg-gradient-to-b from-orange-500 to-transparent" />
                                    </div>
                                    <div>
                                        <p className="text-[10px] font-bold text-orange-500 uppercase tracking-[0.2em] mb-0.5">Top Picks</p>
                                        <h2 className="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Game Populer</h2>
                                    </div>
                                </div>
                            </div>

                            <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                                {popularGames.slice(0, 5).map((game, idx) => (
                                    <article key={game.name + idx} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300">
                                        <div className="card-img-wrap bg-[#1a1f2e]"><img src={game.image} alt={game.name} /></div>
                                        <div className="p-3 bg-transparent">
                                            {game.badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${game.badgeStyle}`}>{game.badge}</div> : null}
                                            <h3 className="mt-2 text-sm font-extrabold">{game.name}</h3>
                                        </div>
                                    </article>
                                ))}
                                {popularGames[5] ? (
                                    <article className="relative lg:hidden rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300">
                                        <div className="card-img-wrap bg-[#1a1f2e]"><img src={popularGames[5].image} alt={popularGames[5].name} /></div>
                                        <div className="p-3 bg-transparent">
                                            {popularGames[5].badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${popularGames[5].badgeStyle}`}>{popularGames[5].badge}</div> : null}
                                            <h3 className="mt-2 text-sm font-extrabold">{popularGames[5].name}</h3>
                                        </div>
                                    </article>
                                ) : null}
                            </div>

                            <div className={`games-extra-grid ${expanded ? 'expanded' : ''}`}>
                                <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                                    {popularGames.slice(6).map((game, idx) => (
                                        <article key={game.name + idx} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300">
                                            <div className="card-img-wrap bg-[#1a1f2e]"><img src={game.image} alt={game.name} /></div>
                                            <div className="p-3 bg-transparent">
                                                {game.badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${game.badgeStyle}`}>{game.badge}</div> : null}
                                                <h3 className="mt-2 text-sm font-extrabold">{game.name}</h3>
                                            </div>
                                        </article>
                                    ))}
                                </div>
                            </div>

                            <div className="mt-6 flex justify-center">
                                <button
                                    type="button"
                                    onClick={() => setExpanded((prev) => !prev)}
                                    className={`btn-lihat-semua group flex items-center gap-2 text-sm font-bold uppercase tracking-widest transition-all hover:drop-shadow-[0_0_8px_rgba(249,115,22,0.8)] cursor-pointer bg-transparent border-none outline-none ${expanded ? 'expanded' : ''}`}
                                    style={{ color: expanded ? '#ffffff' : '#f59e0b' }}
                                >
                                    <span>{expanded ? 'Tutup' : 'Lihat Semua'}</span>
                                    <svg className="arrow-icon w-4 h-4 text-orange-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            </div>
                        </section>

                        <section className="mt-8">
                            <div className="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                                <div className="flex items-center gap-3">
                                    <div className="flex flex-col justify-center items-center gap-1">
                                        <div className="w-1.5 h-1.5 bg-green-400 rotate-45 animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.8)]" />
                                        <div className="w-0.5 h-6 bg-gradient-to-b from-green-400 to-transparent" />
                                    </div>
                                    <div>
                                        <p className="text-[10px] font-bold text-green-400 uppercase tracking-[0.2em] mb-0.5">Kategori Lain</p>
                                        <h2 className="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Web Store</h2>
                                    </div>
                                </div>
                            </div>

                            <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                                {[{ name: 'Steam Wallet', image: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop', badge: 'Promo', badgeStyle: 'bg-orange-500' }, { name: 'PlayStation Network', image: 'https://images.unsplash.com/photo-1542751110-97427bbecf20?w=600&h=800&fit=crop', badge: '', badgeStyle: '' }, { name: 'Xbox Game Pass', image: 'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop', badge: '', badgeStyle: '' }, { name: 'Razer Gold', image: 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop', badge: '', badgeStyle: '' }, { name: 'Google Play', image: 'https://images.unsplash.com/photo-1589241062272-c0a000072dfa?w=600&h=800&fit=crop', badge: '', badgeStyle: '' }].map((item) => (
                                    <article key={item.name} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300">
                                        <div className="card-img-wrap"><img src={item.image} alt={item.name} /></div>
                                        <div className="p-3 bg-transparent">
                                            {item.badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${item.badgeStyle}`}>{item.badge}</div> : null}
                                            <h3 className="mt-2 text-sm font-extrabold">{item.name}</h3>
                                        </div>
                                    </article>
                                ))}
                            </div>

                            <div className="mt-6 flex justify-center">
                                <a href="#footer" className="group flex items-center gap-2 text-sm font-bold text-green-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(34,197,94,0.8)]">
                                    <span>Lihat Semua</span>
                                    <svg className="w-4 h-4 transition-transform group-hover:translate-x-1 text-green-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </a>
                            </div>
                        </section>

                        <section className="mt-8">
                            <div className="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                                <div className="flex items-center gap-3">
                                    <div className="flex flex-col justify-center items-center gap-1">
                                        <div className="w-1.5 h-1.5 bg-orange-500 rotate-45 animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]" />
                                        <div className="w-0.5 h-6 bg-gradient-to-b from-orange-500 to-transparent" />
                                    </div>
                                    <div>
                                        <p className="text-[10px] font-bold text-orange-500 uppercase tracking-[0.2em] mb-0.5">Fresh Drops</p>
                                        <h2 className="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Baru Ditambahkan</h2>
                                    </div>
                                </div>
                            </div>

                            <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                                {[
                                    { name: 'Wuthering Waves', image: 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
                                    { name: 'Solo Leveling Arise', image: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
                                    { name: 'Zenless Zone Zero', image: 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
                                ].map((item) => (
                                    <article key={item.name} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300">
                                        <div className="card-img-wrap bg-[#1a1f2e]"><img src={item.image} alt={item.name} /></div>
                                        <div className="p-3 bg-transparent">
                                            <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(34,197,94,0.6)] ${item.badgeStyle}`}>{item.badge}</div>
                                            <h3 className="mt-2 text-sm font-extrabold">{item.name}</h3>
                                        </div>
                                    </article>
                                ))}
                            </div>

                            <div className="mt-6 flex justify-center">
                                <a href="#footer" className="group flex items-center gap-2 text-sm font-bold text-orange-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(249,115,22,0.8)]">
                                    <span>Lihat Semua</span>
                                    <svg className="w-4 h-4 transition-transform group-hover:translate-x-1 text-orange-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </a>
                            </div>
                        </section>

                        <section id="voucher" className="mt-8">
                            <div className="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                                <div className="flex items-center gap-3">
                                    <div className="flex flex-col justify-center items-center gap-1">
                                        <div className="w-1.5 h-1.5 bg-green-400 rotate-45 animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.8)]" />
                                        <div className="w-0.5 h-6 bg-gradient-to-b from-green-400 to-transparent" />
                                    </div>
                                    <div>
                                        <p className="text-[10px] font-bold text-green-400 uppercase tracking-[0.2em] mb-0.5">Best Deals</p>
                                        <h2 className="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Voucher Populer</h2>
                                    </div>
                                </div>
                            </div>

                            <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                                {voucherItems.map((item) => (
                                    <article key={item.name} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300">
                                        <div className="card-img-wrap"><img src={item.image} alt={item.name} /></div>
                                        <div className="p-3 bg-transparent">
                                            {item.badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${item.badgeStyle}`}>{item.badge}</div> : null}
                                            <h3 className="mt-2 text-sm font-extrabold">{item.name}</h3>
                                        </div>
                                    </article>
                                ))}
                            </div>

                            <div className="mt-6 flex justify-center">
                                <a href="#footer" className="group flex items-center gap-2 text-sm font-bold text-green-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(34,197,94,0.8)]">
                                    <span>Lihat Semua</span>
                                    <svg className="w-4 h-4 transition-transform group-hover:translate-x-1 text-green-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </a>
                            </div>
                        </section>
                    </main>

                    <footer id="footer" className="mt-16 border-t border-white/5 relative w-full bg-cover bg-center bg-no-repeat" style={{ backgroundImage: "url('/images/footer.png')" }}>
                        <div className="absolute inset-0 bg-[#050810]/70 backdrop-blur-sm z-0" />
                        <div className="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none" />
                        <div className="absolute bottom-0 left-0 w-80 h-80 bg-green-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4 pointer-events-none" />

                        <div className="max-w-[1440px] mx-auto w-full px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16 pb-6">
                            <div className="grid grid-cols-2 md:grid-cols-3 gap-8 lg:grid-cols-5 xl:gap-16 relative z-10">
                                <div className="col-span-2 md:col-span-3 lg:col-span-2">
                                    <a href="/" className="flex items-center gap-3 w-fit mb-6">
                                        <span className="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-green-400 to-green-700 text-sm font-extrabold tracking-tight text-white shadow-[0_0_15px_rgba(34,197,94,0.5)]">GV</span>
                                        <span className="text-2xl font-bold tracking-tight text-white drop-shadow">{appName}</span>
                                    </a>
                                    <p className="text-gray-400 text-sm leading-relaxed max-w-md mb-8">Platform top up game dan voucher digital terpercaya di Indonesia. Memberikan layanan instan, aman, dan harga terbaik untuk setiap transaksi Anda.</p>
                                    <div className="flex gap-3">
                                        {[['Facebook', 'M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z'], ['Instagram', 'M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z'], ['Twitter', 'M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z'], ['YouTube', 'M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17M10 15l5-3-5-3z']].map(([label, path], index) => (
                                            <a key={label} href="#" aria-label={label} className="w-10 h-10 rounded-xl bg-white/[0.03] hover:bg-green-500/10 hover:text-green-400 border border-white/5 hover:border-green-500/30 flex items-center justify-center transition-all duration-300 text-gray-400 hover:shadow-[0_0_10px_rgba(34,197,94,0.2)]">
                                                <svg viewBox="0 0 24 24" className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="2">
                                                    {path.includes('M18') ? <path d={path} /> : path.includes('M2.5') ? <><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17" /><path d="m10 15 5-3-5-3z" /></> : <path d={path} /> }
                                                </svg>
                                            </a>
                                        ))}
                                    </div>
                                </div>

                                <div className="col-span-1">
                                    <h3 className="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Bantuan</h3>
                                    <ul className="space-y-4">
                                        {['Cara Top Up', 'FAQ', 'Hubungi Kami', 'Syarat & Ketentuan'].map((item) => (
                                            <li key={item}><a href="#" className="text-gray-400 hover:text-green-400 transition-colors text-sm font-medium flex justify-between items-center group">{item}<svg viewBox="0 0 24 24" className="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg></a></li>
                                        ))}
                                    </ul>
                                </div>

                                <div className="col-span-1">
                                    <h3 className="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Game Populer</h3>
                                    <ul className="space-y-4">
                                        {['Mobile Legends', 'Free Fire', 'PUBG Mobile', 'Genshin Impact'].map((game, idx) => (
                                            <li key={game}><a href="#" className="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2"><span className={`w-1.5 h-1.5 rounded-full ${idx % 2 === 0 ? 'bg-green-500/50' : 'bg-orange-500/50'} shadow-[0_0_5px_rgba(34,197,94,0.8)]`} />{game}</a></li>
                                        ))}
                                    </ul>
                                </div>

                                <div className="col-span-2 sm:col-span-1">
                                    <h3 className="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Metode Pembayaran</h3>
                                    <div className="grid grid-cols-2 gap-2">
                                        {['DANA', 'OVO', 'GOPAY', 'QRIS', 'Virtual Account'].map((item, idx) => (
                                            <div key={item} className={`h-10 bg-white/[0.03] rounded-xl flex items-center justify-center border border-white/5 text-gray-300 text-xs font-bold hover:bg-white/[0.06] transition-colors cursor-default ${idx === 4 ? 'col-span-2' : ''}`}>{item}</div>
                                        ))}
                                    </div>
                                </div>
                            </div>

                            <div className="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4 relative z-10">
                                <p className="text-gray-500 text-sm font-medium">© 2026 {appName}. All rights reserved.</p>
                                <div className="flex items-center gap-6">
                                    <a href="#" className="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors">Privacy Policy</a>
                                    <a href="#" className="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors">Terms of Service</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    );
}
