import { useEffect, useRef, useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import Navbar from '../Components/Navbar';

function formatRupiah(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
}

export default function Checkout({ batchId, items, total, paymentStatus: initialStatus, snapToken, clientKey, isProduction }) {
    const [paymentStatus, setPaymentStatus] = useState(initialStatus);
    const [snapLoaded, setSnapLoaded] = useState(false);
    // snapFinished hanya sinyal UX bahwa user sudah selesai di Snap UI.
    // Source of truth tetap dari polling backend, BUKAN dari onSuccess Snap.
    const [snapFinished, setSnapFinished] = useState(false);
    const pollRef = useRef(null);

    useEffect(() => {
        if (!clientKey) return;
        const script = document.createElement('script');
        script.src = isProduction ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
        script.setAttribute('data-client-key', clientKey);
        script.onload = () => setSnapLoaded(true);
        document.body.appendChild(script);
        return () => document.body.removeChild(script);
    }, [clientKey, isProduction]);

    useEffect(() => {
        if (snapLoaded && snapToken && window.snap) {
            window.snap.embed(snapToken, {
                embedId: 'snap-container',
                // onSuccess: hanya untuk UX — TIDAK mengubah payment_status DB.
                // Polling backend tetap berjalan hingga DB confirm SUCCESS.
                onSuccess: () => setSnapFinished(true),
                onPending: () => setSnapFinished(true),
                onError: () => setSnapFinished(true),
            });
        }
    }, [snapLoaded, snapToken]);

    useEffect(() => {
        // Polling hanya berhenti jika backend (DB) sudah return SUCCESS/FAILED/EXPIRED.
        // onSuccess dari Snap TIDAK menghentikan polling.
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
    // Tampilkan pesan "sedang memverifikasi" jika Snap selesai tapi backend belum confirm.
    const verifying = snapFinished && paymentStatus === 'WAITING';

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
                    <p className="text-gray-400 text-sm mt-2">Bayar melalui Midtrans dengan metode pilihanmu.</p>
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

                    {!success ? (
                        <>
                            {verifying && (
                                <div className="mb-4 flex items-center gap-3 rounded-xl bg-yellow-500/10 border border-yellow-500/30 px-4 py-3">
                                    <svg className="w-5 h-5 text-yellow-400 animate-spin flex-shrink-0" fill="none" viewBox="0 0 24 24">
                                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                                    </svg>
                                    <span className="text-yellow-300 text-sm font-medium">Memverifikasi pembayaran… mohon tunggu.</span>
                                </div>
                            )}
                            <div id="snap-container" className="min-h-[400px]" />
                        </>
                    ) : (
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
