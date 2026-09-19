export default function SmokeBackground({ variant = 'full' }) {
    return (
        <div className="pointer-events-none fixed inset-0 overflow-hidden z-0">
            <style>{`
                .bg-noise { background-image: radial-gradient(rgba(255,255,255,0.025) 0.8px, transparent 0.8px); background-size: 18px 18px; }
                @keyframes smoke-a { 0%{transform:translate3d(0,0,0) scale(1);opacity:.5} 50%{transform:translate3d(-30px,-20px,0) scale(1.08);opacity:.3} 100%{transform:translate3d(0,0,0) scale(1);opacity:.5} }
                @keyframes smoke-b { 0%{transform:translate3d(0,0,0) scale(1);opacity:.4} 50%{transform:translate3d(25px,20px,0) scale(1.1);opacity:.2} 100%{transform:translate3d(0,0,0) scale(1);opacity:.4} }
                .smoke-a { animation: smoke-a 16s ease-in-out infinite; will-change: transform, opacity; }
                .smoke-b { animation: smoke-b 20s ease-in-out infinite; will-change: transform, opacity; }
                @keyframes slide-smoke { 0% { transform: translate3d(0,0,0); } 100% { transform: translate3d(-50%,0,0); } }
                .moving-smoke-1 {
                    position: absolute; top: 0; left: 0; width: 200%; height: 100%;
                    background-image: url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog1.png');
                    background-repeat: repeat-x; background-size: 50% 100%;
                    opacity: 0.85; filter: brightness(1.2) contrast(1.2);
                    animation: slide-smoke 70s linear infinite;
                    mix-blend-mode: screen; will-change: transform;
                }
            `}</style>

            <div className="moving-smoke-1" />
            <div className="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60" />
            <div className="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/50" />
            <div className="smoke-a absolute top-[-5%] left-[-20%] w-[80vw] h-[70vw] max-w-[1000px] max-h-[800px] rounded-full bg-slate-500/15 blur-[110px]" />
            <div className="smoke-b absolute top-[25%] right-[-25%] w-[85vw] h-[75vw] max-w-[1050px] max-h-[850px] rounded-full bg-slate-400/12 blur-[120px]" />
            {variant === 'full' && (
                <div className="smoke-a absolute bottom-[5%] left-[5%] w-[65vw] h-[55vw] max-w-[850px] max-h-[650px] rounded-full bg-slate-600/10 blur-[100px]" />
            )}
        </div>
    );
}
