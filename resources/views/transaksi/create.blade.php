<x-layout>
    <x-slot:title>Bridges Terminal - Delivery Orders</x-slot:title>

    <div class="row g-4">
        <div class="col-xl-7">
            <div class="mb-4">
                <span class="text-neon-orange text-uppercase fw-bold tracking-wide" style="font-size: 0.8rem; letter-spacing: 2px;">
                    [ Terminal Node / Logistics ]
                </span>
                <h2 class="fw-bold mt-1" style="color: var(--text-main);">COMMODITY CATALOG</h2>
            </div>
            
            <div class="row g-3">
                @forelse($produk as $item)
                <div class="col-md-6 col-lg-4 col-xl-6">
                    <div class="card ds-card shadow-sm h-100 p-3 text-center" style="cursor: pointer; transition: transform 0.2s;" 
                         onclick="addToCart({{ $item->id }}, '{{ $item->nama_produk }}', {{ $item->harga_jual }}, {{ $item->stok }})"
                         onmouseover="this.style.transform='scale(1.02)'" 
                         onmouseout="this.style.transform='scale(1)'">
                        
                        <div class="badge bg-dark bg-opacity-50 text-neon-blue border border-info border-opacity-25 mb-2 mx-auto px-2">
                            {{ $item->kode_produk }}
                        </div>
                        <h6 class="fw-bold text-white mb-1">{{ $item->nama_produk }}</h6>
                        <div class="text-neon-orange fw-bold small mb-2">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                        <div class="small ds-text-fix border-top border-secondary pt-2 mt-auto">
                            Stok Tersedia: <span class="text-white fw-bold">{{ $item->stok }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <span class="ds-text-fix">[ NO CARGO AVAILABLE IN NETWORK ]</span>
                </div>
                @endforelse
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card ds-card shadow-lg p-4 sticky-top" style="top: 20px;">
                <h5 class="text-neon-blue fw-bold mb-4 border-bottom border-secondary pb-3 tracking-wider">
                    ACTIVE MANIFEST CART
                </h5>
                
                <form action="{{ url('/transaksi/store') }}" method="POST" id="checkoutForm">
                    @csrf
                    
                    <div id="cart-items" class="mb-4" style="min-height: 150px; max-height: 300px; overflow-y: auto;">
                        <div class="text-center ds-text-fix small py-5">[ Cart is Empty ]</div>
                    </div>

                    <div class="border-top border-secondary pt-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold ds-text-fix tracking-wide">GRAND TOTAL:</span>
                            <span class="fw-bold text-neon-orange fs-4" id="display-total">Rp 0</span>
                        </div>
                        <input type="hidden" name="total" id="input-total" value="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-neon-blue small fw-bold tracking-wider">CASH TENDERED (DIBAYAR)</label>
                        <input type="number" name="bayar" id="input-bayar" class="form-control bg-transparent text-white border-secondary fs-5" required onkeyup="calculateChange()" onchange="calculateChange()">
                    </div>

                    <div class="mb-4 p-3" style="background: rgba(0,255,0,0.05); border-left: 3px solid #28a745;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold ds-text-fix small tracking-wider">CHANGE (KEMBALIAN):</span>
                            <span class="fw-bold text-success fs-4" id="display-kembalian">Rp 0</span>
                        </div>
                        <input type="hidden" name="kembalian" id="input-kembalian" value="0">
                    </div>

                    <button type="submit" class="btn btn-outline-success w-100 fw-bold rounded-0 py-3 tracking-widest" id="btn-checkout" disabled>
                        ⚡ COMMIT TRANSACTION
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Objek untuk menampung data barang yang dipilih
        let cart = {};
        let totalBelanja = 0;

        // Fungsi menambah barang saat kartu di klik
        function addToCart(id, name, price, maxStok) {
            if(cart[id]) {
                if(cart[id].qty < maxStok) {
                    cart[id].qty++; // Tambah kuantitas jika stok cukup
                } else {
                    alert('[ ERROR: Insufficient Cargo Stock for ' + name + ' ]');
                    return;
                }
            } else {
                // Masukkan barang baru ke keranjang
                cart[id] = { name: name, price: price, qty: 1, max: maxStok };
            }
            updateCartUI(); // Perbarui tampilan
        }

        // Fungsi menghapus barang dari keranjang
        function removeFromCart(id) {
            delete cart[id];
            updateCartUI();
        }

        // Fungsi mencetak ulang UI keranjang di sebelah kanan
        function updateCartUI() {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = '';
            totalBelanja = 0;
            let hasItems = false;

            for (let id in cart) {
                hasItems = true;
                let item = cart[id];
                let subtotal = item.price * item.qty;
                totalBelanja += subtotal;

                // Mencetak elemen HTML keranjang menggunakan template literal JavaScript
                cartContainer.innerHTML += `
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-secondary border-opacity-25">
                        <div class="pe-2">
                            <div class="fw-bold text-white mb-1" style="font-size: 0.9rem;">${item.name}</div>
                            <div class="small ds-text-fix">${item.qty} Unit(s) x Rp ${item.price.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="text-end">
                            <div class="text-neon-orange fw-bold mb-2">Rp ${subtotal.toLocaleString('id-ID')}</div>
                            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" style="font-size: 0.7rem;" onclick="removeFromCart(${id})">DROP</button>
                        </div>
                        
                        <input type="hidden" name="produk_id[]" value="${id}">
                        <input type="hidden" name="qty[]" value="${item.qty}">
                        <input type="hidden" name="harga[]" value="${item.price}">
                    </div>
                `;
            }

            if(!hasItems) {
                cartContainer.innerHTML = '<div class="text-center ds-text-fix small py-5">[ Cart is Empty ]</div>';
            }

            // Perbarui teks grand total dan value input hidden
            document.getElementById('display-total').innerText = 'Rp ' + totalBelanja.toLocaleString('id-ID');
            document.getElementById('input-total').value = totalBelanja;
            
            // Picu hitung ulang kembalian
            calculateChange();
        }

        // Fungsi otomatis menghitung kembalian dan mengaktifkan tombol Submit
        function calculateChange() {
            let bayar = document.getElementById('input-bayar').value || 0;
            let kembalian = bayar - totalBelanja;
            let btnCheckout = document.getElementById('btn-checkout');

            if (bayar >= totalBelanja && totalBelanja > 0) {
                document.getElementById('display-kembalian').innerText = 'Rp ' + kembalian.toLocaleString('id-ID');
                document.getElementById('input-kembalian').value = kembalian;
                btnCheckout.disabled = false; // Buka kunci tombol eksekusi
            } else {
                document.getElementById('display-kembalian').innerText = 'Rp 0';
                document.getElementById('input-kembalian').value = 0;
                btnCheckout.disabled = true; // Kunci kembali tombol eksekusi
            }
        }
    </script>
</x-layout>