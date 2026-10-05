import { useEffect, useRef, useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import { QRCodeSVG } from 'qrcode.react';
import Navbar from '../Components/Navbar';

function formatRupiah(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
}

function formatCountdown(ms) {
    if (ms <= 0) return '00:00';
    const totalSeconds = Math.floor(ms / 1000);
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

export default function Checkout({ batchId, items, total, paymentStatus: initialStatus, qrString, qrExpiryAt }) {
    const [paymentStatus, setPaymentStatus] = useState(initialStatus);
    const [msLeft, setMsLeft] = useState(() => (qrExpiryAt ? new Date(qrExpiryAt).getTime() - Date.now() : 0));
    const pollRef = useRef(null);

    useEffect(() => {
        if (!qrExpiryAt) return;
        const expiry = new Date(qrExpiryAt).getTime();
        const tick = () => setMsLeft(expiry - Date.now());
        tick();
        const timer = setInterval(tick, 1000);
        return () => clearInterval(timer);
    }, [qrExpiryAt]);

    useEffect(() => {
        if (paymentStatus === 'SUCCESS' || paymentStatus === 'FAILED' || paymentStatus === 'EXPIRED' || !batchId) return;

        pollRef.current = setInterval(async () => {
            try {
                const res = await fetch(`/checkout/${batchId}/status`);
                if (!res.ok) return;
                const data = await res.json();
                setPaymentStatus(data.paymentStatus);
            } catch {
                // ignore transient polling errors
            }
        }, 5000);

        return () => clearInterval(pollRef.current);
    }, [batchId, paymentStatus]);

    const success = paymentStatus === 'SUCCESS';
    const expired = paymentStatus === 'EXPIRED' || (qrExpiryAt && msLeft <= 0 && !success);

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden flex flex-col" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title="Pembayaran | WarGame" />

            <div className="pointer-events-none fixed inset-0 z-0 overflow-hidden">
                <div className="absolute inset-0 bg-gradient-to-b from-[#1e2433] to-[#344050]" />
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-green-500/10 blur-[100px]" />
                <div className="absolute bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] rounded-full bg-green-600/10 blur-[100px]" />
            </div>

            <Navbar />

            <div className="relative z-10 flex-1 max-w-[500px] mx-auto w-full px-4 pt-28 pb-20 flex flex-col justify-center">
                <div className="text-center mb-8">
                    <h1 className="text-2xl sm:text-3xl font-black text-white tracking-tight">Selesaikan Pembayaran</h1>
                    <p className="text-gray-400 text-sm mt-2">Scan QRIS pakai e-wallet atau mobile banking favoritmu.</p>
                </div>

                <div className="bg-[#252d40]/90 backdrop-blur-xl border border-white/10 rounded-3xl p-6 sm:p-8 shadow-[0_30px_80px_rgba(0,0,0,0.8)] relative overflow-hidden">
                    <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-green-600" />

                    <div className="mb-6 pb-6 border-b border-white/10 space-y-2">
                        {(items ?? []).map((item, idx) => (
                            <div key={idx} className="flex justify-between text-sm">
                                <span className="text-gray-400">{item.name ?? `Item #${idx + 1}`}</span>
                                <span className="text-white font-semibold">{formatRupiah(item.price)}</span>
                            </div>
                        ))}
                        <div className="flex justify-between items-center pt-2">
                            <p className="text-gray-400 text-xs font-semibold uppercase tracking-wider">Total Pembayaran</p>
                            <p className="text-2xl font-black text-green-400">{formatRupiah(total)}</p>
                        </div>
                    </div>

                    {success ? (
                        <div className="flex flex-col items-center justify-center py-8">
                            <div className="w-24 h-24 rounded-full bg-emerald-500 flex items-center justify-center mb-4">
                                <svg className="w-14 h-14 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span className="font-bold text-emerald-400 text-lg">Pembayaran Berhasil!</span>
                            <p className="text-center text-xs mt-3 text-emerald-500/80 max-w-[250px]">
                                Pesanan kamu sedang diproses dan akan segera dikirimkan. Terima kasih!
                            </p>
                        </div>
                    ) : expired ? (
                        <div className="flex flex-col items-center justify-center py-8">
                            <div className="w-24 h-24 rounded-full bg-red-500/20 border border-red-500/40 flex items-center justify-center mb-4">
                                <svg className="w-12 h-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <span className="font-bold text-red-400 text-lg">QR Code Kedaluwarsa</span>
                            <p className="text-center text-xs mt-3 text-gray-400 max-w-[250px]">
                                Waktu pembayaran habis. Silakan ulangi pemesanan untuk mendapatkan QR baru.
                            </p>
                        </div>
                    ) : qrString ? (
                        <div className="flex flex-col items-center">
                            <div className="flex items-center gap-2 mb-4">
                                <span className="inline-flex items-center gap-1.5 bg-green-500/10 border border-green-500/30 text-green-400 text-xs font-bold px-3 py-1 rounded-full">
                                    <svg className="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><rect x="3" y="3" width="7" height="7" /><rect x="14" y="3" width="7" height="7" /><rect x="3" y="14" width="7" height="7" /><rect x="14" y="14" width="3" height="3" /><rect x="18" y="18" width="3" height="3" /><rect x="14" y="18" width="3" height="3" /><rect x="18" y="14" width="3" height="3" /></svg>
                                    QRIS
                                </span>
                                {qrExpiryAt && (
                                    <span className="text-xs font-semibold text-gray-400">
                                        Berakhir dalam <span className="text-white tabular-nums">{formatCountdown(msLeft)}</span>
                                    </span>
                                )}
                            </div>

                            <div className="bg-white rounded-2xl p-4 shadow-lg">
                                <QRCodeSVG value={qrString} size={240} level="M" marginSize={0} />
                            </div>

                            <div className="mt-5 flex items-center gap-3 rounded-xl bg-white/5 border border-white/10 px-4 py-3 w-full">
                                <svg className="w-5 h-5 text-green-400 animate-spin flex-shrink-0" fill="none" viewBox="0 0 24 24">
                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                                </svg>
                                <span className="text-gray-300 text-sm font-medium">Menunggu pembayaran…</span>
                            </div>

                            <ol className="mt-6 w-full text-xs text-gray-400 space-y-1.5 list-decimal list-inside">
                                <li>Buka aplikasi e-wallet atau m-banking yang mendukung QRIS.</li>
                                <li>Pilih menu Scan / Bayar, lalu arahkan kamera ke QR di atas.</li>
                                <li>Periksa nominal, lalu selesaikan pembayaran.</li>
                            </ol>
                        </div>
                    ) : (
                        <div className="flex items-center justify-center py-12">
                            <svg className="w-6 h-6 text-gray-400 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                            </svg>
                        </div>
                    )}
                </div>

                <div className="mt-8">
                    <Link href="/" className="block w-full py-4 rounded-xl border border-white/10 text-center text-gray-400 font-bold text-sm hover:bg-white/5 hover:text-white transition-all">
                        Kembali ke Beranda
                    </Link>
                </div>
            </div>
        </div>
    );
}
