<x-layout>
    <x-slot:title>UCA Terminal - Home</x-slot:title>

    <div class="mb-4">
        <span class="text-neon-orange text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
            [ System Status: Online ]
        </span>
        <h1 class="fw-bold mt-1" style="color: var(--text-main);">MAP & INFORMATION TERMINAL</h1>
    </div>

    <div class="card ds-card shadow-lg p-2">
        <div class="card-body">
            <h4 class="card-title text-neon-blue fw-bold mb-3">WELCOME, OPERATOR QI</h4>
            <p class="ds-text-fix" style="font-size: 0.95rem;">
                Sistem database lokal berhasil terhubung ke jaringan Chiral Knot. Seluruh data kargo komoditas dan manifes pengiriman siap diproses melalui repositori <span class="text-neon-blue fw-bold">MiniPost System</span>.
            </p>
            
            <div class="row g-3 mt-4">
                <div class="col-md-6 col-xl-4">
                    <div class="p-3 border-bottom border-secondary bg-dark bg-opacity-10">
                        <div class="text-uppercase ds-text-fix small style-track" style="letter-spacing: 1px; font-size: 0.75rem;">CARGO ITEMS AVAILABLE</div>
                        <div class="fs-1 fw-bold text-neon-blue mt-1">{{ $jumlah_produk }} <span class="fs-6 ds-text-fix fw-normal">Units</span></div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="p-3 border-bottom border-secondary bg-dark bg-opacity-10">
                        <div class="text-uppercase ds-text-fix small style-track" style="letter-spacing: 1px; font-size: 0.75rem;">DELIVERY SUCCESS RATE</div>
                        <div class="fs-1 fw-bold text-neon-orange mt-1">100<span class="fs-4 text-neon-orange">%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>