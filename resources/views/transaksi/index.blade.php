<x-layout>
    <x-slot:title>Bridges Terminal - Transaction History</x-slot:title>

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <span class="text-neon-blue text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
                [ Central Core / Archive ]
            </span>
            <h2 class="fw-bold mt-1" style="color: var(--text-main) !important;">TRANSACTION ARCHIVE</h2>
        </div>
        <a href="{{ url('/transaksi') }}" class="btn btn-outline-info rounded-0 fw-bold tracking-wider">
            + NEW ORDER
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success bg-opacity-10 border-success text-success rounded-0 mb-4 tracking-wide small">
        ⚡ {{ session('success') }}
    </div>
    @endif

    <!-- TABEL MANIFEST RIWAYAT -->
    <div class="card ds-card shadow-lg p-3">
        <div class="table-responsive">
            <!-- Memaksa background transparan agar mengikuti warna kartu utama -->
            <table class="table table-hover align-middle mb-0" style="background-color: transparent !important;">
                <thead class="border-secondary">
                    <tr class="text-neon-orange small tracking-wider">
                        <th style="background-color: transparent !important; color: var(--text-main) !important;">DATE TIME</th>
                        <th style="background-color: transparent !important; color: var(--text-main) !important;">TRANSACTION CODE</th>
                        <th style="background-color: transparent !important; color: var(--text-main) !important;">OPERATOR (CASHIER)</th>
                        <th style="background-color: transparent !important; color: var(--text-main) !important;">GRAND TOTAL</th>
                        <th style="background-color: transparent !important; color: var(--text-main) !important;">CASH TENDERED</th>
                        <th style="background-color: transparent !important; color: var(--text-main) !important;">CHANGE</th>
                        <th style="background-color: transparent !important; color: var(--text-main) !important;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="border-secondary">
                    @forelse($transaksi as $row)
                    <tr style="background-color: transparent !important;">
                        <td style="background-color: transparent !important; color: var(--text-muted) !important; font-size: 0.9rem;">
                            {{ $row->created_at->format('Y-m-d H:i:s') }}
                        </td>
                        <td style="background-color: transparent !important;">
                            <span class="badge bg-dark text-neon-blue border border-info border-opacity-25 px-2 py-1">
                                {{ $row->kode_transaksi }}
                            </span>
                        </td>
                        <td style="background-color: transparent !important; color: var(--text-main) !important; font-weight: bold;">
                            {{ $row->user->name ?? 'Unknown' }}
                        </td>
                        <td style="background-color: transparent !important; color: var(--text-neon-orange, #fd7e14) !important; font-weight: bold;">
                            Rp {{ number_format($row->total, 0, ',', '.') }}
                        </td>
                        <td style="background-color: transparent !important; color: var(--text-main) !important;">
                            Rp {{ number_format($row->bayar, 0, ',', '.') }}
                        </td>
                        <td style="background-color: transparent !important; color: #28a745 !important; font-weight: bold;">
                            Rp {{ number_format($row->kembalian, 0, ',', '.') }}
                        </td>
                        <td style="background-color: transparent !important;">
                        <a href="{{ url('/transaksi/print/' . $row->id) }}" target="_blank" class="btn btn-sm btn-outline-warning rounded-0 py-0 px-2 small">
                            🖨️ PRINT
                        </a>
</td>
                    </tr>
                    @empty
                    <tr style="background-color: transparent !important;">
                        <td colspan="6" class="text-center py-5" style="background-color: transparent !important; color: var(--text-muted) !important;">
                            [ NO TRANSACTION RECORDED IN NETWORKS ]
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>