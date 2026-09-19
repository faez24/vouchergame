export default function Home({ appName, message }) {
    const games = [
        { name: 'Mobile Legends', tag: 'Top Up', color: '#f97316' },
        { name: 'Free Fire', tag: 'Popular', color: '#22c55e' },
        { name: 'PUBG Mobile', tag: 'Trending', color: '#a78bfa' },
        { name: 'Valorant', tag: 'New', color: '#facc15' },
    ];

    return (
        <main style={{
            minHeight: '100vh',
            background: 'linear-gradient(180deg, #0f172a 0%, #111827 40%, #1f2937 100%)',
            color: '#f8fafc',
            fontFamily: 'Poppins, Arial, sans-serif',
            padding: '32px 20px 80px',
        }}>
            <div style={{ maxWidth: 1200, margin: '0 auto' }}>
                <header style={{
                    display: 'flex',
                    justifyContent: 'space-between',
                    alignItems: 'center',
                    padding: '12px 0 30px',
                    borderBottom: '1px solid rgba(255,255,255,0.08)',
                }}>
                    <div style={{ fontWeight: 900, letterSpacing: '0.12em', fontSize: 18 }}>{appName}</div>
                    <nav style={{ display: 'flex', gap: 20, color: '#cbd5e1', fontSize: 14 }}>
                        <span>Game</span>
                        <span>Voucher</span>
                        <span>Top Up</span>
                        <span>Login</span>
                    </nav>
                </header>

                <section style={{
                    display: 'grid',
                    gridTemplateColumns: '1.2fr 0.8fr',
                    gap: 28,
                    alignItems: 'center',
                    paddingTop: 40,
                }}>
                    <div>
                        <p style={{
                            display: 'inline-block',
                            background: 'rgba(34,197,94,0.15)',
                            color: '#86efac',
                            border: '1px solid rgba(134,239,172,0.35)',
                            padding: '8px 12px',
                            borderRadius: 999,
                            fontWeight: 700,
                            fontSize: 12,
                            letterSpacing: '0.12em',
                            textTransform: 'uppercase',
                        }}>
                            Marketplace Game
                        </p>

                        <h1 style={{
                            fontSize: 'clamp(2.4rem, 5vw, 4.4rem)',
                            lineHeight: 1.05,
                            margin: '18px 0 18px',
                            fontWeight: 900,
                        }}>
                            Top up game <span style={{ color: '#4ade80' }}>lebih cepat</span>
                        </h1>

                        <p style={{
                            maxWidth: 560,
                            color: '#cbd5e1',
                            fontSize: 18,
                            lineHeight: 1.7,
                            marginBottom: 26,
                        }}>
                            {message}
                        </p>

                        <div style={{ display: 'flex', gap: 16, flexWrap: 'wrap' }}>
                            <button style={{
                                border: 'none',
                                background: 'linear-gradient(135deg, #22c55e, #16a34a)',
                                color: '#fff',
                                borderRadius: 12,
                                padding: '14px 22px',
                                fontWeight: 700,
                                cursor: 'pointer',
                                boxShadow: '0 12px 24px rgba(34,197,94,0.3)',
                            }}>
                                Mulai Top Up
                            </button>
                            <button style={{
                                border: '1px solid rgba(255,255,255,0.12)',
                                background: 'rgba(15,23,42,0.45)',
                                color: '#f8fafc',
                                borderRadius: 12,
                                padding: '14px 22px',
                                fontWeight: 700,
                                cursor: 'pointer',
                            }}>
                                Lihat Voucher
                            </button>
                        </div>
                    </div>

                    <div style={{
                        background: 'rgba(15,23,42,0.72)',
                        border: '1px solid rgba(255,255,255,0.08)',
                        borderRadius: 24,
                        padding: 24,
                        boxShadow: '0 30px 60px rgba(0,0,0,0.28)',
                    }}>
                        <div style={{
                            background: 'linear-gradient(135deg, rgba(34,197,94,0.18), rgba(59,130,246,0.12))',
                            borderRadius: 18,
                            padding: 18,
                            border: '1px solid rgba(148,163,184,0.16)',
                        }}>
                            <div style={{ fontSize: 12, letterSpacing: '0.15em', textTransform: 'uppercase', color: '#86efac', fontWeight: 700 }}>Popular Right Now</div>
                            <div style={{ marginTop: 18, display: 'grid', gap: 14 }}>
                                {games.map((game) => (
                                    <div key={game.name} style={{
                                        display: 'flex',
                                        justifyContent: 'space-between',
                                        alignItems: 'center',
                                        background: 'rgba(15,23,42,0.7)',
                                        border: '1px solid rgba(255,255,255,0.08)',
                                        borderRadius: 14,
                                        padding: '12px 14px',
                                    }}>
                                        <div>
                                            <div style={{ fontWeight: 700 }}>{game.name}</div>
                                            <div style={{ color: '#94a3b8', fontSize: 12 }}>{game.tag}</div>
                                        </div>
                                        <div style={{
                                            width: 12,
                                            height: 12,
                                            borderRadius: '50%',
                                            background: game.color,
                                            boxShadow: `0 0 18px ${game.color}`,
                                        }} />
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    );
}
