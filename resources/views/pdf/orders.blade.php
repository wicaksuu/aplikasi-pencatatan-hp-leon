<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Data Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Laporan Data Pesanan</h2>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>No Order</th>
                <th>No VA</th>
                <th>Platform</th>
                <th>Qty</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ $order->nama_barang }}</td>
                    <td>{{ $order->no_order }}</td>
                    <td>{{ $order->nomor_va ?: '-' }}</td>
                    <td>{{ $order->platform }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" style="text-align: right;">Total Keseluruhan</th>
                <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
