import { Link } from '@inertiajs/react';

const socials = [
    ['Facebook', 'M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z'],
    ['Twitter', 'M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z'],
];

export default function Footer() {
    return (
        <footer id="footer" className="mt-12 border-t border-white/5 relative w-full overflow-hidden bg-cover bg-bottom bg-no-repeat" style={{ backgroundImage: "url('/images/footer.png')", backgroundPosition: 'center bottom' }}>
            <div className="absolute inset-0 bg-[#050810]/70 backdrop-blur-sm z-0" />
            <div className="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none" />
            <div className="absolute bottom-0 left-0 w-80 h-80 bg-green-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4 pointer-events-none" />

            <div className="max-w-[1440px] mx-auto w-full px-4 sm:px-6 lg:px-8 pt-12 sm:pt-14 pb-4 relative z-10">
                <div className="grid grid-cols-2 md:grid-cols-3 gap-8 lg:grid-cols-5 xl:gap-16">
                    <div className="col-span-2 md:col-span-3 lg:col-span-2">
                        <Link href="/" className="relative flex items-center h-10 w-48 mb-6">
                            <img src="/logo.png" alt="WarGame" className="absolute left-0 top-1/2 -translate-y-1/2 h-42 w-auto max-w-none" />
                        </Link>
                        <p className="text-gray-400 text-sm leading-relaxed max-w-md mb-8">Platform top up game dan voucher digital terpercaya di Indonesia. Memberikan layanan instan, aman, dan harga terbaik untuk setiap transaksi Anda.</p>
                        <div className="flex gap-3">
                            {socials.map(([label, path]) => (
                                <a key={label} href="#" aria-label={label} className="w-10 h-10 rounded-xl bg-white/[0.03] hover:bg-green-500/10 hover:text-green-400 border border-white/5 hover:border-green-500/30 flex items-center justify-center transition-all duration-300 text-gray-400 hover:shadow-[0_0_10px_rgba(34,197,94,0.2)]">
                                    <svg viewBox="0 0 24 24" className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="2"><path d={path} /></svg>
                                </a>
                            ))}
                        </div>
                    </div>

                    <div className="col-span-1">
                        <h3 className="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Bantuan</h3>
                        <ul className="space-y-4">
                            {['Cara Top Up', 'FAQ', 'Hubungi Kami', 'Syarat & Ketentuan'].map((item) => (
                                <li key={item}><a href="#" className="text-gray-400 hover:text-green-400 transition-colors text-sm font-medium">{item}</a></li>
                            ))}
                        </ul>
                    </div>

                    <div className="col-span-1">
                        <h3 className="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Game Populer</h3>
                        <ul className="space-y-4">
                            {['Mobile Legends', 'Free Fire', 'PUBG Mobile', 'Genshin Impact'].map((game, idx) => (
                                <li key={game}><a href="#" className="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2"><span className={`w-1.5 h-1.5 rounded-full ${idx % 2 === 0 ? 'bg-green-500/50' : 'bg-orange-500/50'}`} />{game}</a></li>
                            ))}
                        </ul>
                    </div>

                    <div className="col-span-2 sm:col-span-1">
                        <h3 className="text-white font-extrabold tracking-wider mb-6 uppercase text-xs">Metode Pembayaran</h3>
                        <div className="grid grid-cols-2 gap-2">
                            {['DANA', 'OVO', 'GOPAY', 'QRIS', 'Virtual Account'].map((item, idx) => (
                                <div key={item} className={`h-10 bg-white/[0.03] rounded-xl flex items-center justify-center border border-white/5 text-gray-300 text-xs font-bold ${idx === 4 ? 'col-span-2' : ''}`}>{item}</div>
                            ))}
                        </div>
                    </div>
                </div>

                <div className="mt-10 pt-6 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p className="text-gray-500 text-sm font-medium">© 2026 WarGame. All rights reserved.</p>
                    <div className="flex items-center gap-6">
                        <a href="#" className="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors">Privacy Policy</a>
                        <a href="#" className="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    );
}
