<!DOCTYPE html>
<html>
<head>
    <title>Laporan Booking Studio</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Booking Studio</h2>
    <p style="text-align: center; font-size: 12px;">
        Dicetak pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y H:i') }}
    </p>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kode Booking</th>
                <th>Tanggal Booking</th>
                <th>Ruangan</th>
                <th class="text-right">Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_pemesan ?? '-' }}</td>
                <td>{{ $item->booking->kode_booking ?? '-' }}</td>
                <td>{{ $item->booking->tanggal ? \Carbon\Carbon::parse($item->booking->tanggal)->format('d/m/Y') : '-' }}</td>
                <td>{{ $item->booking->ruangan->nama?? '-' }}</td>
                <td class="text-right">
                    Rp{{ number_format($item->total_pembayaran, 0, ',', '.') }}
                </td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>