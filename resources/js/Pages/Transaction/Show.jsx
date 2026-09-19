import { Head, Link } from '@inertiajs/react';
import SmokeBackground from '../../Components/SmokeBackground';
import Navbar from '../../Components/Navbar';
import Footer from '../../Components/Footer';

const statusStyle = {
    Success: 'bg-green-500/20 text-green-400 border-green-500/30',
    Processing: 'bg-amber-500/20 text-amber-400 border-amber-500/30',
    Refunded: 'bg-red-500/20 text-red-400 border-red-500/30',
};

export default function TransactionShow({ transaction }) {
    return (
        <div className="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden" style={{ fontFamily: 'Poppins, sans-serif' }}>
            <Head title={`Transaksi ${transaction.invoice_id} | WarGame`} />
            <div className="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">
                <SmokeBackground variant="compact" />
                <Navbar />

                <div className="relative z-10 flex-1 max-w-[560px] mx-auto w-full px-4 pt-28 pb-20">
                    <div className="bg-[#252d40]/90 backdrop-blur-xl border border-white/10 rounded-3xl p-6 sm:p-8 shadow-[0_30px_80px_rgba(0,0,0,0.8)]">
                        <div className="flex items-center justify-between mb-6 pb-6 border-b border-white/10">
                            <div>
                                <p className="text-gray-400 text-xs font-semibold uppercase tracking-wider mb-1">Invoice</p>
                                <p className="text-lg font-black text-white">{transaction.invoice_id}</p>
                            </div>
                            <span className={`px-3 py-1.5 rounded-full text-xs font-bold border ${statusStyle[transaction.status] ?? 'bg-white/10 text-gray-300 border-white/20'}`}>
                                {transaction.status}
                            </span>
                        </div>

                        <div className="space-y-3">
                            <div className="bg-[#1e2433] rounded-xl px-4 py-3 flex items-center justify-between">
                                <span className="text-gray-400 text-xs font-semibold uppercase tracking-wider">Produk</span>
                                <span className="text-white font-bold text-sm text-right">{transaction.product_name} — {transaction.product_item_name}</span>
                            </div>
                            <div className="bg-gradient-to-r from-green-600/10 to-purple-500/10 border border-green-600/20 rounded-xl px-4 py-4 flex items-center justify-between">
                                <span className="text-gray-300 text-sm font-bold">Total</span>
                                <span className="text-green-500 font-black text-xl">Rp {Number(transaction.total_amount).toLocaleString('id-ID')}</span>
                            </div>
                            {transaction.sn && (
                                <div className="bg-[#1e2433] rounded-xl px-4 py-3">
                                    <span className="text-gray-400 text-xs font-semibold uppercase tracking-wider block mb-1">Serial Number</span>
                                    <span className="text-white text-sm break-all">{transaction.sn}</span>
                                </div>
                            )}
                        </div>

                        <Link href="/" className="mt-6 block w-full py-3.5 rounded-xl border border-white/10 text-center text-gray-300 font-bold text-sm hover:bg-white/5 hover:text-white transition-all">
                            Kembali ke Beranda
                        </Link>
                    </div>
                </div>

                <Footer />
            </div>
        </div>
    );
}
