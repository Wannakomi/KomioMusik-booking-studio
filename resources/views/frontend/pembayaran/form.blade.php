@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card bg-dark text-white border-0 shadow-sm">
        <div class="card-header bg-success text-white fw-bold d-flex align-items-center">
            <i class="fas fa-money-bill-wave me-2"></i> Form Pembayaran
        </div>

        <div class="card-body">

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-1"></i> {!! session('success') !!}
                </div>
            @endif

            {{-- Notifikasi error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bayar.frontend', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formPembayaran">
                @csrf

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item bg-dark text-white border-0"><strong>Kode Booking:</strong> {{ $booking->kode_booking }}</li>
                    <li class="list-group-item bg-dark text-white border-0"><strong>Nama Pemesan:</strong> {{ $booking->nama_pemesan }}</li>
                    <li class="list-group-item bg-dark text-white border-0"><strong>Ruangan:</strong> {{ $booking->ruangan->nama }}</li>
                    <li class="list-group-item bg-dark text-white border-0"><strong>Tanggal:</strong> {{ $booking->tanggal }}</li>
                    <li class="list-group-item bg-dark text-white border-0">
                        <strong>Harga:</strong>
                        @php
                            $harga = $booking->ruangan->hargaSewas->first()->harga ?? 0;
                        @endphp
                        @if($harga > 0)
                            Rp {{ number_format($harga, 0, ',', '.') }}
                        @else
                            <span class="text-danger">Harga tidak tersedia</span>
                        @endif
                    </li>
                </ul>

                {{-- Input tersembunyi harga agar bisa divalidasi di controller --}}
                <input type="hidden" name="harga" value="{{ $harga }}">

                <div class="mb-3">
                    <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                    <input type="number" name="total_pembayaran" class="form-control rounded-3" required>
                </div>

                <div class="mb-4">
                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="form-control rounded-3" required>
                </div>

                <button type="submit" class="btn btn-success rounded-pill px-4 py-2">
                    <i class="fas fa-paper-plane me-2"></i> Kirim Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- Validasi real-time pakai JavaScript --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formPembayaran');
        const totalInput = form.querySelector('input[name="total_pembayaran"]');
        const harga = parseInt(form.querySelector('input[name="harga"]').value);

        form.addEventListener('submit', function (e) {
            const total = parseInt(totalInput.value);
            if (total < harga) {
                e.preventDefault();
                alert(`Jumlah pembayaran tidak boleh kurang dari Rp ${harga.toLocaleString('id-ID')}`);
            }
        });
    });
</script>
@endpush
