import { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';

function formatRupiah(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
}

// "10 Diamonds (9 + 1 Bonus)" -> { label: "10 Diamonds", bonus: 1 }. Items
// that don't match the pattern (e.g. "Weekly Diamond Pass") fall back to
// their raw name with no bonus badge.
function parseItemName(name) {
    const match = /^(.*?)\s*\((\d+)\s*\+\s*(\d+)\s*Bonus\)$/i.exec(name ?? '');
    if (!match) return { label: name, bonus: 0 };
    return { label: match[1].trim(), bonus: Number(match[3]) };
}

// Best value = lowest price per diamond, computed only over plain diamond
// items (skips subscription passes, which aren't comparable per-unit).
function bestValueItemId(items) {
    let bestId = null;
    let bestRatio = Infinity;
    for (const item of items) {
        const leading = /^(\d+)/.exec(item.name ?? '');
        if (!leading) continue;
        const ratio = item.price / Number(leading[1]);
        if (ratio < bestRatio) {
            bestRatio = ratio;
            bestId = item.id;
        }
    }
    return bestId;
}

export default function Topup({ product, items }) {
    const [fields, setFields] = useState({});
    const [selectedItem, setSelectedItem] = useState(null);
    const [modalOpen, setModalOpen] = useState(false);
    const [error, setError] = useState(null);
    const [submitting, setSubmitting] = useState(false);
    const [addedToCart, setAddedToCart] = useState(false);
    const [showAllPasses, setShowAllPasses] = useState(false);
    const [showAllDiamonds, setShowAllDiamonds] = useState(false);

    const NOMINAL_PREVIEW_ROWS = 2;

    const inputFields = product?.userInput?.fields ?? [];

    const validateAccountFields = () => {
        const missing = inputFields.filter((f) => !fields[f.attrs?.name]?.trim());
        if (missing.length > 0) {
            setError('Mohon lengkapi semua data akun terlebih dahulu.');
            return false;
        }
        if (!selectedItem) {
            setError('Pilih nominal terlebih dahulu.');
            return false;
        }
        return true;
    };

    const addToCart = () => {
        if (!validateAccountFields()) return;

        // Cart items must carry productId/productItemId (the VocaBisnis
        // catalog identifiers) — the backend re-validates and re-prices
        // everything from these at /cart/checkout, never from localStorage.
        const cart = JSON.parse(localStorage.getItem('gv_cart') || '[]');
        cart.push({
            id: Date.now() + '_' + selectedItem.id,
            game: product?.title ?? '',
            gameId: product?.code ?? String(product?.id ?? ''),
            gameColor: '#22c55e',
            label: selectedItem.name,
            price: formatRupiah(selectedItem.price),
            priceNum: selectedItem.price,
            productId: product.id,
            productItemId: selectedItem.id,
            userId: fields.userId ?? '',
            zoneId: fields.zoneId ?? '',
        });
        localStorage.setItem('gv_cart', JSON.stringify(cart));

        setError(null);
        setAddedToCart(true);
        setTimeout(() => setAddedToCart(false), 2000);
    };

    const submit = () => {
        const missing = inputFields.filter((f) => !fields[f.attrs?.name]?.trim());
        if (missing.length > 0) {
            setError('Mohon lengkapi semua data akun terlebih dahulu.');
            return;
        }

        setSubmitting(true);
        router.post(`/topup/${product.id}/checkout`, {
            product_item_id: selectedItem.id,
            user_id_ingame: fields.userId ?? '',
            zone_id: fields.zoneId ?? '',
        }, {
            onError: () => setSubmitting(false),
            onFinish: () => setSubmitting(false),
        });
    };

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans selection:bg-green-500 selection:text-white overflow-x-hidden" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title={`Top Up ${product?.title ?? ''} | WarGame`} />
            <div className="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
                <SmokeBackground />
                <Navbar />

                <div className="relative z-10 flex-1">
                    <div className="max-w-[1200px] mx-auto px-4 pt-24 pb-10 space-y-6">

                        <div className="relative rounded-2xl overflow-hidden border border-white/10 shadow-[0_8px_40px_rgba(0,0,0,0.6)]">
                            <div className="absolute inset-0">
                                <img src={product?.helperUrl || 'https://images.unsplash.com/photo-1556438064-2d7646166914?w=1200&h=400&fit=crop'} alt={product?.title} className="w-full h-full object-cover opacity-40" />
                                <div className="absolute inset-0 bg-gradient-to-r from-[#1e2433] via-[#1e2433]/70 to-transparent" />
                                <div className="absolute inset-0 bg-gradient-to-t from-[#1e2433] via-transparent to-transparent" />
                            </div>
                            <div className="relative z-10 p-6 sm:p-8 flex items-center gap-5">
                                <div className="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-br from-orange-400 to-orange-600 grid place-items-center shadow-[0_0_30px_rgba(249,115,22,0.5)] flex-shrink-0 border border-orange-400/30 overflow-hidden">
                                    {product?.logoUrl ? <img src={product.logoUrl} alt={product.title} className="w-full h-full object-cover" /> : <span className="text-white font-black text-3xl sm:text-4xl">ML</span>}
                                </div>
                                <div>
                                    <span className="inline-block px-2.5 py-0.5 rounded-full bg-orange-500 text-white text-[10px] font-black shadow-[0_0_8px_rgba(249,115,22,0.6)]">POPULER</span>
                                    <h1 className="text-2xl sm:text-3xl font-black text-white tracking-tight mt-1">{product?.title}</h1>
                                    <p className="text-gray-400 text-xs sm:text-sm mt-1">Top Up {product?.title} langsung ke akun</p>
                                </div>
                            </div>
                        </div>

                        <div className="flex flex-col lg:grid lg:grid-cols-5 gap-5 items-stretch lg:items-start">
                            <div className="contents lg:block lg:col-span-2 lg:space-y-5">

                                <div className="order-1 lg:order-none w-full bg-[#252d40]/80 border border-white/8 rounded-2xl p-5 backdrop-blur-md">
                                    <h2 className="text-white font-bold text-base mb-4 flex items-center gap-2">
                                        <span className="w-1 h-5 rounded-full bg-gradient-to-b from-amber-400 to-orange-500 inline-block" />
                                        1. Data Akun
                                    </h2>
                                    {product?.userInput?.instructionText && (
                                        <p className="text-gray-400 text-xs mb-3" dangerouslySetInnerHTML={{ __html: product.userInput.instructionText }} />
                                    )}
                                    <div className="grid grid-cols-2 gap-3">
                                        {inputFields.map((field) => {
                                            const name = field.attrs?.name ?? 'field';
                                            return (
                                                <div key={name}>
                                                    <label className="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                                        {field.attrs?.placeholder ?? name} <span className="text-orange-500">*</span>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        placeholder={field.attrs?.placeholder ?? ''}
                                                        value={fields[name] ?? ''}
                                                        onChange={(e) => setFields((prev) => ({ ...prev, [name]: e.target.value }))}
                                                        className="w-full bg-[#1e2433] border border-white/10 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 outline-none focus:border-amber-500/60 focus:ring-1 focus:ring-amber-500/30 transition-all"
                                                    />
                                                </div>
                                            );
                                        })}
                                    </div>
                                </div>

                                <div className="order-3 lg:order-none w-full bg-[#252d40]/80 border border-white/8 rounded-2xl p-5 backdrop-blur-md">
                                    <h2 className="text-white font-bold text-base mb-4 flex items-center gap-2">
                                        <span className="w-1 h-5 rounded-full bg-gradient-to-b from-green-400 to-green-600 inline-block" />
                                        3. Pembayaran
                                    </h2>
                                    <div className="flex items-center gap-4 bg-[#1e2433] border-2 border-green-500/40 rounded-xl p-3">
                                        <div className="w-16 h-10 bg-white rounded-lg p-1.5 flex items-center justify-center flex-shrink-0">
                                            <img src="/qris.png" alt="QRIS" className="max-w-full max-h-full object-contain" />
                                        </div>
                                        <div className="flex-1">
                                            <p className="text-white font-bold text-sm">QRIS</p>
                                            <p className="text-gray-500 text-xs">Scan pakai GoPay, OVO, DANA, m-banking, dll</p>
                                        </div>
                                        <div className="w-5 h-5 rounded-full border-2 border-green-400 flex items-center justify-center flex-shrink-0">
                                            <div className="w-2.5 h-2.5 rounded-full bg-green-400" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="order-2 lg:order-none lg:col-span-3 w-full bg-[#252d40]/80 border border-white/8 rounded-2xl p-5 backdrop-blur-md">
                                <h2 className="text-white font-bold text-base mb-4 flex items-center gap-2">
                                    <span className="w-1 h-5 rounded-full bg-gradient-to-b from-orange-500 to-purple-500 inline-block" />
                                    2. Pilih Nominal
                                </h2>
                                {(() => {
                                    const visibleItems = items?.filter((item) => item.isActive !== false && item.voucherStock !== 0);

                                    if (!visibleItems?.length) {
                                        return <p className="text-gray-400 text-sm text-center py-8">Belum ada nominal tersedia untuk produk ini.</p>;
                                    }

                                    const passes = visibleItems.filter((item) => /pass/i.test(item.name ?? ''));
                                    const diamonds = visibleItems.filter((item) => !/pass/i.test(item.name ?? ''));
                                    const bestId = bestValueItemId(diamonds);

                                    const renderCard = (item) => {
                                        const disabled = item.isMaintenance;
                                        const active = selectedItem?.id === item.id;
                                        const { label, bonus } = parseItemName(item.name);
                                        const isBest = item.id === bestId;

                                        return (
                                            <div
                                                key={item.id}
                                                onClick={() => !disabled && setSelectedItem(item)}
                                                className={`relative bg-[#1e2433] border rounded-xl p-3 pt-4 text-center flex flex-col items-center min-h-[128px] transition-all ${disabled ? 'opacity-35 pointer-events-none' : 'cursor-pointer hover:-translate-y-1'} ${active ? 'border-amber-500 bg-amber-500/10 shadow-[0_0_0_2px_rgba(245,158,11,0.4)]' : 'border-white/8'}`}
                                            >
                                                {item.isMaintenance && (
                                                    <div className="absolute -top-2 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-full text-[9px] font-black bg-gray-500 text-white whitespace-nowrap">MAINTENANCE</div>
                                                )}
                                                {!item.isMaintenance && isBest && (
                                                    <div className="absolute -top-2 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-full text-[9px] font-black bg-emerald-500 text-black whitespace-nowrap shadow-[0_0_8px_rgba(16,185,129,0.6)]">PALING HEMAT</div>
                                                )}

                                                {item.iconUrl ? (
                                                    <img src={item.iconUrl} alt="" className="w-9 h-9 object-contain mb-1.5" />
                                                ) : (
                                                    <div className="w-9 h-9 mb-1.5 rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600" />
                                                )}

                                                <span className="text-white font-bold text-sm leading-tight">{label}</span>
                                                {bonus > 0 && (
                                                    <span className="mt-1 inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-green-500/15 text-green-400 text-[10px] font-bold">
                                                        +{bonus} Bonus
                                                    </span>
                                                )}

                                                <div className="flex-1" />
                                                <div className="w-full mt-2 pt-2 border-t border-white/5">
                                                    <p className="text-amber-400 font-bold text-sm">{formatRupiah(item.price)}</p>
                                                </div>

                                                {active && (
                                                    <div className="absolute top-2 right-2 w-4 h-4 rounded-full bg-amber-500 flex items-center justify-center">
                                                        <svg className="w-2.5 h-2.5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="3.5"><path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" /></svg>
                                                    </div>
                                                )}
                                            </div>
                                        );
                                    };

                                    const renderGroup = (groupItems, expanded, toggle) => {
                                        const rowsCols = { base: 2, sm: 3, xl: 4 };
                                        const previewCount = NOMINAL_PREVIEW_ROWS * rowsCols.xl;
                                        const canCollapse = groupItems.length > previewCount;

                                        return (
                                            <>
                                                <div
                                                    className="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-3 overflow-hidden transition-[max-height] duration-500 ease-in-out"
                                                    style={{ maxHeight: expanded || !canCollapse ? 2000 : 272 }}
                                                >
                                                    {groupItems.map(renderCard)}
                                                </div>
                                                {canCollapse && (
                                                    <button
                                                        onClick={toggle}
                                                        aria-label={expanded ? 'Tampilkan lebih sedikit' : 'Tampilkan lebih banyak'}
                                                        className="mx-auto mt-2 flex items-center justify-center w-8 h-8 rounded-full border border-white/10 text-gray-400 hover:text-white hover:bg-white/5 transition-all"
                                                    >
                                                        <svg
                                                            className={`w-4 h-4 transition-transform duration-500 ease-in-out ${expanded ? 'rotate-180' : ''}`}
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"
                                                        >
                                                            <path strokeLinecap="round" strokeLinejoin="round" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </button>
                                                )}
                                            </>
                                        );
                                    };

                                    return (
                                        <div className="space-y-5">
                                            {passes.length > 0 && (
                                                <div>
                                                    <p className="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Diamond Pass</p>
                                                    {renderGroup(passes, showAllPasses, () => setShowAllPasses((v) => !v))}
                                                </div>
                                            )}
                                            {diamonds.length > 0 && (
                                                <div>
                                                    {passes.length > 0 && <p className="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Diamond</p>}
                                                    {renderGroup(diamonds, showAllDiamonds, () => setShowAllDiamonds((v) => !v))}
                                                </div>
                                            )}
                                        </div>
                                    );
                                })()}
                            </div>
                        </div>
                    </div>
                </div>

                <Footer />
            </div>

            <div className={`fixed bottom-0 left-0 w-full z-[90] transition-transform duration-300 ${selectedItem ? 'translate-y-0' : 'translate-y-[120%] pointer-events-none'}`}>
                <div className="max-w-[1200px] mx-auto p-4 sm:p-6 pointer-events-auto">
                    {error && !modalOpen && <p className="text-red-400 text-xs mb-2">{error}</p>}
                    <div className="bg-[#252d40]/95 backdrop-blur-xl rounded-2xl shadow-[0_-5px_40px_rgba(0,0,0,0.8)] p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border border-white/10">
                        <div className="flex-1">
                            <div className="flex items-center gap-2">
                                <span className="text-sm font-bold text-white">{selectedItem ? selectedItem.name : 'Pilih Nominal'}</span>
                                <span className="text-gray-400 text-xs">•</span>
                                <span className="text-sm font-semibold text-gray-300">QRIS</span>
                            </div>
                            <div className="mt-2 flex items-baseline gap-2">
                                <span className="text-2xl font-black text-green-500">{selectedItem ? formatRupiah(selectedItem.price) : 'Rp -'}</span>
                            </div>
                        </div>
                        <div className="flex gap-2 flex-1 sm:flex-none">
                            <button
                                disabled={!selectedItem}
                                onClick={addToCart}
                                className="flex-1 sm:w-[150px] py-3.5 rounded-xl font-bold text-sm transition-all flex items-center justify-center gap-2 disabled:cursor-not-allowed disabled:opacity-40 border border-white/15 text-white hover:bg-white/5"
                            >
                                {addedToCart ? '✓ Ditambahkan' : '+ Keranjang'}
                            </button>
                            <button
                                disabled={!selectedItem}
                                onClick={() => setModalOpen(true)}
                                className="flex-1 sm:w-[180px] py-3.5 rounded-xl font-bold text-sm transition-all flex items-center justify-center gap-2 disabled:cursor-not-allowed disabled:bg-gray-300 disabled:text-gray-500 bg-green-700 hover:bg-green-600 text-white shadow-lg shadow-green-700/30"
                            >
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {modalOpen && (
                <div className="fixed inset-0 z-[100] flex items-center justify-center p-4">
                    <div className="absolute inset-0 bg-black/70 backdrop-blur-sm" onClick={() => setModalOpen(false)} />
                    <div className="relative w-full max-w-md bg-[#1e2433] border border-white/10 rounded-3xl shadow-[0_30px_80px_rgba(0,0,0,0.8)] overflow-hidden">
                        <div className="h-1 w-full" style={{ background: 'linear-gradient(90deg,#3b82f6,#8b5cf6,#ec4899)' }} />
                        <div className="p-6">
                            <div className="flex items-center justify-between mb-5">
                                <div>
                                    <h3 className="text-white font-black text-lg">Konfirmasi Pembelian</h3>
                                    <p className="text-gray-500 text-xs mt-0.5">Periksa detail pesanan Anda</p>
                                </div>
                                <button onClick={() => setModalOpen(false)} className="w-8 h-8 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center transition-colors">
                                    <svg className="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            <div className="space-y-3 mb-6">
                                <div className="bg-[#252d40] rounded-xl px-4 py-3 flex items-center justify-between">
                                    <span className="text-gray-400 text-xs font-semibold uppercase tracking-wider">Item</span>
                                    <span className="text-white font-bold text-sm">{selectedItem?.name}</span>
                                </div>
                                <div className="bg-[#252d40] rounded-xl px-4 py-3 flex items-center justify-between">
                                    <span className="text-gray-400 text-xs font-semibold uppercase tracking-wider">Metode Bayar</span>
                                    <span className="text-white font-bold text-sm">QRIS</span>
                                </div>
                                <div className="bg-gradient-to-r from-green-600/10 to-purple-500/10 border border-green-600/20 rounded-xl px-4 py-4 flex items-center justify-between mt-2">
                                    <span className="text-gray-300 text-sm font-bold">Total Pembayaran</span>
                                    <span className="text-green-500 font-black text-xl">{selectedItem ? formatRupiah(selectedItem.price) : '—'}</span>
                                </div>
                            </div>
                            {error && <p className="text-red-400 text-xs mb-3">{error}</p>}
                            <button onClick={submit} disabled={submitting} className="w-full py-3.5 rounded-xl bg-green-700 hover:bg-green-600 text-white font-black text-sm tracking-wider transition-all shadow-[0_0_20px_rgba(22,163,74,0.4)] disabled:opacity-60">
                                {submitting ? 'Memproses...' : 'KONFIRMASI'}
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
