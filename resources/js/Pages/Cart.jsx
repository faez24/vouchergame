import { useEffect, useMemo, useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';
import { CartItemSkeleton } from '../Components/Skeleton';

function fmt(n) {
    return 'Rp ' + Number(n).toLocaleString('id-ID');
}

function getCart() {
    try {
        return JSON.parse(localStorage.getItem('gv_cart') || '[]');
    } catch {
        return [];
    }
}

function saveCart(cart) {
    localStorage.setItem('gv_cart', JSON.stringify(cart));
}

export default function Cart() {
    const [cart, setCart] = useState([]);
    const [loaded, setLoaded] = useState(false);
    const [checked, setChecked] = useState([]);
    const [activeFilter, setActiveFilter] = useState('All');
    const [modalStep, setModalStep] = useState(0); // 0 closed, 1 payment, 2 summary
    const [payMethod, setPayMethod] = useState(null);
    const [editItem, setEditItem] = useState(null);
    const [editUid, setEditUid] = useState('');
    const [editZone, setEditZone] = useState('');

    useEffect(() => {
        setCart(getCart());
        setLoaded(true);
    }, []);

    const games = useMemo(() => [...new Set(cart.map((i) => i.game))], [cart]);
    const filtered = activeFilter === 'All' ? cart : cart.filter((i) => i.game === activeFilter);
    const selected = cart.filter((i) => checked.includes(i.id));
    const total = selected.reduce((s, i) => s + i.priceNum, 0);

    const toggleCheck = (id) => {
        setChecked((prev) => (prev.includes(id) ? prev.filter((c) => c !== id) : [...prev, id]));
    };

    const toggleAll = () => {
        setChecked(checked.length === cart.length ? [] : cart.map((i) => i.id));
    };

    const removeItem = (id) => {
        const next = cart.filter((i) => i.id !== id);
        setCart(next);
        saveCart(next);
        setChecked((prev) => prev.filter((c) => c !== id));
    };

    const deleteSelected = () => {
        if (!checked.length) return;
        const next = cart.filter((i) => !checked.includes(i.id));
        setCart(next);
        saveCart(next);
        setChecked([]);
    };

    const openEdit = (item) => {
        setEditItem(item.id);
        setEditUid(item.userId);
        setEditZone(item.zoneId);
    };

    const saveEdit = () => {
        if (!editUid.trim() || !editZone.trim()) return;
        const next = cart.map((i) => (i.id === editItem ? { ...i, userId: editUid.trim(), zoneId: editZone.trim() } : i));
        setCart(next);
        saveCart(next);
        setEditItem(null);
    };

    const confirmPayment = () => {
        localStorage.setItem('gv_checkout_total', fmt(total));
        const remaining = cart.filter((i) => !checked.includes(i.id));
        saveCart(remaining);
        window.location.href = '/checkout';
    };

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title="Keranjang | WarGame">
                <meta name="robots" content="noindex, nofollow" />
            </Head>
            <div className="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
                <SmokeBackground variant="compact" />
                <Navbar />

                <div className="relative z-10 flex-1 max-w-[780px] mx-auto w-full px-4 pt-28 pb-36">
                    <div className="flex items-center gap-3 mb-6">
                        <Link href="/" className="p-2 rounded-xl hover:bg-white/5 transition-colors text-gray-400 hover:text-white">
                            <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-black text-white tracking-tight">Keranjang Belanja</h1>
                            <p className="text-gray-400 text-sm mt-0.5">{cart.length} item</p>
                        </div>
                    </div>

                    {!loaded ? (
                        <div className="space-y-3">
                            <CartItemSkeleton />
                            <CartItemSkeleton />
                            <CartItemSkeleton />
                        </div>
                    ) : cart.length === 0 ? (
                        <div className="flex flex-col items-center justify-center py-24 text-center">
                            <svg className="w-20 h-20 text-gray-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.2" strokeLinecap="round" strokeLinejoin="round"><path d="M6 2h12l2 5v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7l2-5z" /><path d="M9 7a3 3 0 006 0" /></svg>
                            <h2 className="text-white font-bold text-xl mb-2">Keranjang Kosong</h2>
                            <p className="text-gray-500 text-sm mb-8">Belum ada item yang ditambahkan ke keranjang</p>
                            <Link href="/topup/mobile-legends" className="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-green-700 hover:bg-green-600 text-white font-bold text-sm transition-all shadow-lg shadow-green-700/30">
                                Mulai Top Up
                            </Link>
                        </div>
                    ) : (
                        <>
                            {games.length > 1 && (
                                <div className="mb-4 flex gap-2 overflow-x-auto pb-2">
                                    {['All', ...games].map((g) => (
                                        <button key={g} onClick={() => setActiveFilter(g)} className={`px-4 py-1.5 rounded-full text-xs font-bold transition-all border whitespace-nowrap ${activeFilter === g ? 'bg-green-500/20 border-green-400 text-green-400' : 'bg-[#252d40] border-white/10 text-gray-400 hover:border-white/30'}`}>
                                            {g === 'All' ? 'Semua' : g}
                                        </button>
                                    ))}
                                </div>
                            )}

                            <div className="mb-4 flex items-center gap-3 bg-[#252d40]/80 backdrop-blur-md border border-white/8 rounded-2xl px-4 py-3">
                                <input type="checkbox" checked={checked.length === cart.length} onChange={toggleAll} className="w-5 h-5 accent-blue-500" />
                                <label className="text-white text-sm font-semibold cursor-pointer select-none flex-1" onClick={toggleAll}>Pilih Semua</label>
                                <button onClick={deleteSelected} className="text-red-400 hover:text-red-300 text-xs font-semibold transition-colors">Hapus Dipilih</button>
                            </div>

                            <div className="space-y-3">
                                {filtered.map((item) => (
                                    <div key={item.id} onClick={() => toggleCheck(item.id)} className={`cursor-pointer bg-[#252d40]/80 backdrop-blur-md border rounded-2xl p-4 flex items-center gap-3 transition-colors ${checked.includes(item.id) ? 'border-blue-500/50 bg-blue-500/[0.06]' : 'border-white/8'}`}>
                                        <input type="checkbox" checked={checked.includes(item.id)} onChange={() => toggleCheck(item.id)} onClick={(e) => e.stopPropagation()} className="w-5 h-5 accent-blue-500" />
                                        <div className="w-12 h-12 rounded-xl flex-shrink-0 grid place-items-center font-black text-lg text-white shadow-lg" style={{ background: `linear-gradient(135deg, ${item.gameColor || '#f97316'}, ${item.gameColor || '#f97316'}99)` }}>
                                            {item.gameId === 'ml' ? 'ML' : item.gameId.slice(0, 2).toUpperCase()}
                                        </div>
                                        <div className="flex-1 min-w-0">
                                            <div className="flex items-center gap-2 flex-wrap mb-0.5">
                                                <span className="text-white font-bold text-sm">{item.label}</span>
                                                <span className="px-2 py-0.5 rounded-full bg-green-600/15 text-green-500 text-[10px] font-bold border border-green-600/20">{item.game}</span>
                                            </div>
                                            <div className="flex items-center gap-2 mt-0.5">
                                                <p className="text-gray-500 text-[11px]">User ID: <span className="text-gray-300">{item.userId}</span> · Zone: <span className="text-gray-300">{item.zoneId}</span></p>
                                                <button onClick={(e) => { e.stopPropagation(); openEdit(item); }} className="text-green-400 hover:text-green-300 text-[10px] font-semibold underline">Edit</button>
                                            </div>
                                            <p className="text-amber-400 font-bold text-sm mt-1">{item.price}</p>
                                        </div>
                                        <button onClick={(e) => { e.stopPropagation(); removeItem(item.id); }} className="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-400 text-gray-500 flex items-center justify-center transition-all flex-shrink-0">
                                            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                ))}
                            </div>
                        </>
                    )}
                </div>

                <Footer />
            </div>

            {cart.length > 0 && (
                <div className="fixed bottom-0 left-0 w-full z-[80]">
                    <div className="bg-[#1e2433]/95 backdrop-blur-xl border-t border-white/10 shadow-[0_-8px_40px_rgba(0,0,0,0.7)]">
                        <div className="max-w-[780px] mx-auto px-4 py-3.5 flex items-center gap-4">
                            <div className="flex items-center gap-2.5 flex-1 min-w-0">
                                <input type="checkbox" checked={checked.length === cart.length} onChange={toggleAll} className="w-5 h-5 accent-blue-500 flex-shrink-0" />
                                <div className="min-w-0">
                                    <p className="text-gray-400 text-xs">{checked.length} item dipilih</p>
                                    <p className="text-white font-black text-lg leading-tight">{fmt(total)}</p>
                                </div>
                            </div>
                            <button onClick={() => checked.length > 0 && setModalStep(1)} disabled={checked.length === 0} className="px-7 py-3 rounded-xl text-white font-black text-sm disabled:opacity-40 disabled:cursor-not-allowed transition-all" style={{ background: 'linear-gradient(135deg,#3b82f6,#8b5cf6)' }}>
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {modalStep > 0 && (
                <div className="fixed inset-0 z-[110] flex items-center justify-center p-4">
                    <div className="absolute inset-0 bg-black/70 backdrop-blur-sm" onClick={() => setModalStep(0)} />
                    <div className="relative w-full max-w-md bg-[#1e2433] border border-white/10 rounded-3xl shadow-[0_30px_80px_rgba(0,0,0,0.8)] overflow-hidden">
                        <div className="h-1 w-full" style={{ background: 'linear-gradient(90deg,#3b82f6,#8b5cf6,#ec4899)' }} />
                        <div className="p-6">
                            {modalStep === 1 && (
                                <>
                                    <h3 className="text-white font-black text-lg mb-1">Metode Pembayaran</h3>
                                    <p className="text-gray-500 text-xs mb-5">Pilih cara pembayaran yang kamu inginkan</p>
                                    <div className="space-y-3">
                                        {['QRIS', 'GoPay', 'DANA'].map((m) => (
                                            <label key={m} className={`flex items-center gap-4 bg-[#252d40] border rounded-xl p-3.5 cursor-pointer transition-all ${payMethod === m ? 'border-green-500/60' : 'border-white/8 hover:border-green-500/40'}`}>
                                                <input type="radio" name="pay" checked={payMethod === m} onChange={() => setPayMethod(m)} className="accent-green-400 w-4 h-4 flex-shrink-0" />
                                                <p className="text-white font-bold text-sm flex-1">{m}</p>
                                            </label>
                                        ))}
                                    </div>
                                    <button onClick={() => payMethod && setModalStep(2)} className="w-full mt-5 py-3.5 rounded-xl text-white font-black text-sm tracking-wider" style={{ background: 'linear-gradient(135deg,#3b82f6,#8b5cf6)' }}>Lanjut ke Ringkasan →</button>
                                </>
                            )}
                            {modalStep === 2 && (
                                <>
                                    <div className="flex items-center gap-2 mb-5">
                                        <button onClick={() => setModalStep(1)} className="text-gray-400 hover:text-white transition-colors">
                                            <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" /></svg>
                                        </button>
                                        <h3 className="text-white font-black text-lg">Ringkasan Pesanan</h3>
                                    </div>
                                    <div className="bg-[#252d40] rounded-xl px-4 py-3 mb-3 flex items-center justify-between">
                                        <span className="text-gray-400 text-xs font-semibold uppercase">Metode Bayar</span>
                                        <span className="text-green-400 font-bold text-sm">{payMethod}</span>
                                    </div>
                                    <div className="space-y-2 mb-3 max-h-[180px] overflow-y-auto pr-1">
                                        {selected.map((i) => (
                                            <div key={i.id} className="bg-[#1e2433] rounded-xl px-4 py-3 flex items-center justify-between gap-3">
                                                <div><p className="text-white font-bold text-sm">{i.label}</p><p className="text-gray-500 text-xs">{i.game} · ID: {i.userId} ({i.zoneId})</p></div>
                                                <span className="text-amber-400 font-bold text-sm flex-shrink-0">{i.price}</span>
                                            </div>
                                        ))}
                                    </div>
                                    <div className="bg-gradient-to-r from-green-600/10 to-purple-500/10 border border-green-600/20 rounded-xl px-4 py-4 flex items-center justify-between mb-4">
                                        <span className="text-gray-300 text-sm font-bold">Total Pembayaran</span>
                                        <span className="text-green-500 font-black text-xl">{fmt(total)}</span>
                                    </div>
                                    <button onClick={confirmPayment} className="w-full py-3.5 rounded-xl text-white font-black text-sm tracking-wider" style={{ background: 'linear-gradient(135deg,#3b82f6,#8b5cf6)' }}>✓ KONFIRMASI & BAYAR</button>
                                </>
                            )}
                        </div>
                    </div>
                </div>
            )}

            {editItem && (
                <div className="fixed inset-0 z-[130] flex items-center justify-center p-4">
                    <div className="absolute inset-0 bg-black/70 backdrop-blur-sm" onClick={() => setEditItem(null)} />
                    <div className="relative w-full max-w-sm bg-[#1e2433] border border-white/10 rounded-3xl shadow-[0_30px_80px_rgba(0,0,0,0.8)] p-6">
                        <h3 className="text-white font-black text-lg mb-5">Edit Data Akun</h3>
                        <div className="mb-4">
                            <label className="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">User ID</label>
                            <input value={editUid} onChange={(e) => setEditUid(e.target.value)} className="w-full bg-[#252d40] border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-green-500/50 transition-all" />
                        </div>
                        <div className="mb-6">
                            <label className="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">Zone ID</label>
                            <input value={editZone} onChange={(e) => setEditZone(e.target.value)} className="w-full bg-[#252d40] border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-green-500/50 transition-all" />
                        </div>
                        <div className="flex gap-3">
                            <button onClick={() => setEditItem(null)} className="flex-1 py-3 rounded-xl border border-white/10 text-gray-300 font-bold text-sm hover:bg-white/5 transition-all">Batal</button>
                            <button onClick={saveEdit} className="flex-1 py-3 rounded-xl bg-green-500 hover:bg-green-600 text-white font-bold text-sm transition-all shadow-lg shadow-green-500/30">Simpan</button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
