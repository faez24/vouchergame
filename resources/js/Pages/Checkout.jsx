import { useEffect, useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import Navbar from '../Components/Navbar';

export default function Checkout() {
    const [total, setTotal] = useState('Rp 50.000');
    const [success, setSuccess] = useState(false);
    const [trxId, setTrxId] = useState('');

    useEffect(() => {
        setTotal(localStorage.getItem('gv_checkout_total') || 'Rp 50.000');
        const timer = setTimeout(() => {
            setTrxId('TRX-' + Math.random().toString(36).substr(2, 9).toUpperCase());
            setSuccess(true);
        }, 5000);
        return () => clearTimeout(timer);
    }, []);

    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden flex flex-col" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title="Pembayaran QRIS | WarGame" />
            <style>{`@keyframes scan { 0% { top: 1rem; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { top: calc(100% - 1.2rem); opacity: 0; } }`}</style>

            <div className="pointer-events-none fixed inset-0 z-0 overflow-hidden">
                <div className="absolute inset-0 bg-gradient-to-b from-[#1e2433] to-[#344050]" />
                <div className="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-green-500/10 blur-[100px]" />
                <div className="absolute bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] rounded-full bg-green-600/10 blur-[100px]" />
            </div>

            <Navbar />

            <div className="relative z-10 flex-1 max-w-[500px] mx-auto w-full px-4 pt-28 pb-20 flex flex-col justify-center">
                <div className="text-center mb-8">
                    <h1 className="text-2xl sm:text-3xl font-black text-white tracking-tight">Selesaikan Pembayaran</h1>
                    <p className="text-gray-400 text-sm mt-2">Pindai kode QR di bawah ini menggunakan aplikasi e-wallet atau m-banking kamu.</p>
                </div>

                <div className="bg-[#252d40]/90 backdrop-blur-xl border border-white/10 rounded-3xl p-6 sm:p-8 shadow-[0_30px_80px_rgba(0,0,0,0.8)] relative overflow-hidden">
                    <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-green-600" />

                    <div className="flex justify-between items-center mb-6 pb-6 border-b border-white/10">
                        <div>
                            <p className="text-gray-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Pembayaran</p>
                            <p className="text-2xl sm:text-3xl font-black text-green-400">{total}</p>
                        </div>
                        <div className="w-16 h-10 bg-white rounded-lg p-1.5 flex items-center justify-center shadow-inner">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png" className="max-w-full max-h-full object-contain" alt="QRIS" />
                        </div>
                    </div>

                    <div className="flex flex-col items-center justify-center py-4">
                        <div className={`bg-white rounded-2xl shadow-[0_0_40px_rgba(34,197,94,0.2)] mb-6 relative overflow-hidden transition-all duration-500 w-[232px] h-[232px] ${success ? '' : 'p-4'}`}>
                            {!success && (
                                <>
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=WarGame-Dummy-Payment" alt="QR Code" className="w-full h-full rounded-lg" />
                                    <div className="absolute top-4 left-4 right-4 h-1 bg-green-400/80 shadow-[0_0_15px_#4ade80] z-10 rounded-full" style={{ animation: 'scan 2.5s ease-in-out infinite alternate' }} />
                                </>
                            )}
                            {success && (
                                <div className="absolute inset-0 bg-emerald-500 flex flex-col items-center justify-center">
                                    <svg className="w-24 h-24 text-white drop-shadow-lg mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span className="text-white font-bold text-sm tracking-wide">BERHASIL</span>
                                </div>
                            )}
                        </div>

                        <div className={`flex items-center gap-3 text-sm px-5 py-2.5 rounded-full border transition-all duration-300 ${success ? 'bg-emerald-500/20 border-emerald-500/30 text-emerald-400' : 'bg-white/5 border-white/10 text-gray-300'}`}>
                            <div className={`w-2.5 h-2.5 rounded-full ${success ? 'bg-emerald-400' : 'bg-amber-400 animate-pulse'}`} />
                            <span className={success ? 'font-bold' : ''}>{success ? 'Pembayaran Sukses!' : 'Menunggu Pembayaran...'}</span>
                        </div>

                        {success && (
                            <div className="mt-5 text-center">
                                <p className="text-[11px] text-gray-400 uppercase tracking-widest font-semibold mb-1.5">No. ID Transaksi</p>
                                <p className="text-sm font-black text-white bg-[#1e2433] px-4 py-1.5 rounded-lg border border-white/5 shadow-inner">{trxId}</p>
                            </div>
                        )}

                        <p className={`text-center text-xs mt-5 max-w-[250px] transition-opacity duration-300 ${success ? 'text-emerald-500/80' : 'text-gray-500'}`}>
                            {success ? 'Pesanan kamu sedang diproses dan akan segera dikirimkan. Terima kasih!' : 'Pembayaran akan dikonfirmasi otomatis setelah berhasil di-scan.'}
                        </p>
                    </div>
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
