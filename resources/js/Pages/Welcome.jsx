import { useState } from 'react';
import { Head } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';

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
        <div className="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden relative bg-noise flex flex-col" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title={`${appName} | Top Up Game & Voucher Digital`} />
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

            <Navbar />
            <SmokeBackground />

                <div className="relative z-10">
                    <div className="mb-6 w-full">
                        <section className="relative w-full bg-transparent overflow-hidden aspect-[4/3] sm:aspect-[16/9] lg:aspect-[21/9] min-h-[350px] md:min-h-[480px] lg:min-h-[580px]">
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

                    <Footer />
                </div>
        </div>
    );
}
