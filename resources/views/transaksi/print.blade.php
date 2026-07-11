<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Receipt - {{ $transaksi->kode_transaksi }}</title>
    <style>
        /* Mengatur ukuran kertas thermal standar (80mm) */
        @page {
            size: 80mm;
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 76mm;
            margin: 0 auto;
            padding: 5mm 2mm;
            font-size: 12px;
            color: #000;
            background: #fff;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        .header h3 { margin: 0 0 5px 0; font-size: 16px; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 11px; }
        .meta-table, .item-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }
        .meta-table td { padding: 2px 0; font-size: 11px; }
        .item-table th { text-align: left; border-bottom: 1px solid #000; padding: 3px 0; }
        .item-table td { padding: 4px 0; vertical-align: top; }
        .total-section {
            margin-top: 5px;
            width: 100%;
        }
        .total-section td { padding: 2px 0; }
        .footer { margin-top: 15px; font-size: 10px; }
    </style>
</head>
<body>

    <!-- HEADER NOTA OUTPOST -->
    <div class="header text-center">
        <h3>BRIDGES TERMINAL</h3>
        <p>Distribution Node Network v2.0</p>
        <p>Jl. Logistik Kargo Gudang Utama, Subang</p>
    </div>

    <div class="line"></div>

    <!-- DATA ADMINISTRASI NOTA -->
    <table class="meta-table">
        <tr>
            <td>NOTA : {{ $transaksi->kode_transaksi }}</td>
            <td class="text-right">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>KASIR: {{ $transaksi->user->name ?? 'Operator' }}</td>
            <td class="text-right">STATUS: COMMITTED</td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- DAFTAR ITEM BARANG YANG DIKIRIM -->
    <table class="item-table">
        <thead>
            <tr>
                <th style="width: 50%;">ITEM</th>
                <th class="text-center" style="width: 15%;">QTY</th>
                <th class="text-right" style="width: 35%;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->detailTransaksi as $detail)
            <tr>
                <td>
                    {{ $detail->produk->nama_produk }}<br>
                    <small>@Rp {{ number_format($detail->harga, 0, ',', '.') }}</small>
                </td>
                <td class="text-center">{{ $detail->qty }}</td>
                <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="line"></div>

    <!-- RINGKASAN PEMBAYARAN KASIR -->
    <table class="total-section">
        <tr>
            <td style="width: 60%; font-weight: bold;">GRAND TOTAL:</td>
            <td class="text-right" style="width: 40%; font-weight: bold;">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>TUNAI (BAYAR):</td>
            <td class="text-right">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td>KEMBALIAN:</td>
            <td class="text-right">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- FOOTER MANIFEST -->
    <div class="footer text-center">
        <p>=== THANK YOU FOR YOUR DELIVERY ===</p>
        <p>Keep the connections alive. Chiral network secured.</p>
    </div>

    <!-- JAVASCRIPT AUTO-PRINT & AUTO-CLOSE -->
    <script>
        window.onload = function() {
            window.print();
            // Otomatis menutup tab setelah jendela print browser selesai/dibatalkan
            window.onafterprint = function() {
                window.close();
            };
        }
    </script>

</body>
</html>