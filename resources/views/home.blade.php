<x-layout>
    <x-slot:title>Bridges Network - Dashboard</x-slot:title>

    <div class="mb-4">
        <span class="text-neon-blue text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
            [ System Status / Online ]
        </span>
        <h2 class="fw-bold mt-1" style="color: var(--text-main);">BRIDGES NETWORK DASHBOARD</h2>
    </div>

    <!-- ROW STATISTIK UTAMA -->
    <div class="row g-4">
        <!-- KARTU 1: TOTAL OMSET PENDAPATAN -->
        <div class="col-md-4">
            <div class="card ds-card shadow-sm p-4 border-left-primary" style="border-left: 4px solid var(--neon-blue) !important;">
                <div class="small text-uppercase tracking-wider mb-1" style="color: var(--text-muted); font-size: 0.75rem;">
                    TOTAL NET REVENUE
                </div>
                <h3 class="fw-bold text-neon-blue m-0">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h3>
            </div>
        </div>

        <!-- KARTU 2: JUMLAH MANIFEST TRANSAKSI -->
        <div class="col-md-4">
            <div class="card ds-card shadow-sm p-4" style="border-left: 4px solid #28a745 !important;">
                <div class="small text-uppercase tracking-wider mb-1" style="color: var(--text-muted); font-size: 0.75rem;">
                    COMMITTED MANIFESTS
                </div>
                <h3 class="fw-bold text-success m-0">
                    {{ $jumlahTransaksi }} Transaction(s)
                </h3>
            </div>
        </div>

        <!-- KARTU 3: TOTAL VARIAN KARGO GUDANG -->
        <div class="col-md-4">
            <div class="card ds-card shadow-sm p-4" style="border-left: 4px solid #fd7e14 !important;">
                <div class="small text-uppercase tracking-wider mb-1" style="color: var(--text-muted); font-size: 0.75rem;">
                    REGISTERED COMMODITIES
                </div>
                <h3 class="fw-bold text-neon-orange m-0">
                    {{ $totalProduk }} Item Varian
                </h3>
            </div>
        </div>
    </div>

    <!-- AREA VISUAL PEMANIS TERMINAL NODE -->
    <div class="card ds-card shadow-lg p-4 mt-4 text-center">
        <div class="py-4">
            <span class="text-neon-blue d-block mb-2 font-monospace">[ CONNECTIVITY BLOCK ESTABLISHED ]</span>
            <p class="m-0 mx-auto style-fix" style="max-width: 600px; color: var(--text-muted);">
                Semua node logistik regional Subang berjalan stabil. Sinkronisasi data inventaris kargo produk dan pencatatan transaksi kasir terenkripsi otomatis ke jaringan inti server utama.
            </p>
        </div>
    </div>
</x-layout>