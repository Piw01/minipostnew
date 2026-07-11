<x-layout>
    <x-slot:title>Bridges Gateway - API Third Party Monitor</x-slot:title>

    <div class="mb-4">
        <span class="text-neon-orange text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
            [ CORE INTEGRATION / THIRD-PARTY API SIMULATOR ]
        </span>
        <h2 class="fw-bold mt-1" style="color: var(--text-main) !important;">EXTERNAL INTEGRATION NODE</h2>
    </div>

    <div class="row g-4">
        <!-- FORM KONTROL KIRI -->
        <div class="col-md-5">
            <div class="card ds-card shadow-sm p-4">
                <h5 class="fw-bold text-neon-blue mb-3">MIDTRANS SIMULATOR</h5>
                <!-- Memaksa warna deskripsi mengikuti variabel text-muted -->
                <p class="small mb-4" style="color: var(--text-muted) !important;">
                    Simulasi pengiriman data manifest logistik kasir ke endpoint payment gateway pihak ketiga via Asynchronous JavaScript.
                </p>

                <div class="mb-3">
                    <!-- Memaksa warna label mengikuti variabel text-main -->
                    <label class="form-label small fw-bold tracking-wider" style="color: var(--text-main) !important;">INPUT TRANSACTION CODE</label>
                    <input type="text" id="kodeTransaksiInput" class="form-control bg-transparent border-secondary rounded-0" placeholder="Contoh: TR-20260710-OWKC" style="color: var(--text-main) !important;">
                </div>

                <button type="button" id="btnTembakAPI" class="btn btn-outline-warning rounded-0 fw-bold w-100 tracking-wider">
                    🚀 TRIGGER API FETCH REQUEST
                </button>
            </div>
        </div>

        <!-- LAYAR MONITOR JSON KANAN -->
        <div class="col-md-7">
            <div class="card ds-card shadow-sm p-4 h-100 d-flex flex-column">
                <h5 class="fw-bold text-success mb-3">LIVE API RESPONSE MONITOR</h5>
                
                <div class="flex-grow-1 p-3 font-monospace rounded-0 style-fix" id="jsonConsole" style="background: #090d16; color: #39ff14; min-height: 250px; overflow-y: auto; font-size: 11px; border: 1px solid #1e293b;">
                    // Menunggu trigger dari network node... Klik tombol di kiri untuk menembak API.
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btnTembakAPI').addEventListener('click', async function() {
            const kodeInput = document.getElementById('kodeTransaksiInput').value.trim();
            const consoleBox = document.getElementById('jsonConsole');

            if (!kodeInput) {
                consoleBox.innerHTML = `<span style="color: #ff3333;">[ERROR]: Masukkan kode transaksi terlebih dahulu!</span>`;
                return;
            }

            consoleBox.innerHTML = `[CONNECTING]: Establishing handshake with Midtrans Mock API Server...<br>[SENDING PAYLOAD]: Sending order_id: ${kodeInput}...`;

            try {
                const response = await fetch('/api/v1/payment/check-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ kode_transaksi: kodeInput })
                });

                const hasilJSON = await response.json();
                consoleBox.innerHTML = `[SUCCESS] HTTP STATUS: ${response.status}\n\n` + JSON.stringify(hasilJSON, null, 4);
                consoleBox.style.color = '#39ff14';

            } catch (error) {
                consoleBox.innerHTML = `[NETWORK CRASH]: Gagal terhubung ke API Node.\nDetail: ${error.message}`;
                consoleBox.style.color = '#ff3333';
            }
        });
    </script>
</x-layout>