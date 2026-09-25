export function Skeleton({ className = '' }) {
    return <div className={`animate-pulse bg-white/[0.06] rounded-lg ${className}`} />;
}

export function GameCardSkeleton() {
    return (
        <div className="relative rounded-lg overflow-hidden bg-[#161920]/80 border border-white/5">
            <div className="w-full aspect-square animate-pulse bg-white/[0.06]" />
            <div className="p-3 space-y-2">
                <Skeleton className="h-3 w-2/3" />
            </div>
        </div>
    );
}

export function GameGridSkeleton({ count = 10 }) {
    return (
        <div className="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-4">
            {Array.from({ length: count }).map((_, i) => (
                <GameCardSkeleton key={i} />
            ))}
        </div>
    );
}

export function CartItemSkeleton() {
    return (
        <div className="bg-[#252d40]/80 border border-white/8 rounded-2xl p-4 flex items-center gap-3">
            <Skeleton className="w-5 h-5 flex-shrink-0" />
            <Skeleton className="w-12 h-12 rounded-xl flex-shrink-0" />
            <div className="flex-1 space-y-2">
                <Skeleton className="h-3.5 w-1/3" />
                <Skeleton className="h-2.5 w-1/2" />
                <Skeleton className="h-3.5 w-1/4" />
            </div>
        </div>
    );
}
