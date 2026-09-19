import { useEffect, useRef, useState } from 'react';
import { Link, router, usePage } from '@inertiajs/react';

const navLinks = [
    { href: '/', label: 'Home' },
    { href: '/games', label: 'Games' },
    { href: '/voucher', label: 'Voucher' },
];

export default function Navbar() {
    const { auth } = usePage().props;
    const [scrolled, setScrolled] = useState(false);
    const [mobileOpen, setMobileOpen] = useState(false);
    const [dropdownOpen, setDropdownOpen] = useState(false);
    const dropdownRef = useRef(null);
    const currentPath = typeof window !== 'undefined' ? window.location.pathname : '/';

    useEffect(() => {
        const onScroll = () => setScrolled(window.scrollY > 150);
        window.addEventListener('scroll', onScroll);
        return () => window.removeEventListener('scroll', onScroll);
    }, []);

    useEffect(() => {
        const onClickOutside = (e) => {
            if (dropdownRef.current && !dropdownRef.current.contains(e.target)) {
                setDropdownOpen(false);
            }
        };
        document.addEventListener('click', onClickOutside);
        return () => document.removeEventListener('click', onClickOutside);
    }, []);

    const isActive = (href) => (href === '/' ? currentPath === '/' : currentPath.startsWith(href));

    const logout = (e) => {
        e.preventDefault();
        router.post('/logout');
    };

    return (
        <>
            <header
                className={`fixed top-0 z-50 w-full transition-all duration-300 border-b ${
                    scrolled
                        ? 'bg-[#050810]/90 backdrop-blur-md border-white/5 shadow-[0_10px_30px_rgba(0,0,0,0.8)]'
                        : 'bg-transparent border-transparent'
                }`}
            >
                <div className="mx-auto flex w-full max-w-[1440px] items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                    <Link href="/" className="relative flex items-center h-10 w-48 shrink-0">
                        <img src="/logo.png" alt="WarGame" className="absolute left-0 top-1/2 -translate-y-1/2 h-42 w-auto max-w-none" />
                    </Link>

                    <nav className="hidden items-center gap-8 md:flex">
                        {navLinks.map((link) => (
                            <Link
                                key={link.href}
                                href={link.href}
                                className={`relative text-sm font-bold transition-colors group py-1 ${isActive(link.href) ? 'text-white' : 'text-gray-300 hover:text-white'}`}
                            >
                                {link.label}
                                <span className={`absolute bottom-0 left-0 h-[2px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full transition-transform duration-300 origin-left ${isActive(link.href) ? 'scale-x-100 shadow-[0_0_8px_rgba(34,197,94,0.8)]' : 'scale-x-0 group-hover:scale-x-100'}`} />
                            </Link>
                        ))}
                    </nav>

                    <div className="flex items-center gap-3 sm:gap-4">
                        <button aria-label="Search" className="p-2 hover:bg-white/5 rounded-lg transition-colors">
                            <svg viewBox="0 0 24 24" className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" strokeWidth="2">
                                <circle cx="11" cy="11" r="7" />
                                <path d="m20 20-3.5-3.5" />
                            </svg>
                        </button>

                        <Link href="/cart" aria-label="Keranjang" className="hidden md:flex relative items-center justify-center w-10 h-10 rounded-xl border border-white/10 bg-white/[0.04] hover:border-green-500/50 hover:bg-green-500/10 hover:shadow-[0_0_12px_rgba(34,197,94,0.2)] transition-all group">
                            <svg viewBox="0 0 24 24" className="w-[22px] h-[22px] text-gray-300 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                                <circle cx="9" cy="21" r="1" />
                                <circle cx="20" cy="21" r="1" />
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                            </svg>
                        </Link>

                        <div className="relative" ref={dropdownRef}>
                            {auth?.user ? (
                                <button onClick={() => setDropdownOpen((v) => !v)} className="flex items-center gap-2 md:gap-3 focus:outline-none transition-transform hover:scale-105">
                                    <img
                                        src={auth.user.avatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(auth.user.name)}&background=f97316&color=fff`}
                                        alt={auth.user.name}
                                        className="w-8 h-8 md:w-10 md:h-10 rounded-full border border-orange-500/50 object-cover shadow-[0_0_10px_rgba(249,115,22,0.3)]"
                                    />
                                    <span className="hidden md:inline-block text-sm font-bold text-white max-w-[120px] truncate">{auth.user.name}</span>
                                </button>
                            ) : (
                                <>
                                    <Link href="/login" className="hidden md:inline-block px-5 py-2 bg-orange-500 hover:bg-orange-400 rounded-lg text-white text-sm font-bold transition-all shadow-[0_0_15px_rgba(249,115,22,0.5)]">Masuk</Link>
                                    <button onClick={() => setDropdownOpen((v) => !v)} className="md:hidden relative flex items-center justify-center w-8 h-8 rounded-full border border-white/10 bg-white/[0.04] text-gray-300 hover:text-white hover:bg-white/10 transition-colors focus:outline-none">
                                        <svg viewBox="0 0 24 24" className="w-[18px] h-[18px]" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </button>
                                </>
                            )}

                            {dropdownOpen && (
                                <div className="absolute right-0 mt-3 w-40 bg-[#0a0f16] border border-white/10 rounded-xl shadow-[0_10px_30px_rgba(0,0,0,0.8)] py-2 flex flex-col z-[100]">
                                    {auth?.user ? (
                                        <button onClick={logout} className="flex w-full items-center gap-2 px-4 py-2 text-sm text-red-400 hover:bg-white/5 hover:text-red-300 transition-colors text-left">
                                            <svg viewBox="0 0 24 24" className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16 17 21 12 16 7" /><line x1="21" y1="12" x2="9" y2="12" /></svg>
                                            Keluar
                                        </button>
                                    ) : (
                                        <Link href="/login" className="md:hidden flex items-center gap-2 px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white transition-colors">
                                            <svg viewBox="0 0 24 24" className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" /><polyline points="10 17 15 12 10 7" /><line x1="15" y1="12" x2="3" y2="12" /></svg>
                                            Masuk
                                        </Link>
                                    )}
                                </div>
                            )}
                        </div>

                        <button aria-label="Menu" className="md:hidden relative p-2 text-gray-300 hover:text-white transition-colors" onClick={() => setMobileOpen(true)}>
                            <svg viewBox="0 0 24 24" className="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12" />
                                <line x1="3" y1="6" x2="21" y2="6" />
                                <line x1="3" y1="18" x2="21" y2="18" />
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            {mobileOpen && (
                <div className="fixed inset-0 bg-black/60 backdrop-blur-sm z-[55] md:hidden" onClick={() => setMobileOpen(false)} />
            )}

            <div className={`fixed top-0 right-0 h-screen w-[280px] bg-[#050810] border-l border-white/5 shadow-[-10px_0_30px_rgba(0,0,0,0.8)] z-[60] transform transition-transform duration-300 md:hidden flex flex-col ${mobileOpen ? 'translate-x-0' : 'translate-x-full'}`}>
                <div className="flex items-center justify-between p-5 border-b border-white/10">
                    <span className="text-white font-bold text-lg">Menu</span>
                    <button aria-label="Tutup Menu" className="p-2 text-gray-400 hover:text-white transition-colors rounded-lg hover:bg-white/5" onClick={() => setMobileOpen(false)}>
                        <svg className="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24" strokeLinecap="round" strokeLinejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
                <nav className="flex flex-col p-6 gap-8 overflow-y-auto">
                    {[{ href: '/', label: 'Home' }, { href: '/cart', label: 'Cart' }, { href: '/voucher', label: 'Voucher' }, { href: '/games', label: 'Games' }].map((link) => (
                        <Link key={link.href} href={link.href} onClick={() => setMobileOpen(false)} className={`flex flex-col w-max group transition-opacity duration-300 ${isActive(link.href) ? 'opacity-100' : 'opacity-60'}`}>
                            <span className="italic font-bold text-white text-[1.3rem]">{link.label}</span>
                            <span className={`h-[3px] w-full bg-gradient-to-r from-green-400 to-orange-500 rounded-full mt-1.5 transition-all duration-300 ${isActive(link.href) ? 'opacity-100 shadow-[0_0_8px_rgba(34,197,94,0.5)]' : 'opacity-0'}`} />
                        </Link>
                    ))}
                </nav>
            </div>
        </>
    );
}
