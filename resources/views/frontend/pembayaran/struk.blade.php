<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Berhasil</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        .receipt-container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .brand {
            font-family: 'Segoe UI', sans-serif;
            font-size: 28px;
            font-weight: bold;
            color: #00BFFF;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 30px;
        }

        .receipt-details {
            text-align: left;
            font-size: 16px;
            line-height: 1.8;
        }

        .receipt-details strong {
            display: inline-block;
            width: 150px;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 40px;
        }

        .logo {
            width: 120px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <img src="{{ public_path('struk/ChatGPT Image Jun 3, 2025, 12_03_27 AM.png') }}" alt="Logo" class="logo">

        <div class="brand">Komio Musik</div>
        <div class="title">Transaksi Berhasil Cuy:)</div>

        <div class="details">
            <p><strong>Kode Booking:</strong> {{ $pembayaran->booking->kode_booking }}</p>
            <p><strong>Nama Pemesan:</strong> {{ $pembayaran->nama_pemesan }}</p>
            <p><strong>Tanggal Booking:</strong> {{ $pembayaran->booking->tanggal }}</p>
            <p><strong>Total Dibayar:</strong> Rp {{ number_format($pembayaran->total_pembayaran) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pembayaran->status) }}</p>
        </div>

        <div class="footer">
            Terima kasih telah melakukan pembayaran.<br>
            Struk ini sah tanpa tanda tangan.
        </div>
    </div>
</body>
</html>


