import { useMemo, useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import ImageWithSkeleton from '../Components/ImageWithSkeleton';
import { GameGridSkeleton } from '../Components/Skeleton';

export default function Games({ games = [], categories = [], activeCategory = null }) {
    const [search, setSearch] = useState('');
    const [loading, setLoading] = useState(false);

    const filtered = useMemo(
        () => games.filter((g) => g.name.toLowerCase().includes(search.toLowerCase().trim())),
        [search, games]
    );

    const goToCategory = (category) => {
        setLoading(true);
        router.get(category ? `/games?category=${category}` : '/games', {}, {
            preserveScroll: true,
            onFinish: () => setLoading(false),
        });
    };

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden pt-20" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title="WarGame | All Games">
                <meta name="description" content="Jelajahi semua game yang tersedia untuk top up di WarGame — Mobile Legends, Free Fire, PUBG Mobile, dan ratusan game lainnya." />
                <meta property="og:title" content="WarGame | All Games" />
                <meta property="og:description" content="Jelajahi semua game yang tersedia untuk top up di WarGame." />
            </Head>
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

                            {categories.length > 0 && (
                                <div className="mt-4 flex flex-wrap items-center justify-center gap-2">
                                    <button
                                        onClick={() => goToCategory(null)}
                                        className={`px-4 py-1.5 rounded-full text-xs font-bold border transition-colors ${!activeCategory ? 'bg-green-500 border-green-400 text-white' : 'bg-white/5 border-white/10 text-gray-300 hover:bg-white/10'}`}
                                    >
                                        Semua
                                    </button>
                                    {categories.map((cat) => (
                                        <button
                                            key={cat.slug}
                                            onClick={() => goToCategory(cat.slug)}
                                            className={`px-4 py-1.5 rounded-full text-xs font-bold border transition-colors ${activeCategory === cat.slug ? 'bg-green-500 border-green-400 text-white' : 'bg-white/5 border-white/10 text-gray-300 hover:bg-white/10'}`}
                                        >
                                            {cat.name}
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {loading ? (
                            <GameGridSkeleton />
                        ) : filtered.length > 0 ? (
                            <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-4">
                                {filtered.map((game) => (
                                    <Link key={game.id} href={`/topup/${game.id}`} className="block">
                                        <article className="relative rounded-lg overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 hover:border-green-500/50 group transition-all duration-300 h-full">
                                            <ImageWithSkeleton
                                                src={game.image}
                                                alt={game.name}
                                                className="w-full pb-[133.33%] bg-[#1a1f2e]"
                                                imgClassName="absolute inset-0 w-full h-full object-cover"
                                            />
                                            <div className="p-3">
                                                {game.badge && <div className={`inline-block px-2 py-0.5 rounded-full text-white text-[10px] font-bold ${game.badgeStyle}`}>{game.badge}</div>}
                                                <h3 className="mt-2 text-sm font-extrabold line-clamp-1">{game.name}</h3>
                                            </div>
                                        </article>
                                    </Link>
                                ))}
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
