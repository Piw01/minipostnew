<x-layout>
    <x-slot:title>Bridges Terminal - Cargo Management</x-slot:title>

    <div class="mb-4">
        <span class="text-neon-blue text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
            [ Manifest Data / Inventory ]
        </span>
        <h1 class="fw-bold mt-1" style="color: var(--text-main);">CARGO MANAGEMENT CONTROL</h1>
    </div>

    <div class="card ds-card shadow-lg p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0 ds-table">
                <thead>
                    <tr class="text-neon-orange" style="font-size: 0.85rem; letter-spacing: 1px;">
                        <th>NO</th>
                        <th>KODE KARGO</th>
                        <th>NAMA KOMODITAS</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th>STOK COUNTER</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data_produk as $item)
                        <tr>
                            <td class="fw-bold text-neon-blue">{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-dark bg-opacity-10 text-neon-blue border border-info border-opacity-25 px-2 py-1">
                                    {{ $item->kode_produk }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ $item->nama_produk }}</td>
                            <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td>
                                <span class="fw-bold {{ $item->stok < 50 ? 'text-neon-orange' : 'text-success' }}">
                                    {{ $item->stok }} Units
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 ds-text-fix">
                                [ No Cargo Registered In Chiral Network ]
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>