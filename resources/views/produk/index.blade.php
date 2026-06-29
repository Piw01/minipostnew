<x-layout>
    <x-slot:title>Bridges Terminal - Cargo Management</x-slot:title>

    <div class="mb-4">
        <span class="text-neon-blue text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
            [ Manifest Data / Inventory ]
        </span>
        <h1 class="fw-bold mt-1" style="color: var(--text-main);">CARGO MANAGEMENT CONTROL</h1>
    </div>

    <div class="mb-3 text-end">
        <a href="{{ url('/produk/create') }}" class="btn btn-sm btn-outline-info rounded-0 tracking-wider fw-bold">
            ➕ REGISTER NEW CARGO
        </a>
    </div>
    
    <div class="card ds-card shadow-lg p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0 ds-table">
                <thead>
                    <tr class="text-neon-orange" style="font-size: 0.85rem; letter-spacing: 1px;">
                        <th>NO</th>
                        <th>KODE KARGO</th>
                        <th>NAMA PRODUK</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th>STOK COUNTER</th>
                        <th style="color: var(--neon-orange);">ACTION</th>
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

                            <td>
                                <a href="{{ url('/produk/'.$item->id.'/edit') }}" class="btn btn-sm btn-outline-warning rounded-0 py-0 px-2 small me-1" style="font-size: 0.75rem;">
                                    EDIT
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-0 py-0 px-2 small btn-delete-trigger" style="font-size: 0.75rem;" data-url="{{ url('/produk/'.$item->id.'/delete') }}">
                                    DEL
                                </button>
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
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ds-card p-3" style="background: var(--bg-sidebar); border: 1px solid var(--border-color); border-radius: 0px;">
            
            <style>
                #deleteConfirmModal .ds-card::before { background-color: var(--neon-orange) !important; }
            </style>

            <div class="modal-header border-0 pb-1">
                <h5 class="modal-title text-neon-orange fw-bold tracking-wider" style="font-size: 1rem;">
                    ⚠️ [ WARNING ]
                </h5>
            </div>
            
            <div class="modal-body py-3">
                <p class="m-0" style="color: var(--text-main); font-size: 0.9rem; letter-spacing: 0.5px; line-height: 1.5;">
                    Apakah Anda yakin ingin menghapus item komoditas kargo ini? Tindakan ini akan memutuskan data manifes dari Jaringan Chiral secara permanen.
                </p>
            </div>
            
            <div class="modal-footer border-0 pt-1 d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-0 px-3 tracking-wide" data-bs-dismiss="modal">
                    ◀ ABORT
                </button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-sm btn-outline-danger rounded-0 px-4 fw-bold tracking-wide">
                    💥 DELETE
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menangkap semua tombol hapus di tabel
        const deleteButtons = document.querySelectorAll('.btn-delete-trigger');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        
        // Inisialisasi komponen modal Bootstrap 5
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));

        // Menambahkan event klik ke setiap tombol hapus di baris tabel
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Mengambil URL hapus milik produk terkait dari atribut data-url
                const targetUrl = this.getAttribute('data-url');
                
                // Menyuntikkan URL tersebut ke tombol eksekusi "DECOMMISSION" di dalam modal
                confirmDeleteBtn.setAttribute('href', targetUrl);
                
                // Munculkan modal ke layar terminal
                deleteModal.show();
            });
        });
    });
</script>