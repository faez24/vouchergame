import { useState } from 'react';

export default function ImageWithSkeleton({ src, alt = '', className = '', imgClassName = '', ...props }) {
    const [loaded, setLoaded] = useState(false);
    const [errored, setErrored] = useState(false);

    return (
        <div className={`relative overflow-hidden ${className}`}>
            {!loaded && !errored && (
                <div className="absolute inset-0 animate-pulse bg-white/[0.06]" />
            )}
            {errored ? (
                <div className="absolute inset-0 flex items-center justify-center bg-white/[0.04] text-gray-600">
                    <svg className="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.5">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            ) : (
                <img
                    src={src}
                    alt={alt}
                    loading="lazy"
                    onLoad={() => setLoaded(true)}
                    onError={() => setErrored(true)}
                    className={`transition-opacity duration-300 ${loaded ? 'opacity-100' : 'opacity-0'} ${imgClassName}`}
                    {...props}
                />
            )}
        </div>
    );
}
