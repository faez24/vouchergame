import { Head, Link } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import ImageWithSkeleton from '../Components/ImageWithSkeleton';

const formatRupiah = (value) => `Rp ${Number(value ?? 0).toLocaleString('id-ID')}`;

export default function Welcome({
    appName,
    message,
    popularGames = [],
    flashDeals = [],
    categories = [],
    entertainmentProducts = [],
    newestProducts = [],
    voucherProducts = [],
}) {
    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden relative bg-noise flex flex-col" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title={`${appName} | Top Up Game & Voucher Digital`}>
                <meta name="description" content={message || 'Marketplace game top up dan voucher digital dengan tampilan premium dark.'} />
                <meta property="og:title" content={`${appName} | Top Up Game & Voucher Digital`} />
                <meta property="og:description" content={message || 'Marketplace game top up dan voucher digital dengan tampilan premium dark.'} />
            </Head>
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
                @keyframes marquee-scroll { 0% { transform: translate3d(0,0,0); } 100% { transform: translate3d(-50%,0,0); } }
                .marquee-track { animation: marquee-scroll 30s linear infinite; }
            `}</style>

            <Navbar />
            <SmokeBackground />

                <div className="relative z-10">
                    <div className="mb-6 w-full">
                        <section className="relative w-full bg-transparent overflow-hidden aspect-[4/3] sm:aspect-[16/9] lg:aspect-[21/9] min-h-[350px] md:min-h-[480px] lg:min-h-[580px]">
                            <div className="absolute inset-0" style={{ WebkitMaskImage: 'linear-gradient(to bottom, black 40%, transparent 100%)', maskImage: 'linear-gradient(to bottom, black 40%, transparent 100%)' }}>
                                <img src="/banner.png" alt="Hero Background" className="w-full h-full object-cover object-center opacity-60" />
                                <div className="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent" />
                            </div>

                            <div className="relative z-10 w-full max-w-[1440px] mx-auto h-full flex flex-col justify-end px-5 sm:px-10 md:px-16 lg:px-24 pt-20 pb-10 sm:pb-14">
                                <div className="hidden flex-row gap-2 sm:gap-4 w-fit">
                                    <a href="#games" className="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-green-400 text-white font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(34,197,94,0.6)] hover:bg-green-300 transition-colors text-center whitespace-nowrap">LIHAT GAMES</a>
                                    <a href="#voucher" className="px-3 sm:px-7 py-2 sm:py-2.5 rounded-full bg-orange-500 text-white font-bold text-[10px] sm:text-sm tracking-wider shadow-[0_0_12px_rgba(249,115,22,0.6)] hover:bg-orange-400 transition-colors text-center whitespace-nowrap">LIHAT VOUCHER</a>
                                </div>
                            </div>
                        </section>

                        <div className="mt-6 md:-mt-8 relative z-20 w-full max-w-[1440px] mx-auto px-3 sm:px-4 lg:px-6">
                            <div className="flex items-center justify-between mb-4 px-1">
                                <h3 className="text-base font-black text-green-400 uppercase tracking-widest flex items-center gap-2 drop-shadow-[0_0_8px_rgba(34,197,94,0.5)]"><span className="w-2.5 h-2.5 rounded-full bg-orange-500 animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]" />FLASH SALE</h3>
                            </div>

                            <div className="relative w-full group/slider overflow-visible">
                                <div id="flash-sale-slider" className="flex gap-3 sm:gap-6 overflow-x-auto px-1 sm:px-6 pt-4 pb-8 scrollbar-hide" style={{ scrollbarWidth: 'none', msOverflowStyle: 'none' }}>
                                    {flashDeals.map((deal) => (
                                        <Link href={`/topup/${deal.id}`} key={deal.id} className="shrink-0 w-[calc(33.333%-0.5rem)] sm:w-[calc(33.333%-1rem)]">
                                            <div className="bg-[#1c2030] border border-white/10 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.6)] hover:shadow-[0_0_30px_rgba(34,211,238,0.25)] hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 h-full">
                                                <ImageWithSkeleton
                                                    src={deal.image}
                                                    alt={deal.title}
                                                    className="h-28 sm:h-32 bg-[#1a1f2e]"
                                                    imgClassName="w-full h-full object-cover opacity-70"
                                                />
                                                <div className="p-3 flex flex-col items-center text-center">
                                                    <h4 className="font-bold text-[11px] text-gray-300">{deal.title}</h4>
                                                    <p className="font-black text-white text-xs mt-0.5">{deal.subtitle}</p>
                                                    <div className="mt-2 w-full h-px bg-white/5" />
                                                    <div className="mt-1.5 flex flex-col items-center">
                                                        <span className="text-green-400 font-black text-xs drop-shadow-[0_0_5px_rgba(34,197,94,0.5)]">{formatRupiah(deal.price)}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </Link>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>

                    <main id="home" className="mx-auto w-full max-w-[1440px] px-3 pb-12 sm:px-4 lg:px-6">
                        <section className="mt-6">
                            <div className="flex items-center justify-center gap-3 mb-5">
                                <h2 className="text-sm font-bold text-gray-400 uppercase tracking-wider">Populer Games</h2>
                            </div>
                            {popularGames.length > 0 && (
                                <div className="relative overflow-hidden rounded-xl border border-white/10 bg-black/30 backdrop-blur-md py-4" style={{ WebkitMaskImage: 'linear-gradient(to right, transparent, black 6%, black 94%, transparent)', maskImage: 'linear-gradient(to right, transparent, black 6%, black 94%, transparent)' }}>
                                    <div className="marquee-track flex w-max gap-4 sm:gap-5 px-4">
                                        {[...popularGames, ...popularGames].map((game, idx) => (
                                            <Link
                                                href={`/topup/${game.id}`}
                                                key={`${game.id}-${idx}`}
                                                title={game.name}
                                                className="shrink-0 w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden border border-white/10 hover:border-green-400/60 hover:-translate-y-1 transition-all duration-200 shadow-[0_6px_16px_rgba(0,0,0,0.5)]"
                                            >
                                                <ImageWithSkeleton src={game.image} alt={game.name} className="w-full h-full" imgClassName="w-full h-full object-cover" />
                                            </Link>
                                        ))}
                                    </div>
                                </div>
                            )}
                        </section>

                        <section className="mt-8">
                            <div className="mb-5 flex items-end justify-between border-b border-white/5 pb-3">
                                <div className="flex items-center gap-3">
                                    <div className="flex flex-col justify-center items-center gap-1">
                                        <div className="w-1.5 h-1.5 bg-orange-500 rotate-45 animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]" />
                                        <div className="w-0.5 h-6 bg-gradient-to-b from-orange-500 to-transparent" />
                                    </div>
                                    <div>
                                        <p className="text-[10px] font-bold text-orange-500 uppercase tracking-[0.2em] mb-0.5">Jelajahi</p>
                                        <h2 className="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Kategori</h2>
                                    </div>
                                </div>
                            </div>

                            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
                                {categories.map((cat) => (
                                    <Link
                                        href={`/games?category=${cat.slug}`}
                                        key={cat.slug}
                                        className="relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 hover:border-green-500/50 group transition-all duration-300 block aspect-[4/3]"
                                    >
                                        <ImageWithSkeleton
                                            src={cat.image}
                                            alt={cat.name}
                                            className="absolute inset-0 w-full h-full"
                                            imgClassName="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-70 group-hover:scale-105 transition-all duration-300"
                                        />
                                        <div className="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent" />
                                        <div className="absolute inset-x-0 bottom-0 p-3">
                                            <h3 className="text-sm sm:text-base font-black text-white">{cat.name}</h3>
                                            <p className="text-[11px] text-gray-300">{cat.count} produk</p>
                                        </div>
                                    </Link>
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
                                {popularGames.slice(0, 10).map((game) => (
                                    <Link href={`/topup/${game.id}`} key={game.id} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300 block">
                                        <ImageWithSkeleton src={game.image} alt={game.name} className="card-img-wrap bg-[#1a1f2e]" imgClassName="absolute inset-0 w-full h-full object-cover" />
                                        <div className="p-3 bg-transparent">
                                            {game.badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${game.badgeStyle}`}>{game.badge}</div> : null}
                                            <h3 className="mt-2 text-sm font-extrabold">{game.name}</h3>
                                        </div>
                                    </Link>
                                ))}
                            </div>

                            <div className="mt-6 flex justify-center">
                                <Link href="/games" className="group flex items-center gap-2 text-sm font-bold text-orange-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(249,115,22,0.8)]">
                                    <span>Lihat Semua</span>
                                    <svg className="w-4 h-4 transition-transform group-hover:translate-x-1 text-orange-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </Link>
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
                                        <h2 className="text-xl sm:text-2xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Entertainment</h2>
                                    </div>
                                </div>
                            </div>

                            <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                                {entertainmentProducts.map((item) => (
                                    <Link href={`/topup/${item.id}`} key={item.id} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300 block">
                                        <ImageWithSkeleton src={item.image} alt={item.name} className="card-img-wrap" imgClassName="absolute inset-0 w-full h-full object-cover" />
                                        <div className="p-3 bg-transparent">
                                            {item.badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${item.badgeStyle}`}>{item.badge}</div> : null}
                                            <h3 className="mt-2 text-sm font-extrabold">{item.name}</h3>
                                        </div>
                                    </Link>
                                ))}
                            </div>

                            <div className="mt-6 flex justify-center">
                                <Link href="/games?category=entertainment" className="group flex items-center gap-2 text-sm font-bold text-green-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(34,197,94,0.8)]">
                                    <span>Lihat Semua</span>
                                    <svg className="w-4 h-4 transition-transform group-hover:translate-x-1 text-green-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </Link>
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
                                {newestProducts.map((item) => (
                                    <Link href={`/topup/${item.id}`} key={item.id} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300 block">
                                        <ImageWithSkeleton src={item.image} alt={item.name} className="card-img-wrap bg-[#1a1f2e]" imgClassName="absolute inset-0 w-full h-full object-cover" />
                                        <div className="p-3 bg-transparent">
                                            <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(34,197,94,0.6)] ${item.badgeStyle}`}>{item.badge}</div>
                                            <h3 className="mt-2 text-sm font-extrabold">{item.name}</h3>
                                        </div>
                                    </Link>
                                ))}
                            </div>

                            <div className="mt-6 flex justify-center">
                                <Link href="/games" className="group flex items-center gap-2 text-sm font-bold text-orange-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(249,115,22,0.8)]">
                                    <span>Lihat Semua</span>
                                    <svg className="w-4 h-4 transition-transform group-hover:translate-x-1 text-orange-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </Link>
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
                                {voucherProducts.map((item) => (
                                    <Link href={`/topup/${item.id}`} key={item.id} className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 card-3d hover:border-green-500/50 group transition-all duration-300 block">
                                        <ImageWithSkeleton src={item.image} alt={item.name} className="card-img-wrap" imgClassName="absolute inset-0 w-full h-full object-cover" />
                                        <div className="p-3 bg-transparent">
                                            {item.badge ? <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold shadow-[0_0_8px_rgba(249,115,22,0.6)] ${item.badgeStyle}`}>{item.badge}</div> : null}
                                            <h3 className="mt-2 text-sm font-extrabold">{item.name}</h3>
                                        </div>
                                    </Link>
                                ))}
                            </div>

                            <div className="mt-6 flex justify-center">
                                <Link href="/games?category=voucher" className="group flex items-center gap-2 text-sm font-bold text-green-400 uppercase tracking-widest transition-all hover:text-white hover:drop-shadow-[0_0_8px_rgba(34,197,94,0.8)]">
                                    <span>Lihat Semua</span>
                                    <svg className="w-4 h-4 transition-transform group-hover:translate-x-1 text-green-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M9 5l7 7-7 7" /></svg>
                                </Link>
                            </div>
                        </section>
                    </main>

                    <Footer />
                </div>
        </div>
    );
}
