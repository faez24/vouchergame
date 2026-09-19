import { Head, Link } from '@inertiajs/react';
import SmokeBackground from '../Components/SmokeBackground';

export default function Login() {
    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title="Masuk | WarGame" />
            <div className="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col items-center justify-center">
                <SmokeBackground variant="compact" />

                <div className="relative z-10 w-full max-w-[440px] px-4 mb-6">
                    <Link href="/" className="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-sm">
                        <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Beranda
                    </Link>
                </div>

                <div className="relative z-10 w-full max-w-[440px] px-4 pb-12">
                    <div className="bg-[#1e2433]/90 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-[0_30px_80px_rgba(0,0,0,0.7)]">
                        <div className="h-1 w-full" style={{ background: 'linear-gradient(90deg,#3b82f6,#8b5cf6,#ec4899)' }} />
                        <div className="p-8">
                            <div className="text-center mb-8">
                                <Link href="/" className="inline-flex items-center gap-3 mb-5">
                                    <span className="grid h-12 w-12 place-items-center rounded-2xl bg-gradient-to-r from-green-400 to-green-600 text-[16px] font-extrabold tracking-tight text-white shadow-[0_0_20px_rgba(34,197,94,0.5)]">GV</span>
                                    <span className="text-2xl font-bold tracking-tight text-white drop-shadow">WarGame</span>
                                </Link>
                                <h1 className="text-2xl font-black text-white">Selamat Datang</h1>
                                <p className="text-gray-400 text-sm mt-1.5">Masuk untuk melanjutkan top up favoritmu</p>
                            </div>

                            <a href="/auth/google" className="flex w-full items-center justify-center gap-3 py-3.5 rounded-xl text-sm font-semibold text-white tracking-wider cursor-pointer transition-all hover:brightness-110" style={{ background: 'linear-gradient(135deg, #3b82f6, #8b5cf6)' }}>
                                <span className="bg-white p-1 rounded-full flex items-center justify-center">
                                    <svg className="w-5 h-5" viewBox="0 0 24 24">
                                        <path fill="#EA4335" d="M5.27 9.77A7.5 7.5 0 0 1 12 4.5c1.96 0 3.73.73 5.08 1.92l3.78-3.78A12 12 0 0 0 12 0C7.37 0 3.36 2.55 1.23 6.3l4.04 3.47Z" />
                                        <path fill="#34A853" d="M16.04 18.01A7.48 7.48 0 0 1 12 19.5a7.5 7.5 0 0 1-6.72-4.23L1.22 18.7A12 12 0 0 0 12 24c3.06 0 5.96-1.1 8.15-3.08l-4.11-2.91Z" />
                                        <path fill="#FBBC05" d="M19.5 12c0-.67-.07-1.32-.18-1.95H12v3.72h4.23a3.6 3.6 0 0 1-1.57 2.36l4.1 2.9C20.4 17.23 19.5 14.8 19.5 12Z" />
                                        <path fill="#4285F4" d="M5.28 14.27A7.43 7.43 0 0 1 4.5 12c0-.8.14-1.57.38-2.3L.85 6.23A12 12 0 0 0 0 12c0 1.97.48 3.83 1.32 5.47l3.96-3.2Z" />
                                    </svg>
                                </span>
                                <span className="font-black">MASUK DENGAN GOOGLE</span>
                            </a>
                        </div>
                    </div>

                    <div className="flex items-center justify-center gap-6 mt-6">
                        <div className="flex items-center gap-1.5 text-gray-500 text-[11px]">
                            <svg className="w-3.5 h-3.5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            SSL Terenkripsi
                        </div>
                        <div className="flex items-center gap-1.5 text-gray-500 text-[11px]">
                            <svg className="w-3.5 h-3.5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            Proses Instan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
