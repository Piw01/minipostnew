<x-layout>
    <x-slot:title>Bridges Terminal - Edit Cargo</x-slot:title>

    <div class="mb-4">
        <span class="text-neon-orange text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
            [ Central Node / Maintenance ]
        </span>
        <h1 class="fw-bold mt-1" style="color: var(--text-main);">REconfigure CARGO MANIFEST</h1>
    </div>

    <div class="card ds-card shadow-lg p-4" style="max-width: 600px;">
        <form action="{{ url('/produk/'.$produk->id.'/update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label small text-uppercase tracking-wider fw-semibold" style="color: var(--neon-blue);">Kode Kargo / Produk</label>
                <input type="text" name="kode_produk" class="form-control bg-transparent rounded-0 text-white border-secondary @error('kode_produk') is-invalid @enderror" value="{{ old('kode_produk', $produk->kode_produk) }}" style="color: var(--text-main) !important;">
                @error('kode_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label small text-uppercase tracking-wider fw-semibold" style="color: var(--neon-blue);">Nama Komoditas</label>
                <input type="text" name="nama_produk" class="form-control bg-transparent rounded-0 text-white border-secondary @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk', $produk->nama_produk) }}" style="color: var(--text-main) !important;">
                @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small text-uppercase tracking-wider fw-semibold" style="color: var(--neon-blue);">Harga Beli (Modal)</label>
                    <input type="number" name="harga_beli" class="form-control bg-transparent rounded-0 text-white border-secondary @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli', $produk->harga_beli) }}" style="color: var(--text-main) !important;">
                    @error('harga_beli') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small text-uppercase tracking-wider fw-semibold" style="color: var(--neon-blue);">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control bg-transparent rounded-0 text-white border-secondary @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $produk->harga_jual) }}" style="color: var(--text-main) !important;">
                    @error('harga_jual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small text-uppercase tracking-wider fw-semibold" style="color: var(--neon-blue);">Jumlah Stok Counter</label>
                <input type="number" name="stok" class="form-control bg-transparent rounded-0 text-white border-secondary @error('stok') is-invalid @enderror" value="{{ old('stok', $produk->stok) }}" style="color: var(--text-main) !important;">
                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ url('/produk') }}" class="btn btn-sm btn-outline-secondary rounded-0 px-3">◀ BACK</a>
                <button type="submit" class="btn btn-sm btn-outline-warning rounded-0 px-4 fw-bold">⚡ UPDATE MANIFEST</button>
            </div>
        </form>
    </div>
</x-layout> 