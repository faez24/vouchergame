import { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';

const myVouchers = [
    { id: 1, value: '20%', label: 'Diskon', title: 'Diskon Top Up MLBB', desc: 'Maksimal diskon Rp 25.000. Berlaku hingga 30 Mei 2026.', color: 'orange', cta: 'Gunakan Sekarang', href: '/topup/mobile-legends' },
    { id: 2, value: '10k', label: 'Potongan', title: 'Potongan Harga Steam', desc: 'Minimal transaksi Rp 50.000. Berlaku hingga 15 Jun 2026.', color: 'green', cta: 'Gunakan Sekarang', href: '/cart' },
];

const claimable = [
    { id: 1, tag: 'Terbatas', time: '12 Jam Lagi', title: 'Cashback 50% OVO', desc: 'Dapatkan cashback 50% hingga 20.000 OVO Points untuk setiap pembelian voucher game.', terms: ['Khusus pengguna baru', 'Metode pembayaran OVO', 'Kuota terbatas tiap hari'], color: 'green' },
    { id: 2, tag: 'Event Spesial', time: '3 Hari Lagi', title: 'Diskon 10% All Games', desc: 'Nikmati potongan langsung 10% tanpa minimum pembelian untuk semua produk.', terms: ['Berlaku untuk semua game', 'Maks. potongan Rp 50.000', 'Hanya dapat diklaim 1x'], color: 'orange' },
    { id: 3, tag: 'Pengguna Baru', time: null, title: 'Welcome Bonus Rp 5k', desc: 'Khusus untuk kamu yang baru mendaftar di WarGame. Langsung dapat potongan.', terms: ['Min. transaksi Rp 20.000', 'Hanya untuk akun baru (max 7 hari)'], color: 'purple' },
];

const colorMap = {
    green: { text: 'text-green-400', border: 'border-green-500/30', bg: 'bg-green-500/10', hoverBorder: 'hover:border-green-500/30', tagBg: 'bg-green-500/10' },
    orange: { text: 'text-orange-400', border: 'border-orange-500/30', bg: 'bg-orange-500/10', hoverBorder: 'hover:border-orange-500/30', tagBg: 'bg-orange-500/10' },
    purple: { text: 'text-purple-400', border: 'border-purple-500/30', bg: 'bg-purple-500/10', hoverBorder: 'hover:border-purple-500/30', tagBg: 'bg-purple-500/10' },
};

export default function Voucher() {
    const [tab, setTab] = useState('voucher-saya');
    const [claimed, setClaimed] = useState([]);
    const [toast, setToast] = useState(null);

    const claim = (item) => {
        setClaimed((prev) => [...prev, item.id]);
        setToast(item.title);
        setTimeout(() => setToast(null), 3000);
    };

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title="WarGame | Voucher">
                <meta name="description" content="Klaim voucher diskon top up game dan gunakan untuk hemat setiap transaksi di WarGame." />
                <meta property="og:title" content="WarGame | Voucher" />
                <meta property="og:description" content="Klaim voucher diskon top up game dan gunakan untuk hemat setiap transaksi." />
            </Head>
            <div className="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
                <Navbar />
                <SmokeBackground />

                <div className="relative z-10 flex flex-col flex-grow pt-24 sm:pt-32 pb-12">
                    <main className="mx-auto w-full max-w-[1440px] px-3 sm:px-4 lg:px-6 flex-grow">
                        <div className="mb-8 pb-4 border-b border-white/5 relative">
                            <div className="absolute -bottom-[1px] left-0 w-32 h-[1px] bg-gradient-to-r from-green-400 to-transparent" />
                            <h1 className="text-3xl sm:text-4xl font-black uppercase italic tracking-wider text-white drop-shadow-md">Voucher</h1>
                        </div>

                        <div className="lg:hidden mb-8 flex items-center justify-center gap-4 max-w-sm mx-auto">
                            <button onClick={() => setTab('voucher-saya')} className={`text-[13px] tracking-widest uppercase font-bold transition-opacity ${tab === 'voucher-saya' ? 'text-white opacity-100' : 'text-gray-400 opacity-50'}`}>Voucher Saya</button>
                            <span className="text-white/20 font-black italic text-lg select-none">/</span>
                            <button onClick={() => setTab('klaim-voucher')} className={`text-[13px] tracking-widest uppercase font-bold transition-opacity ${tab === 'klaim-voucher' ? 'text-white opacity-100' : 'text-gray-400 opacity-50'}`}>Klaim Voucher</button>
                        </div>

                        <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start relative">
                            <div className="hidden lg:block absolute left-1/2 top-0 bottom-0 w-[1px] -translate-x-1/2 pointer-events-none opacity-60" style={{ background: 'linear-gradient(to bottom, transparent, #4ade80, #ec4899, transparent)' }} />

                            <section className={`lg:col-span-6 ${tab === 'klaim-voucher' ? 'hidden lg:block' : ''}`}>
                                <div className="mb-5 hidden lg:flex items-center gap-3">
                                    <div className="w-1.5 h-1.5 bg-orange-500 rotate-45 animate-pulse" />
                                    <h2 className="text-xl font-black text-white uppercase tracking-widest">Voucher Saya</h2>
                                </div>
                                <div className="space-y-4">
                                    {myVouchers.map((v) => {
                                        const c = colorMap[v.color];
                                        return (
                                            <div key={v.id} className={`relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 flex items-stretch group ${c.hoverBorder} transition-all duration-300`}>
                                                <div className={`w-2 bg-gradient-to-b ${v.color === 'orange' ? 'from-orange-500 to-purple-600' : 'from-green-400 to-green-700'}`} />
                                                <div className="w-24 sm:w-32 bg-[#1a1f2e] border-r border-dashed border-white/10 flex flex-col items-center justify-center p-3">
                                                    <span className={`text-2xl sm:text-3xl font-black ${c.text}`}>{v.value}</span>
                                                    <span className="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">{v.label}</span>
                                                </div>
                                                <div className="p-4 flex-grow flex flex-col justify-center">
                                                    <div className="flex justify-between items-start mb-1">
                                                        <h3 className="text-base sm:text-lg font-extrabold text-white">{v.title}</h3>
                                                        <span className="px-2 py-0.5 rounded text-[10px] font-bold bg-green-500/20 text-green-400 border border-green-500/30">Aktif</span>
                                                    </div>
                                                    <p className="text-[11px] sm:text-xs text-gray-400 mb-3">{v.desc}</p>
                                                    <Link href={v.href} className={`inline-flex items-center gap-2 px-4 py-1.5 sm:py-2 rounded-lg text-white text-[11px] sm:text-xs font-bold transition-all ${v.color === 'orange' ? 'bg-orange-500 hover:bg-orange-400' : 'bg-green-500 hover:bg-green-400'}`}>
                                                        {v.cta}
                                                    </Link>
                                                </div>
                                            </div>
                                        );
                                    })}
                                </div>
                            </section>

                            <section className={`lg:col-span-6 ${tab === 'voucher-saya' ? 'hidden lg:block' : ''}`}>
                                <div className="mb-5 hidden lg:flex items-center gap-3">
                                    <div className="w-1.5 h-1.5 bg-green-400 rotate-45 animate-pulse" />
                                    <h2 className="text-xl font-black text-white uppercase tracking-widest">Klaim Voucher</h2>
                                </div>
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    {claimable.map((v) => {
                                        const c = colorMap[v.color];
                                        const isClaimed = claimed.includes(v.id);
                                        return (
                                            <div key={v.id} className={`relative rounded-xl overflow-hidden bg-[#161920]/80 backdrop-blur-md border border-white/5 p-5 flex flex-col justify-between group ${c.hoverBorder} transition-all duration-300`}>
                                                <div>
                                                    <div className="flex items-start justify-between mb-3">
                                                        <div className={`inline-block px-2.5 py-1 rounded-md ${c.tagBg} border ${c.border} ${c.text} text-[10px] font-bold`}>{v.tag}</div>
                                                        {v.time && <span className="text-xs font-bold text-gray-500">{v.time}</span>}
                                                    </div>
                                                    <h3 className="text-base font-extrabold text-white mb-2">{v.title}</h3>
                                                    <p className="text-xs text-gray-400 line-clamp-2 mb-3">{v.desc}</p>
                                                    <div className="bg-black/30 rounded p-3 mb-4 border border-white/5">
                                                        <h4 className="text-[10px] font-bold text-gray-300 uppercase tracking-wider mb-1">Syarat & Ketentuan:</h4>
                                                        <ul className="text-[10px] text-gray-400 list-disc list-outside ml-3 space-y-1">
                                                            {v.terms.map((t) => <li key={t}>{t}</li>)}
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div className="pt-2 border-t border-white/5">
                                                    <button
                                                        onClick={() => !isClaimed && claim(v)}
                                                        disabled={isClaimed}
                                                        className={isClaimed
                                                            ? 'w-full py-2.5 bg-gray-800 text-gray-500 border border-gray-700 rounded-lg text-xs font-black uppercase tracking-widest cursor-not-allowed opacity-70'
                                                            : `w-full py-2.5 border ${c.border} ${c.bg} ${c.text} hover:bg-opacity-100 rounded-lg text-xs font-black uppercase tracking-widest transition-all`}
                                                    >
                                                        {isClaimed ? 'Diklaim' : 'Klaim Voucher'}
                                                    </button>
                                                </div>
                                            </div>
                                        );
                                    })}
                                </div>
                            </section>
                        </div>
                    </main>

                    <Footer />
                </div>
            </div>

            {toast && (
                <div className="fixed bottom-8 left-1/2 -translate-x-1/2 z-[999]">
                    <div className="bg-[#161920]/95 backdrop-blur-sm border border-cyan-500/50 text-white px-6 py-3 rounded-lg text-sm font-semibold shadow-[0_4px_20px_rgba(0,0,0,0.5)] flex items-center gap-3">
                        <div className="flex items-center justify-center w-6 h-6 bg-cyan-500/20 text-green-400 rounded-full">
                            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="3"><path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <p className="text-xs text-gray-300 leading-none mb-1">Berhasil Klaim</p>
                            <p className="text-sm font-bold text-white leading-none">{toast}</p>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
