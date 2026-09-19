import { useMemo, useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';

const games = [
    { name: 'Mobile Legends', href: '/topup/mobile-legends', image: 'https://images.unsplash.com/photo-1556438064-2d7646166914?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Free Fire', image: 'https://images.unsplash.com/photo-1560253023-3ec5d502959f?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'PUBG Mobile', image: 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Genshin Impact', image: 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
    { name: 'Valorant', image: 'https://images.unsplash.com/photo-1615680022647-99c397cbcaea?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Honkai Star Rail', image: 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
    { name: 'Call of Duty Mobile', image: 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Apex Legends', image: 'https://images.unsplash.com/photo-1536240478700-b869ad10f984?w=600&h=800&fit=crop', badge: '' },
    { name: 'League of Legends', image: 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop', badge: '' },
    { name: 'Clash of Clans', image: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop', badge: '' },
    { name: 'Fortnite', image: 'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&h=800&fit=crop', badge: 'Populer', badgeStyle: 'bg-orange-500' },
    { name: 'Wuthering Waves', image: 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
    { name: 'Solo Leveling Arise', image: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
    { name: 'Zenless Zone Zero', image: 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=800&fit=crop', badge: 'Baru', badgeStyle: 'bg-green-500' },
];

export default function Games() {
    const [search, setSearch] = useState('');

    const filtered = useMemo(
        () => games.filter((g) => g.name.toLowerCase().includes(search.toLowerCase().trim())),
        [search]
    );

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden pt-20" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title="WarGame | All Games" />
            <div className="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
                <Navbar />
                <SmokeBackground variant="compact" />

                <div className="relative z-10 flex-1">
                    <main className="mx-auto w-full max-w-[1440px] px-3 pb-12 sm:px-4 lg:px-6 pt-10">
                        <div className="mb-8">
                            <h1 className="text-3xl sm:text-4xl font-black uppercase italic tracking-wider text-white drop-shadow-md text-center mb-6">Semua Games</h1>
                            <div className="max-w-md mx-auto relative group">
                                <div className="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg className="w-5 h-5 text-gray-400 group-focus-within:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                                <input
                                    type="text"
                                    value={search}
                                    onChange={(e) => setSearch(e.target.value)}
                                    className="bg-[#161920]/80 border border-white/10 text-white text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-12 p-3.5 backdrop-blur-md transition-all placeholder-gray-400"
                                    placeholder="Cari game favoritmu..."
                                />
                            </div>
                        </div>

                        {filtered.length > 0 ? (
                            <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-4">
                                {filtered.map((game) => {
                                    const Card = (
                                        <article className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 hover:border-green-500/50 group transition-all duration-300 h-full">
                                            <div className="relative w-full pb-[133.33%] overflow-hidden bg-[#1a1f2e]">
                                                <img src={game.image} alt={game.name} className="absolute inset-0 w-full h-full object-cover" />
                                            </div>
                                            <div className="p-3">
                                                {game.badge && <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold ${game.badgeStyle}`}>{game.badge}</div>}
                                                <h3 className="mt-2 text-sm font-extrabold line-clamp-1">{game.name}</h3>
                                            </div>
                                        </article>
                                    );
                                    return game.href ? (
                                        <Link key={game.name} href={game.href} className="block">{Card}</Link>
                                    ) : (
                                        <div key={game.name} className="block cursor-pointer">{Card}</div>
                                    );
                                })}
                            </div>
                        ) : (
                            <div className="text-center py-20">
                                <svg className="mx-auto h-16 w-16 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 className="text-xl font-bold text-white mb-2">Game tidak ditemukan</h3>
                                <p className="text-gray-400 text-sm">Coba cari dengan kata kunci lain.</p>
                            </div>
                        )}
                    </main>
                </div>

                <Footer />
            </div>
        </div>
    );
}
